<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';
require_once __DIR__ . '/../generated/GolampiVisitor.php';
require_once __DIR__ . '/../generated/GolampiBaseVisitor.php';
require_once __DIR__ . '/../src/Enviroment.php';
require_once __DIR__ . '/../src/Interpreter.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\DefaultErrorStrategy;
require_once __DIR__ . '/../src/SyntaxErrorListener.php';

$input = json_decode(file_get_contents('php://input'), true);
$codigo = $input['codigo'] ?? '';

// Capturar salida
ob_start();

$inputStream = InputStream::fromString($codigo);
$lexer = new GolampiLexer($inputStream);
$tokens = new CommonTokenStream($lexer);
$parser = new GolampiParser($tokens);

// Also expose tokens (array + csv)
$tokens->fill();
$allTokens = $tokens->getAllTokens();
$tokensList = [];
foreach ($allTokens as $t) {
    $tokensList[] = [
        'index' => $t->getTokenIndex(),
        'text' => $t->getText(),
        'type' => $t->getType(),
        'line' => $t->getLine(),
        'pos' => $t->getCharPositionInLine()
    ];
}
// build CSV
$tokenRows = [];
$tokenRows[] = ['Index','Text','Type','Line','Pos'];
foreach ($tokensList as $tk) {
    $tokenRows[] = [$tk['index'],$tk['text'],$tk['type'],$tk['line'],$tk['pos']];
}
$tokenLines = [];
foreach ($tokenRows as $r) {
    $escaped = array_map(function($f){
        $s = (string)$f;
        if (strpos($s, ',') !== false || strpos($s, '"') !== false || strpos($s, "\n") !== false) {
            return '"' . str_replace('"', '""', $s) . '"';
        }
        return $s;
    }, $r);
    $tokenLines[] = implode(',', $escaped);
}
$tokensCsv = implode("\n", $tokenLines);

// Usar estrategia de recuperación y capturar errores sintácticos
$parser->setErrorHandler(new DefaultErrorStrategy());
$syntaxListener = new SyntaxErrorListener();
$parser->removeErrorListeners();
$parser->addErrorListener($syntaxListener);

$tree = null;
try {
    $tree = $parser->program();
} catch (Exception $e) {
    // seguir y reportar errores desde el listener
}

$visitor = new interpreter();
$visitor->setDebug(false);

// Preparar respuesta con campos separados para sintácticos y semánticos
$response = [
    'success' => true,
    'salida' => '',
    'syntax' => [],
    'semantic' => [],
    'tabla' => [],
    'errors_csv' => '',
    'tokens' => $tokensList,
    'tokens_csv' => $tokensCsv
];

// Si hubo errores sintácticos, devolverlos y no ejecutar el visitor
if ($syntaxListener->hasErrors()) {
    $response['success'] = false;
    $response['salida'] = ob_get_clean();
    $response['syntax'] = $syntaxListener->getErrors();
    $response['semantic'] = [];
    $response['tabla'] = [];

    // Generar CSV de errores sintácticos
    $rows = [];
    $rows[] = ["Index","Type","Message","Line","Column","Offending"];
    $i = 1;
    foreach ($response['syntax'] as $err) {
        $rows[] = [
            $i++,
            'Sintáctico',
            str_replace(["\r", "\n"], [' ', ' '], $err['message'] ?? ''),
            $err['line'] ?? '',
            $err['column'] ?? '',
            $err['offending'] ?? ''
        ];
    }
    // Build CSV string
    $lines = [];
    foreach ($rows as $r) {
        $escaped = array_map(function($f) {
            $s = (string)$f;
            if (strpos($s, ',') !== false || strpos($s, '"') !== false || strpos($s, "\n") !== false) {
                return '"' . str_replace('"', '""', $s) . '"';
            }
            return $s;
        }, $r);
        $lines[] = implode(',', $escaped);
    }
    $response['errors_csv'] = implode("\n", $lines);

    echo json_encode($response);
    exit;
}

try {
    if ($tree !== null) $visitor->visit($tree);
    $response['salida'] = ob_get_clean();
    $response['semantic'] = $visitor->getErrors();
    $response['tabla'] = $visitor->getSymbolTable();
    // success stays true unless semantic errors should mark it false
    if (!empty($response['semantic'])) $response['success'] = false;

    // Generar CSV combinando syntax (vacío aquí) y semantic
    $rows = [];
    $rows[] = ["Index","Type","Message","Line","Column","Offending"];
    $i = 1;
    // semantic errors
    foreach ($response['semantic'] as $err) {
        $rows[] = [
            $i++,
            $err['type'] ?? 'Semántico',
            str_replace(["\r", "\n"], [' ', ' '], $err['msg'] ?? ''),
            $err['line'] ?? '',
            $err['col'] ?? '',
            ''
        ];
    }
    $lines = [];
    foreach ($rows as $r) {
        $escaped = array_map(function($f) {
            $s = (string)$f;
            if (strpos($s, ',') !== false || strpos($s, '"') !== false || strpos($s, "\n") !== false) {
                return '"' . str_replace('"', '""', $s) . '"';
            }
            return $s;
        }, $r);
        $lines[] = implode(',', $escaped);
    }
    $response['errors_csv'] = implode("\n", $lines);

    echo json_encode($response);
} catch (Exception $e) {
    $response['success'] = false;
    $response['salida'] = ob_get_clean() . "\nError: " . $e->getMessage();
    $response['semantic'] = $visitor->getErrors();
    $response['tabla'] = $visitor->getSymbolTable();
    echo json_encode($response);
}