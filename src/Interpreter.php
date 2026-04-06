<?php

// simple control-flow signals used to unwind the visitor stack for break/continue
class BreakSignal extends \Exception {}
class ContinueSignal extends \Exception {}

// generated visitor/parser are loaded by run.php before this file is required

class ReturnSignal extends \Exception {
    private $value;
    public function __construct($value) {
        parent::__construct();
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}

class interpreter extends GolampiBaseVisitor
{
    private Enviroment $global;
    private Enviroment $current;
    private bool $debug = false;
    private $errorSentinel;
    
    // Tipos del lenguaje (alineados con Environment)
    const TYPE_INT = 'int32';
    const TYPE_FLOAT = 'float32';
    const TYPE_BOOL = 'bool';
    const TYPE_RUNE = 'rune';
    const TYPE_STRING = 'string';
    const TYPE_ARRAY = 'array';
    const TYPE_NIL = 'nil';
    const TYPE_POINTER = 'pointer';

    public function __construct()
    {
        $this->global = new Enviroment();
        $this->current = $this->global;
        $this->errorSentinel = new \stdClass();
    }

    public function setDebug(bool $v)
    {
        $this->debug = $v;
    }

    private function dbg(string $msg)
    {
        if ($this->debug) {
            echo "[DEBUG] " . $msg . "\n";
        }
    }

    // Tipo runtime de un valor PHP simple (mapeado a tipos Golampi)
   private function typeOfValue($val)
    {
        if (is_int($val)) return self::TYPE_INT;
        if (is_float($val)) return self::TYPE_FLOAT;
        if (is_bool($val)) return self::TYPE_BOOL;
        if (is_string($val)) {
            if (strlen($val) === 1) {
                return self::TYPE_RUNE;
            }
            return self::TYPE_STRING;
        }
        if (is_array($val)) {
            if (isset($val['isReference']) && $val['isReference']) {
                return self::TYPE_POINTER;
            }
            // Detectar si es un array con tamaño conocido
            if (!empty($val) && array_keys($val) === range(0, count($val)-1)) {
                // Determinar el tipo base (última dimensión)
                $baseType = $this->getBaseElementType($val);
                
                // Construir la representación del tipo con todas las dimensiones
                $dimensions = $this->countDimensions($val);
                $sizes = $this->getArraySizes($val);
                $typeStr = '';
                foreach ($sizes as $size) {
                    $typeStr .= '[' . $size . ']';
                }
                return $typeStr . $baseType;
            }
            return self::TYPE_ARRAY;
        }
        if ($val === null) return self::TYPE_NIL;
        return 'unknown';
    }

    /**
     * Obtener los tamaños de cada dimensión de un array multidimensional
     */
    private function getArraySizes($array)
    {
        $sizes = [];
        $current = $array;
        
        while (is_array($current) && !isset($current['isReference'])) {
            $sizes[] = count($current);
            if (!empty($current)) {
                $current = reset($current);
            } else {
                break;
            }
        }
        
        return $sizes;
    }

    /**
     * Obtener el tipo base de los elementos (última dimensión)
     */
    private function getBaseElementType($array)
    {
        $current = $array;
        while (is_array($current) && !isset($current['isReference']) && !empty($current)) {
            $current = reset($current);
        }
        
        return $this->typeOfValue($current);
    }

    // Promociona numéricos: si alguno es float32 devuelve ambos como float32
    private function coerceNumeric($a, $b)
    {
        $ta = $this->typeOfValue($a);
        $tb = $this->typeOfValue($b);
        
        // Si alguno es float32, promover a float32
        if ($ta === self::TYPE_FLOAT || $tb === self::TYPE_FLOAT) {
            return [(float)$a, (float)$b, self::TYPE_FLOAT];
        }
        // Si son enteros (int32) o runes
        if (in_array($ta, [self::TYPE_INT, self::TYPE_RUNE]) && in_array($tb, [self::TYPE_INT, self::TYPE_RUNE])) {
            // Convertir runes a su código ASCII para operaciones
            $a_val = ($ta === self::TYPE_RUNE) ? ord($a) : (int)$a;
            $b_val = ($tb === self::TYPE_RUNE) ? ord($b) : (int)$b;
            return [$a_val, $b_val, self::TYPE_INT];
        }
        // Si son enteros (int32)
        return [(int)$a, (int)$b, self::TYPE_INT];
    }

    // Simple error collection
    private array $errors = [];
    // Function table: name -> ['params'=>[['name','type'],...], 'retTypes'=>array, 'block'=>ctx]
    private array $functions = [];

    private function reportError(string $msg, $ctx = null)
    {
        $line = null;
        $col = null;
        if ($ctx !== null && property_exists($ctx, 'start') && $ctx->start) {
            $line = $ctx->start->getLine();
            $col = $ctx->start->getStartIndex();
        }
        
        $errorType = $this->classifyError($msg);
        $this->errors[] = [
            'type' => $errorType,
            'msg' => $msg, 
            'line' => $line, 
            'col' => $col
        ];
        $this->dbg($errorType . ' ERROR: ' . $msg);
    }

    private function classifyError(string $msg): string {
        if (strpos($msg, 'Cannot assign to constant') !== false) return 'Semántico';
        if (strpos($msg, 'Variable no definida') !== false) return 'Semántico';
        if (strpos($msg, 'Type mismatch') !== false) return 'Semántico';
        if (strpos($msg, 'Tipo incorrecto') !== false) return 'Semántico';
        if (strpos($msg, 'Función no definida') !== false) return 'Semántico';
        if (strpos($msg, 'Incompatible types') !== false) return 'Semántico';
        if (strpos($msg, 'Símbolo no reconocido') !== false) return 'Léxico';
        if (strpos($msg, 'Se esperaba') !== false) return 'Sintáctico';
        return 'Semántico'; // Por defecto
    }

    // Resolver nombre calificado si existe (ej. fmt.Println) o IDENTIFIER simple
    private function resolveQualifiedName($ctx)
    {
        // Si la gramática ya tiene qualified(), usarlo
        if (is_object($ctx) && method_exists($ctx, 'qualified') && $ctx->qualified()) {
            return $ctx->qualified()->getText();
        }
        // Fallback: IDENTIFIER token (compatibilidad con parser generado previo)
        if (is_object($ctx) && method_exists($ctx, 'IDENTIFIER') && $ctx->IDENTIFIER()) {
            $id = $ctx->IDENTIFIER();
            if (is_array($id)) return $id[0]->getText();
            return $id->getText();
        }
        return null;
    }

    // Mapear nombres calificados a builtins canónicos (p. ej. fmt.Println -> println)
    private function mapBuiltinName(string $name): string
    {
        $mapping = [
            'println' => 'println',
            'print' => 'print',
            'typeof' => 'typeOf',
            'len' => 'len',
            'now' => 'now',
            'substr' => 'substr',
            'int' => 'int',
            'float' => 'float',
            'bool' => 'bool',
            'string' => 'string'
        ];

        // Extraer la parte final si viene calificado
        $parts = preg_split('/\\./', $name);
        $base = end($parts);

        $lower = strtolower($base);
        foreach ($mapping as $key => $canonical) {
            if ($lower === strtolower($key) || $lower === strtolower($canonical)) {
                return $canonical;
            }
        }

        // No es builtin conocido, devolver original
        return $name;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getSymbolTable(): array
    {
        return $this->global->getSymbolTable();
    }

    public function visitProgram($ctx)
    {
        $this->dbg("VisitProgram: INICIO - " . date('H:i:s'));
        $this->dbg("Número de declaraciones: " . count($ctx->declaration()));
        
        // Limpiar tabla de símbolos para nueva ejecución
        $this->global->clearSymbolTable();
        
        // PRIMERA PASADA: Solo registrar funciones (hoisting)
        $count = 0;
        foreach ($ctx->declaration() as $decl) {
            $count++;
            if ($count % 10 == 0) {
                $this->dbg("Procesando declaración $count...");
            }
            if ($decl->functionDecl()) {
                $this->visitFunctionDecl($decl->functionDecl());
            }
        }
        
        $this->dbg("VisitProgram: funciones registradas - " . date('H:i:s'));
        
        // Ejecutar main() si existe
        if (isset($this->functions['main'])) {
            $this->dbg("Ejecutando función main() - " . date('H:i:s'));
            return $this->callUserFunction('main', [], $ctx);
        } else {
            $this->reportError("No se encontró la función main()", $ctx);
        }
        
        return null;
    }

    public function visitFunctionDecl($ctx)
    {
        // Verificar si la función tiene errores sintácticos
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child instanceof ErrorNodeImpl || strpos(get_class($child), 'ErrorNode') !== false) {
                $this->dbg("  Función con errores sintácticos, ignorando");
                return null;
            }
        }
        
        $this->dbg("=== visitFunctionDecl - INICIO ===");
    
        // Mostrar todos los hijos para diagnóstico
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child) {
                $this->dbg("  Hijo $i: " . get_class($child) . " - '" . $child->getText() . "'");
            }
        }
        
        $idNode = $ctx->IDENTIFIER();
        if (!$idNode) {
            $this->dbg("  ¡No se encontró IDENTIFIER!");
            $this->reportError("Función sin identificador", $ctx);
            return null;
        }
        
        $name = $idNode->getText();
        $this->dbg("Procesando función: $name");
        
        // Obtener el nombre de la función de manera segura
        $idNode = $ctx->IDENTIFIER();
        if (!$idNode) {
            $this->reportError("Función sin identificador", $ctx);
            return null;
        }
        $name = $idNode->getText();
        $this->dbg("Procesando función: $name");
        
        // Procesar parámetros
        $params = [];
        $paramList = $ctx->parameterList();
        if ($paramList) {
            $this->dbg("  Tiene parámetros");
            $parameters = $paramList->parameter();
            if (is_array($parameters)) {
                foreach ($parameters as $p) {
                    if (!$p) continue;
                    
                    $pnameNode = $p->IDENTIFIER();
                    if (!$pnameNode) continue;
                    $pname = $pnameNode->getText();
                    $this->dbg("    Parámetro nombre: $pname");
                    
                    $typeNode = $p->type();
                    if ($typeNode) {
                        $ptype = $this->visit($typeNode);
                        $this->dbg("    Tipo: $ptype");
                    } else {
                        $ptype = null;
                    }
                    
                    $params[] = ['name' => $pname, 'type' => $ptype];
                }
            }
        } else {
            $this->dbg("  No tiene parámetros");
        }

        // Buscar el bloque
        $blockNode = $ctx->block();
        if (!$blockNode) {
            $this->reportError("Función sin bloque de código", $ctx);
            return null;
        }

        // Guardar la función (sin tipos de retorno por ahora)
        $this->functions[$name] = [
            'params' => $params, 
            'retTypes' => [],  // Temporalmente vacío
            'block' => $blockNode
        ];
        
        $this->dbg("registered function $name with " . count($params) . " params");
        return null;
    }

    public function visitConstDecl($ctx)
    {
        $this->dbg("=== visitConstDecl ===");
        
        $name = $ctx->IDENTIFIER()->getText();
        $line = $ctx->start->getLine();
        $column = $ctx->start->getStartIndex();
        
        // Obtener el tipo
        $typeNode = $ctx->type();
        $declType = $this->visit($typeNode);
        
        // Obtener el valor de inicialización
        $exprNode = $ctx->expression();
        $value = $this->visit($exprNode);
        
        if ($value === $this->errorSentinel) {
            return $this->errorSentinel;
        }
        
        // Validar que el tipo coincida
        $valueType = $this->typeOfValue($value);
        
        // Permitir promoción int->float para constantes
        if ($declType === self::TYPE_FLOAT && $valueType === self::TYPE_INT) {
            $value = (float)$value;
        } else if ($declType === self::TYPE_INT && $valueType === self::TYPE_RUNE) {
            $value = ord($value);
        } else if ($declType === self::TYPE_RUNE && $valueType === self::TYPE_INT) {
            $value = chr($value);
        } else if ($declType !== $valueType) {
            $this->reportError("Type mismatch in constant declaration: expected $declType, got $valueType", $ctx);
            return $this->errorSentinel;
        }
        
        // Definir como constante (inmutable)
        $this->current->define($name, $value, $declType, true, ['line' => $line, 'column' => $column]);
        
        $this->dbg("const $name = " . var_export($value, true));
        return null;
    }

    public function visitVarDecl($ctx)
    {
        // Verificar que el contexto sea válido
        if (!$ctx) {
            $this->reportError("Contexto nulo en declaración de variable", null);
            return $this->errorSentinel;
        }
        
        // Obtener el nombre de la variable de manera segura
        $idNode = $ctx->IDENTIFIER();
        if (!$idNode) {
            $this->reportError("Declaración de variable sin identificador", $ctx);
            return $this->errorSentinel;
        }
        if (is_array($idNode)) {
            $idNode = $idNode[0];
        }
        if (is_object($idNode) && method_exists($idNode, 'getText')) {
            $name = $idNode->getText();
        } else if (is_string($idNode)) {
            $name = $idNode;
        } else {
            $this->reportError("Identificador inválido en declaración de variable", $ctx);
            return $this->errorSentinel;
        }
        
        $line = $ctx->start ? $ctx->start->getLine() : null;
        $column = $ctx->start ? $ctx->start->getStartIndex() : null;
        
        // Verificar si es un arreglo (tiene arrayType)
        $arrayTypeCtx = $ctx->arrayType();
        $isArray = $arrayTypeCtx !== null;
        
        if ($isArray) {
            $this->dbg("=== visitVarDecl: Array ===");
            $this->dbg("Nombre: $name");
            
            // ===========================================
            // Recorrer TODOS los corchetes correctamente
            // ===========================================
            $sizes = [];
            $currentCtx = $arrayTypeCtx;
            $typeNode = null;
            
            while ($currentCtx !== null) {
                // Obtener el tamaño
                $sizeExpr = $currentCtx->expression();
                if ($sizeExpr !== null) {
                    $size = $this->visit($sizeExpr);
                    if ($size === $this->errorSentinel) return $this->errorSentinel;
                    
                    if (!is_int($size) || $size <= 0) {
                        $this->reportError("El tamaño del arreglo debe ser un entero positivo", $ctx);
                        return $this->errorSentinel;
                    }
                    
                    $sizes[] = $size;
                }
                
                // Buscar el siguiente arrayType O el tipo final
                $nextArrayCtx = null;
                $foundType = null;
                
                for ($i = 0; $i < $currentCtx->getChildCount(); $i++) {
                    $child = $currentCtx->getChild($i);
                    if (!$child) continue;
                    
                    if ($child instanceof \Context\ArrayTypeContext) {
                        $nextArrayCtx = $child;
                    }
                    if ($child instanceof \Context\TypeContext) {
                        $foundType = $child;
                    }
                }
                
                // Si encontramos un tipo, terminamos
                if ($foundType !== null) {
                    $typeNode = $foundType;
                    $currentCtx = null;
                    break;
                }
                
                // Si encontramos otro arrayType, continuamos
                if ($nextArrayCtx !== null) {
                    $currentCtx = $nextArrayCtx;
                } else {
                    break;
                }
            }
            
            $this->dbg("Tamaños del array: " . json_encode($sizes));
            
            // Obtener el tipo de los elementos
            if ($typeNode === null) {
                $this->reportError("No se pudo obtener el tipo del array", $ctx);
                return $this->errorSentinel;
            }
            
            $elementType = $this->visit($typeNode);
            $this->dbg("Tipo de elemento: $elementType");
            
            // Crear array con múltiples dimensiones
            $array = $this->createMultiDimensionalArray($sizes, $elementType);
            
            // Si hay inicialización literal
            $arrayLiteralCtx = $ctx->arrayLiteral();
            if ($arrayLiteralCtx) {
                $literalValues = $this->visit($arrayLiteralCtx);
                
                if ($literalValues === $this->errorSentinel) return $this->errorSentinel;
                
                $this->dbg("Array literal con " . count($literalValues) . " elementos");
                
                if (is_array($literalValues)) {
                    $array = $literalValues;
                }
            }
            
            $dimensions = count($sizes);
            $this->dbg("Dimensiones calculadas: $dimensions");
            
            $this->current->define($name, $array, self::TYPE_ARRAY, false, ['line' => $line, 'column' => $column]);
            
        } else {
            // Es una variable normal
            $value = null;
            $exprNode = $ctx->expression();
            if ($exprNode) {
                // Visitar la expresión
                $value = $this->visit($exprNode);
                
                $this->dbg("VALOR EN VARDECL DESPUÉS DE VISIT: " . json_encode($value));
                $this->dbg("Valor recibido en varDecl: " . json_encode($value));
                $this->dbg("Tipo de valor: " . gettype($value));
                
                if ($value === $this->errorSentinel) return $this->errorSentinel;
            }

            $declType = null;
            $typeNode = $ctx->type();
            if ($typeNode) {
                $declType = $this->visit($typeNode);
            }

            // Manejar declaración de punteros
            if ($declType !== null && strpos($declType, '*') === 0) {
                $this->dbg("Tipo de puntero detectado: $declType");
                $this->dbg("Valor recibido: " . json_encode($value));
                
                // Verificar que el valor sea una referencia
                if (!is_array($value) || !isset($value['isReference']) || !$value['isReference']) {
                    $this->reportError("Se esperaba una referencia (usar &) para inicializar puntero $name. Valor recibido: " . gettype($value), $ctx);
                    return $this->errorSentinel;
                }
                
                $this->dbg("Inicializando puntero $name con referencia a: " . $value['name']);
                // Guardar la referencia directamente
            }
            // Validación normal para no-punteros
            else if ($declType !== null && $value !== null) {
                $vtype = $this->typeOfValue($value);
                
                if ($declType === self::TYPE_FLOAT && $vtype === self::TYPE_INT) {
                    $value = (float)$value;
                } else if ($declType === self::TYPE_INT && $vtype === self::TYPE_RUNE) {
                    $value = ord($value);
                } else if ($declType === self::TYPE_RUNE && $vtype === self::TYPE_INT) {
                    $value = chr($value);
                } else if ($declType === self::TYPE_INT && $vtype === self::TYPE_FLOAT) {
                    $this->reportError("Cannot assign float to int for variable $name", $ctx);
                    return $this->errorSentinel;
                } else if ($declType !== $vtype && !($declType === self::TYPE_FLOAT && $vtype === self::TYPE_INT)) {
                    $this->reportError("Incompatible types for variable declaration $name: $declType and $vtype", $ctx);
                    return $this->errorSentinel;
                }
            }

            $this->current->define($name, $value, $declType, false, ['line' => $line, 'column' => $column]);
        }
        
        return null;
    }

    public function visitShortVarDecl($ctx)
    {
        $this->dbg("=== visitShortVarDecl ===");
        
        $names = [];
        $values = [];
        $line = $ctx->start->getLine();
        $column = $ctx->start->getStartIndex();
        
        // Recolectar nombres (lado izquierdo de :=)
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            $childText = $child->getText();
            
            if ($childText === ':=') {
                break;
            }
            
            if ($childText !== ',' && preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $childText)) {
                $names[] = $childText;
            }
        }

        // Recolectar valores (lado derecho de :=)
        $foundAssign = false;
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child->getText() === ':=') {
                $foundAssign = true;
                continue;
            }
            if ($foundAssign) {
                $val = $this->visit($child);
                if ($val === $this->errorSentinel) return $this->errorSentinel;
                
                if (is_array($val) && isset($val['isReference'])) {
                    $values[] = $val;
                } else if (is_array($val)) {
                    foreach ($val as $v) {
                        $values[] = $v;
                    }
                } else {
                    $values[] = $val;
                }
            }
        }

        // Manejar múltiples retornos
        if (count($names) != count($values)) {
            if (count($values) == 1 && is_array($values[0]) && count($values[0]) == count($names)) {
                $values = $values[0];
            } else {
                $this->reportError("Número incorrecto de valores en asignación. Esperados: " . count($names) . ", recibidos: " . count($values), $ctx);
                return $this->errorSentinel;
            }
        }
        
        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $value = $values[$i];
            $type = $this->typeOfValue($value);
            
            // Verificar si la variable ya existe en el ámbito actual
            try {
                $this->current->get($name);
                // Si llegamos aquí, la variable existe - error por redefinición
                $this->reportError("Variable '$name' already declared in current scope", $ctx);
                return $this->errorSentinel;
            } catch (Exception $e) {
                // Variable no existe, podemos crearla
                $this->current->define($name, $value, $type, false, ['line' => $line, 'column' => $column]);
            }
            
            $this->dbg("shortVarDecl $name = " . var_export($value, true));
        }
        
        return null;
    }

   public function visitAssignment($ctx)
    {
        $this->dbg("=== visitAssignment ===");
        $this->dbg("ctx type: " . get_class($ctx));
        $this->dbg("ctx child count: " . $ctx->getChildCount());
        
        // Obtener todos los hijos de manera segura
        $children = [];
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child) {
                $children[$i] = $child;
                $this->dbg("Child $i: " . get_class($child) . " = " . $child->getText());
            } else {
                $children[$i] = null;
                $this->dbg("Child $i: null");
            }
        }
        if ($ctx->getChildCount() == 2) {
            $lastChild = $ctx->getChild(1);
            if ($lastChild && ($lastChild->getText() === '++' || $lastChild->getText() === '--')) {
                $primary = $ctx->getChild(0);
                if ($primary instanceof \Context\PrimaryContext) {
                    $this->dbg("Detectado incremento/decremento como statement, manejando directamente");
                    // Llamar al manejador especializado para incremento/decremento
                    return $this->handleIncrementDecrement($primary, $lastChild->getText());
                }
            }
        }
        
        // ===========================================
        // ✅ CAMBIO: Detectar desreferencia múltiple (*ptr, **ptr, ***ptr, etc.)
        // ===========================================
        $dereferenceCount = 0;
        $operatorPos = -1;

        // Primero, contar los '*' al inicio y encontrar el '='
        for ($i = 0; $i < count($children); $i++) {
            if ($children[$i] && $children[$i]->getText() === '*') {
                $dereferenceCount++;
            } else if ($children[$i] && $children[$i]->getText() === '=') {
                $operatorPos = $i;
                break;
            } else {
                break;
            }
        }

        // Si hay al menos un '*' al inicio y encontramos un '=', es una asignación a puntero
        if ($dereferenceCount > 0 && $operatorPos > $dereferenceCount) {
            $this->dbg("=== ASIGNACIÓN A TRAVÉS DE PUNTERO (múltiple) ===");
            $this->dbg("Número de desreferencias: $dereferenceCount");
            
            // El nombre del puntero está después de los '*'
            $ptrNameIndex = $dereferenceCount;
            if (!isset($children[$ptrNameIndex])) {
                $this->reportError("Falta el nombre del puntero", $ctx);
                return $this->errorSentinel;
            }
            
            $ptrName = $children[$ptrNameIndex]->getText();
            $this->dbg("Puntero: $ptrName");
            
            try {
                // Obtener el puntero
                $currentPtr = $this->current->get($ptrName);
                $this->dbg("Valor del puntero nivel 1: " . json_encode($currentPtr));
                
                if (!is_array($currentPtr) || !isset($currentPtr['isReference']) || !$currentPtr['isReference']) {
                    $this->reportError("$ptrName no es un puntero válido", $ctx);
                    return $this->errorSentinel;
                }
                
                // Desreferenciar múltiples veces para llegar al destino final
                $targetName = $currentPtr['name'];
                $currentLevel = 1;
                
                for ($i = 1; $i < $dereferenceCount; $i++) {
                    $currentLevel++;
                    $nextPtr = $this->current->get($targetName);
                    
                    $this->dbg("Nivel $currentLevel: $targetName = " . json_encode($nextPtr));
                    
                    if (!is_array($nextPtr) || !isset($nextPtr['isReference']) || !$nextPtr['isReference']) {
                        $this->reportError("No se puede desreferenciar: variable {$targetName} no es un puntero", $ctx);
                        return $this->errorSentinel;
                    }
                    $targetName = $nextPtr['name'];
                }
                
                $this->dbg("Variable destino final: $targetName");
                
                // Evaluar el valor a asignar (después del '=')
                $valueNode = $children[$operatorPos + 1];
                if (!$valueNode) {
                    $this->reportError("Falta el valor a asignar", $ctx);
                    return $this->errorSentinel;
                }
                
                $value = $this->visit($valueNode);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                
                $this->dbg("Asignando valor: " . json_encode($value) . " a variable: $targetName");
                
                // Asignar al destino final
                $this->current->assign($targetName, $value);
                $this->dbg("Asignación a través de puntero completada");
                return null;
                
            } catch (Exception $e) {
                $this->reportError($e->getMessage(), $ctx);
                return $this->errorSentinel;
            }
        }
        
        // Si hay al menos un '*' al inicio, es una desreferencia
        if ($dereferenceCount > 0) {
            $this->dbg("=== ASIGNACIÓN A TRAVÉS DE PUNTERO (múltiple) ===");
            $this->dbg("Número de desreferencias: $dereferenceCount");
            
            // Obtener el nombre del puntero (después de todos los '*')
            $ptrNameIndex = $dereferenceCount;
            if (!isset($children[$ptrNameIndex])) {
                $this->reportError("Falta el nombre del puntero", $ctx);
                return $this->errorSentinel;
            }
            
            $ptrName = $children[$ptrNameIndex]->getText();
            $this->dbg("Puntero: $ptrName");
            
            try {
                // Obtener el puntero
                $ptr = $this->current->get($ptrName);
                $this->dbg("Valor del puntero: " . json_encode($ptr));
                
                if (!is_array($ptr) || !isset($ptr['isReference']) || !$ptr['isReference']) {
                    $this->reportError("$ptrName no es un puntero válido", $ctx);
                    return $this->errorSentinel;
                }
                
                // Desreferenciar múltiples veces
                $targetVar = $ptr['name'];
                for ($i = 1; $i < $dereferenceCount; $i++) {
                    $ptr = $this->current->get($targetVar);
                    if (!is_array($ptr) || !isset($ptr['isReference']) || !$ptr['isReference']) {
                        $this->reportError("No se puede desreferenciar: variable {$targetVar} no es un puntero", $ctx);
                        return $this->errorSentinel;
                    }
                    $targetVar = $ptr['name'];
                }
                
                $this->dbg("Variable destino: $targetVar");
                
                // Evaluar el valor a asignar (está después del '=')
                $eqPos = -1;
                for ($j = 0; $j < count($children); $j++) {
                    if (isset($children[$j]) && $children[$j]->getText() === '=') {
                        $eqPos = $j;
                        break;
                    }
                }
                
                if ($eqPos === -1 || !isset($children[$eqPos + 1])) {
                    $this->reportError("Falta el valor a asignar", $ctx);
                    return $this->errorSentinel;
                }
                
                $valueNode = $children[$eqPos + 1];
                $value = $this->visit($valueNode);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                
                $this->dbg("Asignando valor: " . json_encode($value) . " a variable: $targetVar");
                
                // Asignar al destino del puntero
                $this->current->assign($targetVar, $value);
                $this->dbg("Asignación a través de puntero completada");
                return null;
                
            } catch (Exception $e) {
                $this->reportError($e->getMessage(), $ctx);
                return $this->errorSentinel;
            }
        }
        
        // ===========================================
        // CASO 2: Asignación a elemento de arreglo (IDENTIFIER '[' expression ']' ... '=' expression)
        // ===========================================
        if (isset($children[1]) && $children[1]->getText() === '[') {
            $this->dbg("=== ASIGNACIÓN A ARREGLO ===");
            
            if (!isset($children[0])) {
                $this->reportError("Falta el nombre del array", $ctx);
                return $this->errorSentinel;
            }
            
            $name = $children[0]->getText();
            
            // Extraer TODOS los índices
            $indices = [];
            $i = 1;
            while ($i < count($children) && isset($children[$i]) && $children[$i]->getText() === '[') {
                if (!isset($children[$i + 1])) {
                    $this->reportError("Falta expresión de índice", $ctx);
                    return $this->errorSentinel;
                }
                
                $idxExpr = $children[$i + 1];
                $idx = $this->visit($idxExpr);
                if ($idx === $this->errorSentinel) return $this->errorSentinel;
                
                if (!is_int($idx)) {
                    $this->reportError("El índice del arreglo debe ser un entero", $ctx);
                    return $this->errorSentinel;
                }
                
                $indices[] = $idx;
                $i += 3; // Saltar [ expresión ]
            }
            
            // Encontrar el '=' y el valor
            $eqPos = -1;
            for ($j = 0; $j < count($children); $j++) {
                if (isset($children[$j]) && $children[$j]->getText() === '=') {
                    $eqPos = $j;
                    break;
                }
            }
            
            if ($eqPos === -1 || !isset($children[$eqPos + 1])) {
                $this->reportError("Asignación a arreglo incompleta", $ctx);
                return $this->errorSentinel;
            }
            
            $valueNode = $children[$eqPos + 1];
            $value = $this->visit($valueNode);
            if ($value === $this->errorSentinel) return $this->errorSentinel;
            
            try {
                $this->current->assignAtIndex($name, $indices, $value);
                return null;
            } catch (Exception $e) {
                $this->reportError($e->getMessage(), $ctx);
                return $this->errorSentinel;
            }
        }
        
        // ===========================================
        // CASO 3: Asignación a variable simple (IDENTIFIER '=' expression)
        // ===========================================
        // Asignaciones compuestas (+=, -=, *=, /=, %=)
        if (isset($children[1]) && in_array($children[1]->getText(), ['+=', '-=', '*=', '/=', '%='])) {
            $this->dbg("=== ASIGNACIÓN COMPUESTA: " . $children[1]->getText() . " ===");
            
            if (!isset($children[0])) {
                $this->reportError("Falta el nombre de la variable", $ctx);
                return $this->errorSentinel;
            }
            
            $name = $children[0]->getText();
            $op = $children[1]->getText();
            
            if (!isset($children[2])) {
                $this->reportError("Falta el valor a asignar", $ctx);
                return $this->errorSentinel;
            }
            
            // Obtener valor actual de la variable
            try {
                $currentValue = $this->current->get($name);
            } catch (Exception $e) {
                $this->reportError("Variable no definida: $name", $ctx);
                return $this->errorSentinel;
            }
            
            // Evaluar la expresión del lado derecho
            $rightValue = $this->visit($children[2]);
            if ($rightValue === $this->errorSentinel) return $this->errorSentinel;
            
            // Validar tipos numéricos
            $leftType = $this->typeOfValue($currentValue);
            $rightType = $this->typeOfValue($rightValue);
            
            if (!in_array($leftType, [self::TYPE_INT, self::TYPE_FLOAT, self::TYPE_RUNE]) ||
                !in_array($rightType, [self::TYPE_INT, self::TYPE_FLOAT, self::TYPE_RUNE])) {
                $this->reportError("Operadores compuestos requieren tipos numéricos", $ctx);
                return $this->errorSentinel;
            }
            
            // Convertir runes a valores numéricos si es necesario
            $leftNum = ($leftType === self::TYPE_RUNE) ? ord($currentValue) : $currentValue;
            $rightNum = ($rightType === self::TYPE_RUNE) ? ord($rightValue) : $rightValue;
            
            // Aplicar la operación
            $newValue = null;
            switch ($op) {
                case '+=':
                    $newValue = $leftNum + $rightNum;
                    break;
                case '-=':
                    $newValue = $leftNum - $rightNum;
                    break;
                case '*=':
                    $newValue = $leftNum * $rightNum;
                    break;
                case '/=':
                    if ($rightNum == 0) {
                        $this->reportError("División por cero en asignación compuesta", $ctx);
                        return $this->errorSentinel;
                    }
                    $newValue = $leftNum / $rightNum;
                    break;
                case '%=':
                    if ($rightNum == 0) {
                        $this->reportError("Módulo por cero en asignación compuesta", $ctx);
                        return $this->errorSentinel;
                    }
                    $newValue = $leftNum % $rightNum;
                    break;
            }
            
            // Mantener el tipo original si es necesario
            if ($leftType === self::TYPE_FLOAT && is_int($newValue)) {
                $newValue = (float)$newValue;
            } else if ($leftType === self::TYPE_INT && is_float($newValue)) {
                // Truncar a entero
                $newValue = (int)$newValue;
            } else if ($leftType === self::TYPE_RUNE) {
                // Convertir de vuelta a carácter si es posible
                $newValue = chr($newValue);
            }
            
            $this->dbg("$name $op $rightValue = $newValue (era $currentValue)");
            
            // Asignar el nuevo valor
            try {
                $this->current->assign($name, $newValue);
                return null;
            } catch (Exception $e) {
                $this->reportError($e->getMessage(), $ctx);
                return $this->errorSentinel;
            }
        }
        if (isset($children[1]) && $children[1]->getText() === '=') {
            if (!isset($children[0])) {
                $this->reportError("Falta el nombre de la variable", $ctx);
                return $this->errorSentinel;
            }
            
            $name = $children[0]->getText();
            
            if (!isset($children[2])) {
                $this->reportError("Falta el valor a asignar", $ctx);
                return $this->errorSentinel;
            }
            
            $this->dbg("=== ASIGNACIÓN A VARIABLE SIMPLE ===");
            $this->dbg("Variable: $name");
            
            $value = $this->visit($children[2]);
            if ($value === $this->errorSentinel) return $this->errorSentinel;
            
            try {
                $this->current->assign($name, $value);
                return null;
            } catch (Exception $e) {
                $this->reportError($e->getMessage(), $ctx);
                return $this->errorSentinel;
            }
        }
        
        // ===========================================
        // CASO 4: Error
        // ===========================================
        $this->reportError("Lado izquierdo de asignación no válido", $ctx);
        return $this->errorSentinel;
    }
    public function visitPrimary($ctx)
    {
          $this->dbg('visitPrimary');
    
        if ($ctx === null) {
            $this->reportError("Contexto nulo en visitPrimary", null);
            return $this->errorSentinel;
        }
        
        // Verificar si es un incremento/decremento
        $childCount = $ctx->getChildCount();
        if ($childCount == 2) {
            $lastChild = $ctx->getChild($childCount - 1);
            if ($lastChild) {
                $op = $lastChild->getText();
                if ($op === '++' || $op === '--') {
                    return $this->handleIncrementDecrement($ctx, $op);
                }
            }
        }
        
        if ($ctx === null) {
            $this->reportError("Contexto nulo en visitPrimary", null);
            return $this->errorSentinel;
        }
        
        // Literales
        if ($ctx->INTEGER()) {
            $val = intval($ctx->INTEGER()->getText());
            return $val;
        }

        if ($ctx->FLOAT()) {
            return floatval($ctx->FLOAT()->getText());
        }

        if ($ctx->STRING()) {
            $val = trim($ctx->STRING()->getText(), '"');
            return $val;
        }
        if ($ctx->RUNE()) {  // NUEVO
        $text = $ctx->RUNE()->getText();
        // Quitar las comillas simples y devolver el carácter
        $val = trim($text, "'");
        return $val;
    }

        if ($ctx->TRUE()) { 
            return true; 
        }
        if ($ctx->FALSE()) { 
            return false; 
        }
        
        // ✅ NUEVO: Manejar LEN '(' expression ')'
        if ($ctx->LEN()) {
            $this->dbg("=== LEN() DETECTADO ===");
            
            // Obtener la expresión dentro de len()
            $exprNode = $ctx->expression();
            if ($exprNode === null) {
                $this->reportError("len() requiere un argumento", $ctx);
                return $this->errorSentinel;
            }
            
            // 👇 IMPORTANTE: Manejar cuando expression() devuelve un array
            $arg = null;
            if (is_array($exprNode)) {
                $this->dbg("expression() es un array con " . count($exprNode) . " elementos");
                if (count($exprNode) > 0) {
                    $arg = $this->visit($exprNode[0]);
                }
            } else {
                $arg = $this->visit($exprNode);
            }
            
            if ($arg === $this->errorSentinel) return $this->errorSentinel;
            
            $this->dbg("len() argumento: " . json_encode($arg));
            $this->dbg("len() argumento tipo: " . gettype($arg));
            
            // Llamar a la función built-in len()
            return $this->callBuiltin('len', [$arg], $ctx);
        }
        
        // Llamada a función normal (IDENTIFIER '(' argumentList? ')')
        // En visitPrimary, cuando detectas una llamada a función:
            if ($ctx->getChildCount() > 1 && $ctx->getChild(1)->getText() === '(' && ((method_exists($ctx, 'qualified') && $ctx->qualified()) || (method_exists($ctx, 'IDENTIFIER') && $ctx->IDENTIFIER()))) {
            $name = $this->resolveQualifiedName($ctx);
            $this->dbg("=== LLAMADA A FUNCIÓN: $name ===");

            $args = [];
            if ($ctx->argumentList()) {
                $argExprs = $ctx->argumentList()->expression();

                if (is_array($argExprs)) {
                    foreach ($argExprs as $e) {
                        if ($e === null) continue;
                        $v = $this->visit($e);
                        if ($v === $this->errorSentinel) return $this->errorSentinel;
                        $args[] = $v;
                    }
                } else if ($argExprs !== null) {
                    $v = $this->visit($argExprs);
                    if ($v === $this->errorSentinel) return $this->errorSentinel;
                    $args[] = $v;
                }
            }

            $this->dbg("args count: " . count($args));
            $this->dbg("args: " . json_encode($args));

            // Mapear nombres calificados a builtins canónicos (ej. fmt.Println -> println)
            $canonical = $this->mapBuiltinName($name);
            $builtins = ['println','print','typeOf','int','float','bool','string','substr','now','len'];

            if (in_array($canonical, $builtins)) {
                return $this->callBuiltin($canonical, $args, $ctx);
            }
            else if (isset($this->functions[$name])) {
                return $this->callUserFunction($name, $args, $ctx);
            } else if (isset($this->functions[$canonical])) {
                return $this->callUserFunction($canonical, $args, $ctx);
            } else {
                $this->reportError("Función no definida: $name", $ctx);
                return $this->errorSentinel;
            }
        }
        
        // Array access: IDENTIFIER ('[' expression ']')*
        if (((method_exists($ctx, 'IDENTIFIER') && $ctx->IDENTIFIER()) || (method_exists($ctx, 'qualified') && $ctx->qualified())) && $ctx->getChildCount() > 1 && $ctx->getChild(1)->getText() === '[') {
            $name = $this->resolveQualifiedName($ctx);
            
            // Verificar si es un puntero y obtener el nombre real
            $actualName = $name;
            $isPointer = false;
            $pointerInfo = null;
            
            try {
                $varInfo = $this->current->get($name);
                if (is_array($varInfo) && isset($varInfo['isReference']) && $varInfo['isReference']) {
                    $isPointer = true;
                    $actualName = $varInfo['name'];
                    $pointerInfo = $varInfo;
                    $this->dbg("Acceso a arreglo a través de puntero: $name -> $actualName");
                }
            } catch (Exception $e) {
                // Ignorar, ya se manejará el error después
            }
            
            $indices = [];
            $currentChild = 1;
            while ($currentChild < $ctx->getChildCount() && $ctx->getChild($currentChild)->getText() === '[') {
                $idxExpr = $ctx->getChild($currentChild + 1);
                if ($idxExpr === null) {
                    $this->reportError("Expresión de índice nula", $ctx);
                    return $this->errorSentinel;
                }
                
                $idx = null;
                if (is_array($idxExpr)) {
                    if (count($idxExpr) > 0) {
                        $idx = $this->visit($idxExpr[0]);
                    }
                } else {
                    $idx = $this->visit($idxExpr);
                }
                
                if ($idx === $this->errorSentinel) return $this->errorSentinel;
                
                if (!is_int($idx)) {
                    $this->reportError("El índice del arreglo debe ser un entero", $ctx);
                    return $this->errorSentinel;
                }
                
                $indices[] = $idx;
                $currentChild += 3;
            }
            
            // Declarar la variable $array antes de usarla
            $array = null;
            
            try {
                // Si es un puntero, desreferenciar para obtener el array real (maneja índices si existen)
                if ($isPointer) {
                    $this->dbg("Variable puntero detectada, desreferenciando: " . json_encode($varInfo));
                    $array = $this->dereferenceIfNeeded($varInfo, $ctx);
                    $this->dbg("Arreglo desreferenciado: " . json_encode($array));
                    if ($array === $this->errorSentinel) return $this->errorSentinel;
                } else {
                    // Buscar en el entorno actual (Enviroment->get ya recorre padres si es necesario)
                    $array = $this->current->get($actualName);
                }
                
                if (!is_array($array)) {
                    $this->reportError("$actualName no es un arreglo", $ctx);
                    return $this->errorSentinel;
                }
                
                $value = $array;
                foreach ($indices as $idx) {
                    if (!isset($value[$idx])) {
                        $this->reportError("Índice $idx fuera de rango. Tamaño del arreglo: " . count($value), $ctx);
                        return $this->errorSentinel;
                    }
                    $value = $value[$idx];
                }
                
                return $value;
                
            } catch (Exception $e) {
                $this->reportError("Variable no definida: $actualName", $ctx);
                return $this->errorSentinel;
            }
        }

        // Variable simple
        if ((method_exists($ctx, 'IDENTIFIER') && $ctx->IDENTIFIER()) || (method_exists($ctx, 'qualified') && $ctx->qualified())) {
            $name = $this->resolveQualifiedName($ctx);
            try {
                $value = $this->current->get($name);
                
                // Si el valor es una referencia, devolverla tal cual
                if (is_array($value) && isset($value['isReference'])) {
                    $this->dbg("Variable $name es referencia: " . json_encode($value));
                    return $value;
                }
                
                $this->dbg("Variable $name = " . json_encode($value));
                return $value;
            } catch (Exception $e) {
                $this->reportError("Variable no definida: $name", $ctx);
                return $this->errorSentinel;
            }
        }

        // Expresión entre paréntesis
        $expr = $ctx->expression();
        if ($expr) {
            if (is_array($expr)) {
                if (count($expr) > 0 && $expr[0] !== null) {
                    return $this->visit($expr[0]);
                }
            } else {
                return $this->visit($expr);
            }
        }
        
        return null;
    }

    public function visitUnary($ctx)
    {
        if ($ctx->getChildCount() == 2) {
            $operator = $ctx->getChild(0)->getText();
            
            // Obtener operand correctamente
            $operand = $ctx->unary();
            if ($operand === null) {
                $operand = $ctx->primary();
            }
            
            // VERIFICACIÓN: Asegurar que operand no sea null
            if ($operand === null) {
                $this->reportError("Operando nulo en expresión unaria", $ctx);
                return $this->errorSentinel;
            }

            if ($operator == '-') {
                $value = $this->visit($operand);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                $t = $this->typeOfValue($value);
                if (!in_array($t, [self::TYPE_INT, self::TYPE_FLOAT, self::TYPE_RUNE])) {
                    $this->reportError("Unary '-' requires numeric operand, got $t", $ctx);
                    return $this->errorSentinel;
                }
                return -$value;
            }

            if ($operator == '!') {
                $value = $this->visit($operand);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                $t = $this->typeOfValue($value);
                if ($t !== self::TYPE_BOOL) {
                    $this->reportError("Unary '!' requires boolean operand, got $t", $ctx);
                    return $this->errorSentinel;
                }
                return !$value;
            }
            
            if ($operator == '&') {
            $this->dbg("=== & OPERATOR ===");
            
            // Necesitamos navegar hasta encontrar el IDENTIFIER y posibles índices (ej. arr[...])
            $current = $operand;
            $varName = null;
            $primaryCtx = null;

            if ($current instanceof \Context\PrimaryContext) {
                $primaryCtx = $current;
            } else if ($current instanceof \Context\UnaryContext) {
                $p = $current->primary();
                if ($p instanceof \Context\PrimaryContext) $primaryCtx = $p;
            }

            if ($primaryCtx !== null) {
                $identifier = $primaryCtx->IDENTIFIER();
                if ($identifier) {
                    $varName = $identifier->getText();
                }
            }

            if ($varName) {
                $this->dbg("Variable encontrada: $varName");

                try {
                    // Verificar que la variable existe
                    $this->current->get($varName);

                    // Crear y retornar la referencia
                    $ref = [
                        'isReference' => true,
                        'name' => $varName
                    ];

                    // Soportar referencias a elementos de arreglos: &arr[expr]
                    if ($primaryCtx !== null) {
                        $childCount = $primaryCtx->getChildCount();
                        $idxPos = 1;
                        $indices = [];
                        while ($idxPos < $childCount && $primaryCtx->getChild($idxPos)->getText() === '[') {
                            $idxExpr = $primaryCtx->getChild($idxPos + 1);
                            if ($idxExpr === null) {
                                $this->reportError("Expresión de índice nula en referencia &", $ctx);
                                return $this->errorSentinel;
                            }

                            $idxVal = $this->visit($idxExpr);
                            if ($idxVal === $this->errorSentinel) return $this->errorSentinel;
                            if (!is_int($idxVal)) {
                                $this->reportError("El índice del arreglo debe ser un entero en referencia &", $ctx);
                                return $this->errorSentinel;
                            }
                            $indices[] = $idxVal;
                            $idxPos += 3; // saltar [ expr ]
                        }

                        if (!empty($indices)) {
                            $ref['indices'] = $indices;
                        }
                    }

                    $this->dbg("Referencia creada: " . json_encode($ref));
                    return $ref;

                } catch (Exception $e) {
                    $this->reportError("Variable no definida: $varName", $ctx);
                    return $this->errorSentinel;
                }
            }
            
            $this->reportError("Operador & solo puede aplicarse a variables", $ctx);
            return $this->errorSentinel;
        }
                
            if ($operator == '*') {
                $this->dbg("=== * OPERATOR ===");
                
                $operandValue = $this->visit($operand);
                if ($operandValue === $this->errorSentinel) return $this->errorSentinel;
                
                $this->dbg("Operando valor: " . json_encode($operandValue));
                
                // Si ya es un valor directo, devolverlo inmediatamente
                if (!is_array($operandValue) || !isset($operandValue['isReference'])) {
                    return $operandValue;
                }
                
                // Desreferenciar recursivamente
                $result = $this->dereferenceIfNeeded($operandValue, $ctx);
                
                if ($result === $this->errorSentinel) {
                    return $this->errorSentinel;
                }
                
                $this->dbg("Resultado final: " . json_encode($result));
                
                // IMPORTANTE: Limpiar cualquier estado residual
                return $result;
            }
        }

        // Caso: unary -> primary
        $primary = $ctx->primary();
        if ($primary === null) {
            $this->reportError("Expresión primaria nula", $ctx);
            return $this->errorSentinel;
        }
        
        return $this->visit($primary);
    }
    // Built-in function dispatcher
    private function callBuiltin(string $name, array $args, $ctx)
    {
        switch ($name) {
            case 'print':
            case 'println':
                $addNewline = ($name === 'println' || $name === 'print');
                $out = [];
                foreach ($args as $a) {
                    if ($a === $this->errorSentinel) return $this->errorSentinel;

                    if (is_array($a) && isset($a['isReference']) && $a['isReference']) {
                        try {
                            $valorReal = $this->current->get($a['name']);
                            while (is_array($valorReal) && isset($valorReal['isReference']) && $valorReal['isReference']) {
                                $valorReal = $this->current->get($valorReal['name']);
                            }
                            $a = $valorReal;
                        } catch (Exception $e) {
                            $a = 'nil';
                        }
                    }

                    if (is_bool($a)) {
                        $out[] = $a ? 'true' : 'false';
                    } elseif ($a === null) {
                        $out[] = 'nil';
                    } elseif (is_array($a)) {
                        if (isset($a['isReference'])) {
                            $out[] = '&' . $a['name'];
                        } else {
                            $elements = [];
                            foreach ($a as $elem) {
                                if (is_bool($elem)) $elements[] = $elem ? 'true' : 'false';
                                elseif ($elem === null) $elements[] = 'nil';
                                else $elements[] = (string)$elem;
                            }
                            $out[] = '[' . implode(', ', $elements) . ']';
                        }
                    } else {
                        $out[] = (string)$a;
                    }
                }
                $outputStr = implode(' ', $out);
                if ($addNewline) $outputStr .= "\n";
                echo $outputStr;
                return null;

            case 'substr':
                if (count($args) != 3) {
                    $this->reportError("substr() requiere 3 argumentos: string, inicio, longitud", $ctx);
                    return $this->errorSentinel;
                }
                
                $str = $args[0];
                $start = $args[1];
                $length = $args[2];
                
                if (!is_string($str)) {
                    $this->reportError("substr() primer argumento debe ser string, got " . $this->typeOfValue($str), $ctx);
                    return $this->errorSentinel;
                }
                
                if (!is_int($start) || !is_int($length)) {
                    $this->reportError("substr() inicio y longitud deben ser enteros", $ctx);
                    return $this->errorSentinel;
                }
                
                if ($start < 0 || $length < 0 || $start >= strlen($str)) {
                    $this->reportError("substr() índices fuera de rango", $ctx);
                    return $this->errorSentinel;
                }
                
                return substr($str, $start, $length);

            case 'now':
                if (count($args) != 0) {
                    $this->reportError("now() no requiere argumentos", $ctx);
                    return $this->errorSentinel;
                }
                return date('Y-m-d H:i:s');

            case 'len':
                 $this->dbg("=== callBuiltin: len() ===");
                $this->dbg("args: " . json_encode($args));
                $this->dbg("args[0] type: " . gettype($args[0]));
                
                if (count($args) != 1) {
                    $this->reportError("len() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                $v = $args[0];
                
                if (is_string($v)) {
                    $result = strlen($v);
                    $this->dbg("len(string) = " . $result);
                    return $result;
                }
                if (is_array($v)) {
                    $result = count($v);
                    $this->dbg("len(array) = " . $result);
                    return $result;
                }
                $this->reportError("len() requires string or array, got " . $this->typeOfValue($v), $ctx);
                return $this->errorSentinel;

            case 'typeOf':
                if (count($args) != 1) {
                    $this->reportError("typeOf() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                return $this->typeOfValue($args[0]);

            case 'int':
                if (count($args) != 1) {
                    $this->reportError("int() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                $v = $args[0];
                if (is_int($v)) return $v;
                if (is_float($v)) return (int)$v;
                if (is_bool($v)) return $v ? 1 : 0;
                if (is_string($v)) {
                    if (is_numeric($v)) return intval($v);
                    // Si es un rune (carácter individual)
                    if (strlen($v) === 1) return ord($v);
                    $this->reportError("Cannot convert string to int: non-numeric", $ctx);
                    return $this->errorSentinel;
                }
                $this->reportError("int() unsupported conversion from " . $this->typeOfValue($v), $ctx);
                return $this->errorSentinel;

            case 'float':
                if (count($args) != 1) {
                    $this->reportError("float() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                $v = $args[0];
                if (is_float($v)) return $v;
                if (is_int($v)) return (float)$v;
                if (is_bool($v)) return $v ? 1.0 : 0.0;
                if (is_string($v)) {
                    if (is_numeric($v)) return floatval($v);
                    $this->reportError("Cannot convert string to float: non-numeric", $ctx);
                    return $this->errorSentinel;
                }
                $this->reportError("float() unsupported conversion from " . $this->typeOfValue($v), $ctx);
                return $this->errorSentinel;

            case 'bool':
                if (count($args) != 1) {
                    $this->reportError("bool() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                $v = $args[0];
                if (is_bool($v)) return $v;
                return (bool)$v;

            case 'string':
                if (count($args) != 1) {
                    $this->reportError("string() requires one argument", $ctx);
                    return $this->errorSentinel;
                }
                $v = $args[0];
                if (is_string($v)) return $v;
                if (is_bool($v)) return $v ? 'true' : 'false';
                if ($v === null) return 'nil';
                if (is_array($v)) {
                    if (isset($v['isReference'])) {
                        return '&' . $v['name'];
                    }
                    return json_encode($v);
                }
                return (string)$v;

            default:
                $this->reportError("Unknown builtin function: $name", $ctx);
                return $this->errorSentinel;
        }
    }

    public function callUserFunction(string $name, array $args, $ctx)
    {
        $this->dbg("=== callUserFunction: $name ===");
        
        if (!isset($this->functions[$name])) {
            $this->reportError("Función no definida: $name", $ctx);
            return $this->errorSentinel;
        }
        
        $func = $this->functions[$name];
        
        if (count($args) != count($func['params'])) {
            $this->reportError("La función '$name' espera " . count($func['params']) . 
                            " argumentos, pero recibió " . count($args), $ctx);
            return $this->errorSentinel;
        }
        
        $previous = $this->current;
        $this->current = new Enviroment($previous);
        
        // Pasar parámetros
        foreach ($func['params'] as $index => $param) {
            $paramName = $param['name'];
            $paramType = $param['type'];
            $argValue = $args[$index];
            
              // Si es un puntero a arreglo
            if ($paramType !== null && strpos($paramType, '*') === 0 && strpos($paramType, '[') !== false) {
                $this->dbg("Parámetro puntero a arreglo: $paramName = " . json_encode($argValue));
                // Guardar como puntero, no como valor directo
                $this->current->define($paramName, $argValue, self::TYPE_POINTER, false);
                continue;
            }
            
            // Validar tipo si está especificado (código existente)
            if ($paramType !== null) {
                $argType = $this->typeOfValue($argValue);
                // Si es un array, comparar los tipos completos
                if (strpos($paramType, '[') === 0) {
                    if ($paramType !== $argType) {
                        $this->reportError("Type mismatch in parameter $paramName: expected $paramType, got $argType", $ctx);
                        return $this->errorSentinel;
                    }
                }
                
                if ($paramType === self::TYPE_FLOAT && $argType === self::TYPE_INT) {
                    $argValue = (float)$argValue;
                } else if ($paramType === self::TYPE_INT && $argType === self::TYPE_RUNE) {
                    $argValue = ord($argValue);
                } else if ($paramType === self::TYPE_RUNE && $argType === self::TYPE_INT) {
                    $argValue = chr($argValue);
                } else if ($paramType !== $argType && strpos($paramType, '*') !== 0) {
                    // Para punteros, la validación es diferente
                    if (strpos($paramType, '*') === 0) {
                        // Es puntero, esperamos una referencia
                        if (!(is_array($argValue) && isset($argValue['isReference']))) {
                            $this->reportError("Se esperaba un puntero para el parámetro $paramName", $ctx);
                            return $this->errorSentinel;
                        }
                    } else {
                        $this->reportError("Type mismatch in parameter $paramName: expected $paramType, got $argType", $ctx);
                        return $this->errorSentinel;
                    }
                }
            }
            
            $this->current->define($paramName, $argValue, $paramType, false);
        }
        // DEBUG: mostrar el valor en el entorno padre (si existe) para diagnóstico
        foreach ($func['params'] as $param) {
            $pname = $param['name'];
            try {
                if ($previous) {
                    $pv = $previous->get($pname);
                    $this->dbg("Parent value for param $pname = " . json_encode($pv));
                }
            } catch (Exception $e) {
                // Ignorar
            }
        }
        
        // Ejecutar función
        $result = null;
        try {
            $this->visit($func['block']);
            $result = null; // void
        } catch (ReturnSignal $ret) {
            $result = $ret->getValue();
        }
        
        $this->current = $previous;
        
        // Validar tipos de retorno si hay múltiples
        if (!empty($func['retTypes'])) {
            if (count($func['retTypes']) === 1) {
                // Retorno simple
                $expectedType = $func['retTypes'][0];
                $actualType = $this->typeOfValue($result);
                
                if ($expectedType === self::TYPE_FLOAT && $actualType === self::TYPE_INT) {
                    $result = (float)$result;
                } else if ($expectedType === self::TYPE_INT && $actualType === self::TYPE_RUNE) {
                    $result = ord($result);
                } else if ($expectedType === self::TYPE_RUNE && $actualType === self::TYPE_INT) {
                    $result = chr($result);
                } else if ($expectedType !== $actualType && $expectedType !== self::TYPE_NIL) {
                    $this->reportError("Tipo de retorno incorrecto. Esperado: $expectedType, obtenido: $actualType", $ctx);
                    return $this->errorSentinel;
                }
            } else {
                // Múltiples retornos
                if (!is_array($result) || count($result) !== count($func['retTypes'])) {
                    $this->reportError("La función debe retornar " . count($func['retTypes']) . " valores", $ctx);
                    return $this->errorSentinel;
                }
                
                foreach ($result as $i => $val) {
                    $expectedType = $func['retTypes'][$i];
                    $actualType = $this->typeOfValue($val);
                    
                    if ($expectedType === self::TYPE_FLOAT && $actualType === self::TYPE_INT) {
                        $result[$i] = (float)$val;
                    } else if ($expectedType === self::TYPE_INT && $actualType === self::TYPE_RUNE) {
                        $result[$i] = ord($val);
                    } else if ($expectedType === self::TYPE_RUNE && $actualType === self::TYPE_INT) {
                        $result[$i] = chr($val);
                    } else if ($expectedType !== $actualType) {
                        $this->reportError("Tipo incorrecto en retorno $i. Esperado: $expectedType, obtenido: $actualType", $ctx);
                        return $this->errorSentinel;
                    }
                }
            }
        }
        
        return $result;
    }

    public function visitBlock($ctx)
    {
        $previous = $this->current;
        $this->current = new Enviroment($previous);
        
        try {
            foreach($ctx->statement() as $stmt){
                $this->dbg("Procesando statement en block");
                $this->visit($stmt);
                // Después de cada statement, resetear cualquier estado pendiente
            }
        } catch (ReturnSignal $r){
            $this->current = $previous;
            throw $r;
        } catch(BreakSignal $b){
            $this->current = $previous;
            throw $b;
        } catch(ContinueSignal $c){
            $this->current = $previous;
            throw $c;
        }
        
        $this->current = $previous;
        return null;
    }

    public function visitIfStmt($ctx)
    {
        $cond = $this->visit($ctx->expression());
        if ($cond === $this->errorSentinel) return $this->errorSentinel;
        
        $t = $this->typeOfValue($cond);
        if ($t !== self::TYPE_BOOL) {
            $this->reportError("If condition must be boolean, got $t", $ctx);
            return $this->errorSentinel;
        }
        
        if ($cond === true) {
            $this->visit($ctx->block(0));
        } else {
            if ($ctx->block(1)) {
                $this->visit($ctx->block(1));
            }
        }
        return null;
    }
    public function visitSwitchStmt($ctx)
    {
        $this->dbg("=== visitSwitchStmt ===");
        
        // Obtener la expresión del switch (puede ser null)
        $exprNode = $ctx->expression();
        $switchValue = null;
        
        if ($exprNode) {
            $switchValue = $this->visit($exprNode);
            if ($switchValue === $this->errorSentinel) return $this->errorSentinel;
            $this->dbg("Switch expression = " . var_export($switchValue, true));
        }
        
        // Buscar todos los casos y el default
        $cases = [];
        $defaultBlock = null;
        
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            
            if ($child instanceof \Context\SwitchCaseContext) {
                // Es un caso
                $caseValues = [];
                
                // Obtener todas las expresiones del caso
                $caseExprs = $child->expression();
                if (is_array($caseExprs)) {
                    foreach ($caseExprs as $caseExpr) {
                        $val = $this->visit($caseExpr);
                        if ($val === $this->errorSentinel) return $this->errorSentinel;
                        $caseValues[] = $val;
                    }
                } else if ($caseExprs) {
                    $val = $this->visit($caseExprs);
                    if ($val === $this->errorSentinel) return $this->errorSentinel;
                    $caseValues[] = $val;
                }
                
                // Obtener el bloque del caso (puede ser null si la gramática usa statement+)
                $block = null;
                $statements = null;
                if (method_exists($child, 'block') && $child->block()) {
                    $block = $child->block();
                } else if (method_exists($child, 'statement') && $child->statement()) {
                    $statements = $child->statement();
                }

                $cases[] = [
                    'values' => $caseValues,
                    'block' => $block,
                    'statements' => $statements
                ];
                
                $this->dbg("Caso con valores: " . json_encode($caseValues));
                
            } else if ($child instanceof \Context\DefaultContext) {
                // Es el caso default (puede ser block o statement+)
                if (method_exists($child, 'block') && $child->block()) {
                    $defaultBlock = ['block' => $child->block(), 'statements' => null];
                } else if (method_exists($child, 'statement') && $child->statement()) {
                    $defaultBlock = ['block' => null, 'statements' => $child->statement()];
                }
                $this->dbg("Caso default encontrado");
            }
        }
        
        // Evaluar el switch
        $matched = false;
        
        foreach ($cases as $case) {
            foreach ($case['values'] as $caseValue) {
                if ($switchValue == $caseValue) {
                    $this->dbg("Caso coincide, ejecutando bloque/statement(s)");
                    if ($case['block']) {
                        $this->visit($case['block']);
                    } else if ($case['statements']) {
                        // Ejecutar cada statement del caso
                        foreach ($case['statements'] as $st) {
                            $res = $this->visit($st);
                            if ($res === $this->errorSentinel) return $this->errorSentinel;
                        }
                    }
                    $matched = true;
                    break 2; // Salir de ambos loops
                }
            }
        }
        
        // Si no hubo match y hay default, ejecutarlo
        if (!$matched && $defaultBlock) {
            $this->dbg("Ejecutando default");
            if ($defaultBlock['block']) {
                $this->visit($defaultBlock['block']);
            } else if ($defaultBlock['statements']) {
                foreach ($defaultBlock['statements'] as $st) {
                    $res = $this->visit($st);
                    if ($res === $this->errorSentinel) return $this->errorSentinel;
                }
            }
        }
        
        return null;
    }
    private $loopCounter = 0;

    public function visitForStmt($ctx)
    {
        $this->dbg("=== visitForStmt ===");
         $this->loopCounter++;
        if ($this->loopCounter > 10000) {
            $this->dbg("POSIBLE BUCLE INFINITO: más de 10000 iteraciones");
            // Podrías lanzar una excepción o simplemente continuar
        }
        // Detectar tipo de for
        $hasInit = $ctx->shortVarDecl() !== null;
        
        if ($hasInit) {
            // for con inicialización: for shortVarDecl ';' expression ';' expression? block
            $this->dbg("For con inicialización detectado");
            
            // Ejecutar inicialización
            $this->visit($ctx->shortVarDecl());
            
            // Buscar la condición, el post y el bloque
            $children = [];
            for ($i = 0; $i < $ctx->getChildCount(); $i++) {
                $children[] = $ctx->getChild($i);
            }
            
            // Buscar el bloque de múltiples formas
            $blockNode = null;

            // Forma 1: Buscar desde el final (el último hijo que sea un bloque)
            for ($i = count($children) - 1; $i >= 0; $i--) {
                $child = $children[$i];
                if ($child instanceof \Context\BlockContext) {
                    $blockNode = $child;
                    $this->dbg("Bloque encontrado (forma 1) al final");
                    break;
                }
            }

            // Forma 2: Buscar cualquier hijo que sea un bloque
            if (!$blockNode) {
                foreach ($children as $child) {
                    if ($child instanceof \Context\BlockContext) {
                        $blockNode = $child;
                        $this->dbg("Bloque encontrado (forma 2) en posición " . array_search($child, $children));
                        break;
                    }
                }
            }

            // Forma 3: El último hijo podría ser un statement que contiene un bloque
            if (!$blockNode && !empty($children)) {
                $lastChild = $children[count($children) - 1];
                if ($lastChild instanceof \Context\StatementContext) {
                    // Intentar obtener el bloque del statement
                    for ($i = 0; $i < $lastChild->getChildCount(); $i++) {
                        $subChild = $lastChild->getChild($i);
                        if ($subChild instanceof \Context\BlockContext) {
                            $blockNode = $subChild;
                            $this->dbg("Bloque encontrado (forma 3) dentro del último statement");
                            break;
                        }
                    }
                }
            }

            // Forma 4: Buscar por texto (último recurso)
            if (!$blockNode) {
                foreach ($children as $index => $child) {
                    if ($child && strpos($child->getText(), '{') === 0) {
                        // Parece ser un bloque por su texto
                        $blockNode = $child;
                        $this->dbg("Bloque encontrado (forma 4) por texto en posición $index");
                        break;
                    }
                }
            }

            $this->dbg("Block: " . ($blockNode ? 'encontrado' : 'no encontrado'));
            
            // Encontrar los puntos y coma
            $semicolonPositions = [];
            foreach ($children as $idx => $child) {
                if ($child->getText() === ';') {
                    $semicolonPositions[] = $idx;
                }
            }
            
            $this->dbg("Posiciones de ;: " . json_encode($semicolonPositions));
            
            if (count($semicolonPositions) >= 2) {
                // La condición está entre el primer y segundo ;
                $condStart = $semicolonPositions[0] + 1;
                $condEnd = $semicolonPositions[1];
                $condNodes = array_slice($children, $condStart, $condEnd - $condStart);
                
                // El post está después del segundo ;
                $postStart = $semicolonPositions[1] + 1;
                $postNodes = array_slice($children, $postStart);
                
                // Quitar el bloque del post si está al final
                if (!empty($postNodes) && end($postNodes) instanceof GolampiParser\BlockContext) {
                    array_pop($postNodes);
                }
                
                $condNode = !empty($condNodes) ? $condNodes[0] : null;
                $postNode = !empty($postNodes) ? $postNodes[0] : null;
                
                $this->dbg("Condición: " . ($condNode ? $condNode->getText() : 'ninguna'));
                $this->dbg("Post: " . ($postNode ? $postNode->getText() : 'ninguno'));
                $this->dbg("Block: " . ($blockNode ? 'encontrado' : 'no encontrado'));
                
                // Bucle principal
                while (true) {
                    // Evaluar condición
                    if ($condNode) {
                        $cond = $this->visit($condNode);
                        if ($cond === $this->errorSentinel) return $this->errorSentinel;
                        
                        $t = $this->typeOfValue($cond);
                        if ($t !== self::TYPE_BOOL) {
                            $this->reportError("For condition must be boolean, got $t", $ctx);
                            return $this->errorSentinel;
                        }
                        
                        if ($cond === false) break;
                    }
                    
                    // Ejecutar cuerpo
                    if ($blockNode) {
                        try {
                            $this->visit($blockNode);
                        } catch (ContinueSignal $c) {
                            // continuar con post
                        } catch (BreakSignal $b) {
                            break;
                        }
                    } else {
                        $this->dbg("ERROR: No se encontró el bloque del for");
                        break;
                    }
                    
                    // Ejecutar post (incremento)
                    if ($postNode) {
                        $this->dbg("Ejecutando post: " . $postNode->getText());
                        $this->visit($postNode);
                    }
                }
            }
        } else {
            // for simple: for expression? block
            $this->dbg("For simple detectado");
            
            $blockNode = $ctx->block();
            
            while (true) {
                if ($ctx->expression()) {
                    $cond = $this->visit($ctx->expression());
                    if ($cond === $this->errorSentinel) return $this->errorSentinel;
                    
                    $t = $this->typeOfValue($cond);
                    if ($t !== self::TYPE_BOOL) {
                        $this->reportError("For condition must be boolean, got $t", $ctx);
                        return $this->errorSentinel;
                    }
                    
                    if ($cond === false) break;
                }
                
                try {
                    $this->visit($blockNode);
                } catch (ContinueSignal $c) {
                    continue;
                } catch (BreakSignal $b) {
                    break;
                }
            }
        }
        
        return null;
    }
    public function visitBreakStmt($ctx)
    {
        throw new BreakSignal();
    }

    public function visitContinueStmt($ctx)
    {
        throw new ContinueSignal();
    }

    public function visitReturnStmt($ctx)
    {
        $values = [];
        
        // Recolectar valores de retorno
        if ($ctx->expression()) {
            $exprs = $ctx->expression();
            if (is_array($exprs)) {
                foreach ($exprs as $expr) {
                    $val = $this->visit($expr);
                    if ($val === $this->errorSentinel) return $this->errorSentinel;
                    $values[] = $val;
                }
            } else {
                $val = $this->visit($exprs);
                if ($val === $this->errorSentinel) return $this->errorSentinel;
                $values[] = $val;
            }
        }
        
        if (count($values) === 0) {
            throw new ReturnSignal(null);
        } else if (count($values) === 1) {
            throw new ReturnSignal($values[0]);
        } else {
            throw new ReturnSignal($values);
        }
    }

    public function visitAddition($ctx)
    {
        $result = $this->visit($ctx->unary(0));
        if ($result === $this->errorSentinel) return $this->errorSentinel;

        for ($i = 1; $i < count($ctx->unary()); $i++) {
            $right = $this->visit($ctx->unary($i));
            if ($right === $this->errorSentinel) return $this->errorSentinel;

            $operator = $ctx->getChild(2 * $i - 1)->getText();

            // Desreferenciar si es necesario
            $leftVal = $this->dereferenceIfNeeded($result, $ctx);
            $rightVal = $this->dereferenceIfNeeded($right, $ctx);
            
            if ($leftVal === $this->errorSentinel || $rightVal === $this->errorSentinel) {
                return $this->errorSentinel;
            }

            // Convertir runes a sus valores numéricos para operaciones
            $leftType = $this->typeOfValue($leftVal);
            $rightType = $this->typeOfValue($rightVal);
            
            // Preparar valores para operación
            $leftNum = $leftVal;
            $rightNum = $rightVal;
            
            // Convertir runes a su código ASCII
            if ($leftType === self::TYPE_RUNE) {
                $leftNum = ord($leftVal);
            }
            if ($rightType === self::TYPE_RUNE) {
                $rightNum = ord($rightVal);
            }

            if ($operator == '+') {
                // Concatenación de strings (solo si ambos son strings)
                if (is_string($leftVal) && is_string($rightVal) && 
                    $leftType === self::TYPE_STRING && $rightType === self::TYPE_STRING) {
                    $result = $leftVal . $rightVal;
                } 
                // Suma numérica (incluyendo runes convertidos)
                else if (is_numeric($leftNum) && is_numeric($rightNum)) {
                    list($l, $r, $type) = $this->coerceNumeric($leftNum, $rightNum);
                    $result = $l + $r;
                } else {
                    $this->reportError("Incompatible types for '+'", $ctx);
                    return $this->errorSentinel;
                }
            } else { // '-'
                if (is_numeric($leftNum) && is_numeric($rightNum)) {
                    list($l, $r, $type) = $this->coerceNumeric($leftNum, $rightNum);
                    $result = $l - $r;
                } else {
                    $this->reportError("Incompatible types for '-'", $ctx);
                    return $this->errorSentinel;
                }
            }
        }

        return $result;
    }

    public function visitMultiplication($ctx)
    {
        // ===========================================
        // ✅ CAMBIO: Detectar desreferencia múltiple (*, **, ***, etc.)
        // ===========================================
        $childCount = $ctx->getChildCount();
        
        // Contar cuántos '*' hay al inicio
        $dereferenceCount = 0;
        for ($i = 0; $i < $childCount; $i++) {
            $child = $ctx->getChild($i);
            if ($child && $child->getText() === '*') {
                $dereferenceCount++;
            } else {
                break;
            }
        }
        
        // Si hay al menos un '*' al inicio, es una desreferencia
        if ($dereferenceCount > 0) {
            // Obtener el operando (después de todos los '*')
            $operandIndex = $dereferenceCount;
            if ($operandIndex < $childCount) {
                $operand = $ctx->getChild($operandIndex);
                $value = $this->visit($operand);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                
                // Desreferenciar múltiples veces
                for ($i = 0; $i < $dereferenceCount; $i++) {
                    if (is_array($value) && isset($value['isReference']) && $value['isReference']) {
                        try {
                            $value = $this->current->get($value['name']);
                        } catch (Exception $e) {
                            $this->reportError("No se puede desreferenciar: variable {$value['name']} no encontrada", $ctx);
                            return $this->errorSentinel;
                        }
                    } else {
                        $this->reportError("Operador * usado con valor no puntero", $ctx);
                        return $this->errorSentinel;
                    }
                }
                
                return $value;
            }
        }
        
        // ===========================================
        // CASO NORMAL: Multiplicación (*, /, %)
        // ===========================================
        $result = $this->visit($ctx->addition(0));
        if ($result === $this->errorSentinel) return $this->errorSentinel;

        for ($i = 1; $i < count($ctx->addition()); $i++) {
            $right = $this->visit($ctx->addition($i));
            if ($right === $this->errorSentinel) return $this->errorSentinel;

            $operator = $ctx->getChild(2 * $i - 1)->getText();

            // Desreferenciar si es necesario
            $leftVal = $this->dereferenceIfNeeded($result, $ctx);
            $rightVal = $this->dereferenceIfNeeded($right, $ctx);
            
            if ($leftVal === $this->errorSentinel || $rightVal === $this->errorSentinel) {
                return $this->errorSentinel;
            }

            // Convertir runes a sus valores numéricos
            $leftType = $this->typeOfValue($leftVal);
            $rightType = $this->typeOfValue($rightVal);
            
            $leftNum = $leftVal;
            $rightNum = $rightVal;
            
            if ($leftType === self::TYPE_RUNE) {
                $leftNum = ord($leftVal);
            }
            if ($rightType === self::TYPE_RUNE) {
                $rightNum = ord($rightVal);
            }

            if (!is_numeric($leftNum) || !is_numeric($rightNum)) {
                $this->reportError("Incompatible types for '$operator'", $ctx);
                return $this->errorSentinel;
            }

            list($l, $r, $type) = $this->coerceNumeric($leftNum, $rightNum);

            switch ($operator) {
                case '*':
                    $result = $l * $r;
                    break;
                case '/':
                    if ($r == 0) {
                        $this->reportError("Division by zero", $ctx);
                        return $this->errorSentinel;
                    }
                    $result = $l / $r;
                    break;
                case '%':
                    if ($type !== self::TYPE_INT) {
                        $this->reportError("Modulo requires integer operands", $ctx);
                        return $this->errorSentinel;
                    }
                    if ($r == 0) {
                        $this->reportError("Modulo by zero", $ctx);
                        return $this->errorSentinel;
                    }
                    $result = $l % $r;
                    break;
            }
        }

        return $result;
    }
    public function visitComparison($ctx)
    {
        if (count($ctx->addition()) === 1) {
            return $this->visit($ctx->addition(0));
        }
        
        $left = $this->visit($ctx->addition(0));
        if ($left === $this->errorSentinel) return $this->errorSentinel;

        for ($i = 1; $i < count($ctx->addition()); $i++) {
            $right = $this->visit($ctx->addition($i));
            if ($right === $this->errorSentinel) return $this->errorSentinel;
            
            $operator = $ctx->getChild(2 * $i - 1)->getText();

            // Comparación numérica
            if (is_numeric($left) && is_numeric($right)) {
                list($l, $r, $type) = $this->coerceNumeric($left, $right);
                
                switch ($operator) {
                    case '>': $result = $l > $r; break;
                    case '<': $result = $l < $r; break;
                    case '>=': $result = $l >= $r; break;
                    case '<=': $result = $l <= $r; break;
                }
            }
            // Comparación de strings
            else if (is_string($left) && is_string($right)) {
                switch ($operator) {
                    case '>': $result = $left > $right; break;
                    case '<': $result = $left < $right; break;
                    case '>=': $result = $left >= $right; break;
                    case '<=': $result = $left <= $right; break;
                }
            } else {
                $this->reportError("Incompatible types for comparison", $ctx);
                return $this->errorSentinel;
            }

            if (!$result) {
                return false;
            }
            $left = $right;
        }

        return true;
    }

    public function visitEquality($ctx)
    {
        if (count($ctx->comparison()) === 1) {
            return $this->visit($ctx->comparison(0));
        }
        
        $left = $this->visit($ctx->comparison(0));
        if ($left === $this->errorSentinel) return $this->errorSentinel;

        for ($i = 1; $i < count($ctx->comparison()); $i++) {
            $right = $this->visit($ctx->comparison($i));
            if ($right === $this->errorSentinel) return $this->errorSentinel;
            
            $operator = $ctx->getChild(2 * $i - 1)->getText();

            if ($operator == '==') {
                if ($left != $right) return false;
            } else { // '!='
                if ($left == $right) return false;
            }

            $left = $right;
        }

        return true;
    }

    public function visitLogicalAnd($ctx)
    {
        if (count($ctx->equality()) === 1) {
            return $this->visit($ctx->equality(0));
        }
        
        for ($i = 0; $i < count($ctx->equality()); $i++) {
            $val = $this->visit($ctx->equality($i));
            if ($val === $this->errorSentinel) return $this->errorSentinel;
            
            if (!is_bool($val)) {
                $this->reportError("Logical && requires boolean operands", $ctx);
                return $this->errorSentinel;
            }
            
            // Short-circuit
            if ($val === false) {
                return false;
            }
        }

        return true;
    }

    public function visitLogicalOr($ctx)
    {
        if (count($ctx->logicalAnd()) === 1) {
            return $this->visit($ctx->logicalAnd(0));
        }
        
        for ($i = 0; $i < count($ctx->logicalAnd()); $i++) {
            $val = $this->visit($ctx->logicalAnd($i));
            if ($val === $this->errorSentinel) return $this->errorSentinel;
            
            if (!is_bool($val)) {
                $this->reportError("Logical || requires boolean operands", $ctx);
                return $this->errorSentinel;
            }
            
            // Short-circuit
            if ($val === true) {
                return true;
            }
        }

        return false;
    }

    public function visitExpresionStmt($ctx)
    {
        $this->dbg("=== visitExpresionStmt ===");
        
        // Obtener la expresión
        $exprNode = $ctx->expression();
        
        // Si hay múltiples hijos, podría ser que haya saltos de línea
        if (is_array($exprNode)) {
            $this->dbg("Expresión es un array con " . count($exprNode) . " elementos");
            // Tomar el primer elemento que no sea null
            foreach ($exprNode as $node) {
                if ($node !== null) {
                    $result = $this->visit($node);
                    if ($result !== $this->errorSentinel) {
                        return $result;
                    }
                }
            }
            return null;
        }
        
        // Si es un solo nodo, visitarlo normalmente
        if ($exprNode) {
            return $this->visit($exprNode);
        }
        
        return null;
    }

    public function visitArrayLiteral($ctx)
    {
        $this->dbg("=== visitArrayLiteral ===");
        
        $array = [];
        
        // Obtener todos los elementos
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            
            // Ignorar '{' y '}'
            if ($child->getText() === '{' || $child->getText() === '}') {
                continue;
            }
            
            // Debug: Ver qué tipo de nodo es
            $this->dbg("  Elemento " . count($array) . ": " . get_class($child));
            
            // Si es un arrayElement (nuevo!)
            if ($child instanceof \Context\ArrayElementContext) {
                $elementValue = $this->visit($child);
                if ($elementValue === $this->errorSentinel) return $this->errorSentinel;
                $array[] = $elementValue;
            }
            // Si es un arrayLiteral anidado
            elseif ($child instanceof \Context\ArrayLiteralContext) {
                $nestedArray = $this->visit($child);
                if ($nestedArray === $this->errorSentinel) return $this->errorSentinel;
                $array[] = $nestedArray;
            }
            // Si es una expresión (valor simple)
            elseif ($child instanceof \Context\ExpressionContext) {
                $value = $this->visit($child);
                if ($value === $this->errorSentinel) return $this->errorSentinel;
                $array[] = $value;
            }
            // Si es un arrayType (para 2D/3D)
            elseif ($child instanceof \Context\ArrayTypeContext) {
                // Ignorar arrayType en el literal
                continue;
            }
            // Si es un terminal node (como '{' o ']')
            elseif ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNodeImpl) {
                continue;
            }
        }
        
        $this->dbg("Array literal con " . count($array) . " elementos");
        
        return $array;
    }

    public function visitType($ctx)
    {
        $text = $ctx->getText();
        
        if (strpos($text, '*') === 0) {
            $this->dbg("Tipo puntero: $text");
            return $text;
        }
        
        if ($ctx->INT()) return self::TYPE_INT;
        if ($ctx->FLOATTYPE()) return self::TYPE_FLOAT;
        if ($ctx->BOOL()) return self::TYPE_BOOL;
        if ($ctx->STRINGTYPE()) return self::TYPE_STRING;
        if ($ctx->RUNETYPE()) return self::TYPE_RUNE;
        
        // Si es un array como [5]int32
        if (preg_match('/^\[\d+\](\w+)$/', $text, $matches)) {
            return $text; // Devuelve el texto completo como tipo
        }
        
        return $text;
    }

    private function getDefaultValue($type)
    {
        switch ($type) {
            case self::TYPE_INT:
            case self::TYPE_RUNE:
                return 0;
            case self::TYPE_FLOAT:
                return 0.0;
            case self::TYPE_BOOL:
                return false;
            case self::TYPE_STRING:
                return "";
            case self::TYPE_ARRAY:
                return [];
            case self::TYPE_NIL:
                return null;
            default:
                return null;
        }
    }
    public function getFunctions(): array
    {
        return $this->functions;
    }
    // Contar dimensiones de un array
    private function countDimensions($array)
    {
        if (!is_array($array) || empty($array)) {
            return 1;
        }
        
        $first = reset($array);
        if (is_array($first) && !isset($first['isReference'])) {
            return 1 + $this->countDimensions($first);
        }
        return 1;
    }
    // Crear array con múltiples dimensiones
    private function createMultiDimensionalArray($sizes, $elementType)
    {
        if (empty($sizes)) {
            return [];
        }
        
        $defaultValue = $this->getDefaultValue($elementType);
        
        // Recursivamente crear el array
        $firstSize = array_shift($sizes);
        $array = array_fill(0, $firstSize, null);
        
        if (empty($sizes)) {
            // Última dimensión
            for ($i = 0; $i < $firstSize; $i++) {
                $array[$i] = $defaultValue;
            }
        } else {
            // Más dimensiones
            for ($i = 0; $i < $firstSize; $i++) {
                $array[$i] = $this->createMultiDimensionalArray($sizes, $elementType);
            }
        }
        
        return $array;
    }
    // Validar estructura del array multidimensional
    private function validateArrayStructure($array, $sizes, $elementType, $ctx)
    {
        // Validación básica: solo verificar que no esté vacío
        if (empty($array)) {
            $this->reportError("Array vacío", $ctx);
            return;
        }
        
        // Para 2D/3D, validar recursivamente
        if (count($sizes) > 1) {
            $expectedSize = $sizes[0];
            
            if (count($array) !== $expectedSize) {
                $this->reportError("Número incorrecto de elementos en dimensión 1. Esperados: $expectedSize, recibidos: " . count($array), $ctx);
                return;
            }
            
            foreach ($array as $i => $element) {
                if (!is_array($element)) {
                    $this->reportError("Elemento $i debe ser un array", $ctx);
                    return;
                }
                // Validar recursivamente
                $this->validateArrayStructure($element, array_slice($sizes, 1), $elementType, $ctx);
            }
        }
    }
    public function visitArrayElement($ctx)
    {
        $this->dbg("=== visitArrayElement ===");
        
        // Si es un arrayLiteral anidado
        if ($ctx->arrayLiteral()) {
            return $this->visit($ctx->arrayLiteral());
        }
        // Si es una expresión
        elseif ($ctx->expression()) {
            return $this->visit($ctx->expression());
        }
        
        return null;
    }

    public function visitLen($ctx)
    {
        $this->dbg("=== visitLen ===");
        $this->dbg("ctx type: " . get_class($ctx));
        
        // Obtener la expresión dentro de len()
        $expr = $ctx->expression();
        if ($expr === null) {
            $this->reportError("len() requiere un argumento", $ctx);
            return $this->errorSentinel;
        }
        
        // Evaluar la expresión
        $value = $this->visit($expr);
        if ($value === $this->errorSentinel) return $this->errorSentinel;
        
        // Verificar si es un array
        if (!is_array($value)) {
            $this->reportError("len() solo funciona con arrays", $ctx);
            return $this->errorSentinel;
        }
        
        // Obtener el tamaño del array
        $length = count($value);
        
        $this->dbg("len() = " . $length);
        
        return $length;
    }
    /**
     * Desreferencia un valor si es una referencia, para operaciones que necesitan el valor real
     */
    private function dereferenceIfNeeded($value, $ctx = null)
    {
        if (is_array($value) && isset($value['isReference']) && $value['isReference']) {
            try {
                // Si la referencia incluye índices (ej. &arr[2]), debemos devolver el elemento apuntado
                if (isset($value['indices']) && is_array($value['indices'])) {
                    $arr = $this->current->get($value['name']);
                    if (!is_array($arr)) {
                        if ($ctx) $this->reportError("No es un arreglo: {$value['name']}", $ctx);
                        return $this->errorSentinel;
                    }

                    $ref = $arr;
                    foreach ($value['indices'] as $idx) {
                        if (!is_int($idx)) {
                            if ($ctx) $this->reportError("Índice no es entero en desreferencia", $ctx);
                            return $this->errorSentinel;
                        }
                        if (!isset($ref[$idx])) {
                            if ($ctx) $this->reportError("Índice $idx fuera de rango al desreferenciar {$value['name']}", $ctx);
                            return $this->errorSentinel;
                        }
                        $ref = $ref[$idx];
                    }

                    return $ref;
                }

                $referenced = $this->current->get($value['name']);
                
                // Si es un puntero a arreglo o una referencia encadenada, seguir desreferenciando
                if (is_array($referenced) && isset($referenced['isReference']) && $referenced['isReference']) {
                    return $this->dereferenceIfNeeded($referenced, $ctx);
                }

                return $referenced;
            } catch (Exception $e) {
                if ($ctx) {
                    $this->reportError("No se puede desreferenciar: variable {$value['name']} no encontrada", $ctx);
                }
                return $this->errorSentinel;
            }
        }
        return $value;
    }
    private function handleIncrementDecrement($ctx, $operator)
    {
         $this->dbg("=== INCREMENT/DECREMENT: $operator ===");
        $this->dbg("Contexto: " . get_class($ctx));
        
        // El operando es el primer hijo (el primary antes de ++/--)
        // Intentar resolver el identificador de varias formas:
        // - $ctx puede ser una PrimaryContext que expose IDENTIFIER()
        // - $ctx puede ser una PrimaryContext cuyo primer hijo sea un TerminalNode (IDENTIFIER)
        // - $ctx puede ser una PrimaryContext cuyo primer hijo sea otra PrimaryContext (postfix)
        $varName = null;
        if (method_exists($ctx, 'IDENTIFIER') && $ctx->IDENTIFIER()) {
            $varName = $ctx->IDENTIFIER()->getText();
        } else {
            $first = $ctx->getChild(0);
            if ($first instanceof \Context\PrimaryContext) {
                if (method_exists($first, 'IDENTIFIER') && $first->IDENTIFIER()) {
                    $varName = $first->IDENTIFIER()->getText();
                } else if (method_exists($first, 'qualified') && $first->qualified()) {
                    $varName = $first->qualified()->getText();
                } else {
                    try {
                        $varName = $first->getText();
                    } catch (Exception $e) {
                        $varName = null;
                    }
                }
            } else if ($first) {
                // Terminal node (IDENTIFIER) or similar
                try {
                    $varName = $first->getText();
                } catch (Exception $e) {
                    $varName = null;
                }
            }
        }

        if (!$varName) {
            $this->reportError("Incremento/decremento solo puede aplicarse a variables", $ctx);
            return $this->errorSentinel;
        }
        
        try {
            // Obtener el valor actual
            $currentValue = $this->current->get($varName);
            $type = $this->typeOfValue($currentValue);
            
            // Validar que sea numérico
            if (!in_array($type, [self::TYPE_INT, self::TYPE_FLOAT, self::TYPE_RUNE])) {
                $this->reportError("Incremento/decremento requiere tipo numérico, got $type", $ctx);
                return $this->errorSentinel;
            }
            
            // Calcular nuevo valor
            $newValue = ($operator === '++') ? $currentValue + 1 : $currentValue - 1;
            
            // Asignar
            $this->current->assign($varName, $newValue);
            
            $this->dbg("$varName $operator = $newValue (era $currentValue)");
            
            // Devolver el valor ANTIGUO (como en C/Java)
            return $currentValue;
            
        } catch (Exception $e) {
            $this->reportError($e->getMessage(), $ctx);
            return $this->errorSentinel;
        }
    }
}