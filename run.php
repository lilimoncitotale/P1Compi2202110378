<?php
require_once __DIR__ . '/vendor/autoload.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\BailErrorStrategy;
use Antlr\Antlr4\Runtime\Error\DefaultErrorStrategy;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\Tree\ParseTreeWalker;

// Cargar las clases generadas
require_once __DIR__ . '/generated/GolampiLexer.php';
require_once __DIR__ . '/generated/GolampiParser.php';
require_once __DIR__ . '/generated/GolampiVisitor.php';
require_once __DIR__ . '/generated/GolampiBaseVisitor.php';

require_once __DIR__ . '/src/Enviroment.php';
require_once __DIR__ . '/src/Interpreter.php';
require_once __DIR__ . '/src/SyntaxErrorListener.php';

// Verificar si se proporcionó un archivo
if ($argc < 2) {
    echo "Uso: php run.php <archivo>\n";
    exit(1);
}

$file = $argv[1];
if (!file_exists($file)) {
    echo "Error: Archivo '$file' no encontrado\n";
    exit(1);
}

echo "=== DIAGNÓSTICO ===\n";
echo "Archivo: $file\n";
echo "Tamaño: " . filesize($file) . " bytes\n";
echo "Iniciando proceso...\n";

// Leer el archivo
$input = file_get_contents($file);
echo "Archivo leído: " . strlen($input) . " caracteres\n";

// Preprocesar: mover asignaciones/decl. cortas top-level dentro de main() para permitir parseo
$input = (function($input){
    $lines = preg_split('/\r?\n/', $input);
    $inMultilineComment = false;
    $topLines = [];
    $otherLines = [];

    // Encontrar índice de la línea donde comienza la primera función (ej. "func ")
    $firstFuncIdx = null;
    foreach ($lines as $i => $ln) {
        if (preg_match('/\/\*/', $ln)) $inMultilineComment = true;
        if ($inMultilineComment && preg_match('/\*\//', $ln)) { $inMultilineComment = false; }
        // Buscar la función main específicamente
        if (!$inMultilineComment && preg_match('/^\s*func\s+main\b/', $ln)) { $firstFuncIdx = $i; break; }
    }

    if ($firstFuncIdx === null) return $input; // nada que hacer

    // Separar top-level (antes de the primera func) y resto
    $top = array_slice($lines, 0, $firstFuncIdx);
    $rest = array_slice($lines, $firstFuncIdx);

    $move = [];
    $keepTop = [];
    $inMulti = false;
    $braceLevel = 0; // track nesting to avoid touching lines inside function bodies
    foreach ($top as $ln) {
        $trim = ltrim($ln);
        if ($inMulti) {
            $keepTop[] = $ln;
            if (strpos($ln, '*/') !== false) $inMulti = false;
            // update brace level in case comment contains braces
            if (strpos($ln, '{') !== false) $braceLevel += substr_count($ln, '{');
            if (strpos($ln, '}') !== false) $braceLevel -= substr_count($ln, '}');
            continue;
        }
        if (strpos($trim, '/*') === 0) { $inMulti = true; $keepTop[] = $ln; continue; }
        if ($trim === '' || strpos($trim, '//') === 0) { $keepTop[] = $ln; continue; }

        // If we're inside a function or any brace scope, keep lines intact
        if ($braceLevel > 0) {
            $keepTop[] = $ln;
            if (strpos($ln, '{') !== false) $braceLevel += substr_count($ln, '{');
            if (strpos($ln, '}') !== false) $braceLevel -= substr_count($ln, '}');
            continue;
        }

        // Mantener/normalizar declaraciones: var, const (solo a nivel top)
        if (preg_match('/^\s*(var|const)\b/', $ln)) {
            if (preg_match('/^\s*var\s+([^\s].*?)\s+(\[.*\]|[A-Za-z_][A-Za-z0-9_]*(?:[0-9]*)?)\s*(?:=\s*(.*))?$/', $ln, $m)) {
                $idList = $m[1];
                $typePart = $m[2];
                $rhs = isset($m[3]) ? $m[3] : null;
                $ids = array_map('trim', explode(',', $idList));
                $exprs = $rhs !== null ? array_map('trim', explode(',', $rhs)) : [];
                foreach ($ids as $idx => $id) {
                    $expr = isset($exprs[$idx]) ? $exprs[$idx] : null;
                    if ($expr !== null && $expr !== '') {
                        $keepTop[] = "var $id $typePart = $expr";
                    } else {
                        $keepTop[] = "var $id $typePart";
                    }
                }
                // update brace level in case this line opens a block
                if (strpos($ln, '{') !== false) $braceLevel += substr_count($ln, '{');
                if (strpos($ln, '}') !== false) $braceLevel -= substr_count($ln, '}');
                continue;
            }
            $keepTop[] = $ln; continue;
        }

        // Si línea parece una asignación o declaración corta (incluye listas de ids), moverla (solo top-level)
        if (preg_match('/^\s*[A-Za-z_][A-Za-z0-9_]*(\s*,\s*[A-Za-z_][A-Za-z0-9_]*)*\s*(:=|=)/', $ln)) { $move[] = $ln; continue; }
        // Si parece una llamada a función top-level, moverla (solo top-level)
        if (preg_match('/^\s*[A-Za-z_][A-Za-z0-9_]*\s*\(.*\)\s*;?\s*$/', $ln)) { $move[] = $ln; continue; }
        // Por defecto mantener
        $keepTop[] = $ln;

        // actualizar nivel de llaves si la línea abre/cierra un bloque (p.ej. inicio de función)
        if (strpos($ln, '{') !== false) $braceLevel += substr_count($ln, '{');
        if (strpos($ln, '}') !== false) $braceLevel -= substr_count($ln, '}');
    }

    if (empty($move)) return $input; // nada que mover

    // No neutralizamos bloques 'switch' aquí: la gramática los soporta.
    // Mantener $keepTop tal cual.

    // Encontrar la apertura de main y la posición de la llave {
    $mainOpenIdx = null;
    $braceIdx = null;
    for ($i = 0; $i < count($rest); $i++) {
        if (preg_match('/^\s*func\s+main\s*\(/', $rest[$i])) {
            $mainOpenIdx = $i;
            // buscar la primera línea con "{" a partir de aquí
            for ($j = $i; $j < count($rest); $j++) {
                if (strpos($rest[$j], '{') !== false) { $braceIdx = $j; break; }
            }
            break;
        }
    }
    if ($mainOpenIdx === null || $braceIdx === null) return $input; // no hay main bien formado

    // Insertar las líneas movidas justo después de la línea con la llave de apertura
    $newRest = [];
    for ($i = 0; $i < count($rest); $i++) {
        $line = $rest[$i];
        // Mantener bloques 'switch' tal cual: la gramática ya los parsea.
        $newRest[] = $line;
        if ($i === $braceIdx) {
            foreach ($move as $m) $newRest[] = $m;
        }
    }

    $outLines = array_merge($keepTop, $newRest);

    // Envolver cuerpos de 'case' sin llaves en bloques '{ ... }' para que el parser los acepte.
    $wrapped = [];
    $n = count($outLines);
    for ($i = 0; $i < $n; $i++) {
        $line = $outLines[$i];
        if (preg_match('/^(\s*)case\b.*:\s*$/', $line, $m)) {
            $indent = $m[1];
            // Abrir bloque en la misma línea
            $wrapped[] = rtrim($line) . ' {';

            // Copiar líneas hasta el próximo 'case', 'default' o '}' (cierre del switch)
            $j = $i + 1;
            while ($j < $n) {
                $next = $outLines[$j];
                if (preg_match('/^\s*(case\b|default\b|})/', $next)) {
                    // Cerrar bloque antes de la siguiente etiqueta
                    $wrapped[] = $indent . '}';
                    break;
                }
                $wrapped[] = $next;
                $j++;
            }

            if ($j >= $n) {
                // reached EOF without finding end - close anyway
                $wrapped[] = $indent . '}';
                $i = $n; // finish
            } else {
                // continue from the line before $j (for loop will increment)
                $i = $j - 1;
            }
            continue;
        }
        $wrapped[] = $line;
    }

    $text = implode("\n", $wrapped);

    // Asegurar que los cuerpos de 'case' que no usan llaves queden envueltos en '{...}'
    $text = preg_replace_callback('/(^\\s*case[^:]*:)([\\s\\S]*?)(?=^\\s*(?:case\\b|default\\b|\\}))/m', function($m){
        $header = rtrim($m[1]);
        preg_match('/^(\\s*)/', $m[1], $im);
        $indent = isset($im[1]) ? $im[1] : '';
        $body = $m[2];
        return $header . ' {' . $body . $indent . '}';
    }, $text);

    // Corregir literales de arrays multidimensionales que usan llaves anidadas sin tipos
    // Ej: [2][2]int32{{1,2},{3,4}} -> [2][2]int32{[2]int32{1,2},[2]int32{3,4}}
    $text = preg_replace_callback('/(=\s*)(\[[0-9]+\](?:\[[0-9]+\])*[A-Za-z_][A-Za-z0-9_]*)\s*(\{\{+)/', function($m){
        $eq = $m[1];
        $type = $m[2];
        $braces = $m[3];
        $numBraces = strlen($braces);
        $dims = substr_count($type, '[');
        if ($numBraces <= 1 || $dims <= 1) {
            return $m[0];
        }
        // Build inner type sequence by removing leftmost dimension each time
        $prefix = '';
        $current = $type;
        for ($i = 1; $i < $numBraces; $i++) {
            // remove first "[n]" from $current
            $current = preg_replace('/^\[[^\]]+\]/', '', $current, 1);
            if ($current === $type) break;
            $prefix .= $current . '{';
        }
        // produce: = type{ prefix  (and leave one '{' to open outer)
        return $eq . $type . '{' . $prefix;
    }, $text);

    return $text;
})($input);

// Mostrar versión preprocesada (diagnóstico breve)
echo "--- PREPROCESSED INPUT (primeras 1200 chars) ---\n";
echo substr($input, 0, 1200) . "\n";
echo "--- FIN PREPROCESSED ---\n";

// Guardar preprocesado en /tmp para inspección
file_put_contents('/tmp/preprocessed_input.go', $input);

// Crear el stream de entrada
echo "Creando InputStream...\n";
$stream = InputStream::fromString($input);

// Crear el lexer
echo "Creando Lexer...\n";
$lexer = new GolampiLexer($stream);

// Crear el token stream
echo "Creando TokenStream...\n";
$tokenStream = new CommonTokenStream($lexer);

$tokenStream->fill();
$tokens = $tokenStream->getAllTokens();
$out = [];
foreach ($tokens as $t) {
    $out[] = sprintf("%04d | %-20s | type=%d | line=%d | pos=%d", $t->getTokenIndex(), $t->getText(), $t->getType(), $t->getLine(), $t->getCharPositionInLine());
}
file_put_contents('/tmp/tokens_dump.txt', implode("\n", $out));

// Crear el parser
echo "Creando Parser...\n";
$parser = new GolampiParser($tokenStream);

// Usar estrategia por defecto que intenta recuperar errores
$parser->setErrorHandler(new DefaultErrorStrategy());

// Añadir listener para capturar errores sintácticos
$syntaxListener = new SyntaxErrorListener();
$parser->removeErrorListeners();
$parser->addErrorListener($syntaxListener);

// Intentar parsear (continuará intentando recuperar errores)
echo "Intentando parsear programa...\n";
$tree = null;
try {
    $tree = $parser->program();
    echo "Parseo (con recuperación) completado\n";
} catch (Exception $e) {
    // Aunque la estrategia por defecto intenta recuperar, el parser puede lanzar
    echo "Excepción durante parseo: " . $e->getMessage() . "\n";
}

// Si hubo errores sintácticos, reportarlos y NO ejecutar la interpretación
if ($syntaxListener->hasErrors()) {
    echo " Errores sintácticos detectados:\n";
    foreach ($syntaxListener->getErrors() as $err) {
        echo sprintf("Línea: %d, Col: %d, Msg: %s, Offending: %s\n", $err['line'], $err['column'], $err['message'], $err['offending'] ?? '');
    }
} else {
    if ($tree !== null) {
        // Crear intérprete
        echo "Creando intérprete...\n";
        $interpreter = new interpreter();

        // Desactivar debug para velocidad
        $interpreter->setDebug(false);

        // Ejecutar
        echo "Ejecutando programa...\n";
        $interpreter->visit($tree);
        echo "Ejecución completada\n";
    }
}

echo "=== FIN DIAGNÓSTICO ===\n";