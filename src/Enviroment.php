<?php

class Enviroment {
    // Tipos del lenguaje (igual que en interpreter)
    const TYPE_INT = 'int32';
    const TYPE_FLOAT = 'float32';
    const TYPE_BOOL = 'bool';
    const TYPE_RUNE = 'rune';
    const TYPE_STRING = 'string';
    const TYPE_ARRAY = 'array';
    const TYPE_NIL = 'nil';
    const TYPE_POINTER = 'pointer';

    private $values = [];
    private $parent;
    
    // Para reporte de tabla de símbolos
    private array $symbolTable = [];

    public function __construct($parent = null){
        $this->parent = $parent;
    }

    /**
     * DEFINIR VARIABLE O CONSTANTE
     * @param string $name Nombre del identificador
     * @param mixed $value Valor
     * @param string|null $type Tipo explícito (opcional)
     * @param bool $isConst Si es constante (inmutable)
     * @param array $location Ubicación [line, column] para tabla de símbolos
     */
    public function define($name, $value, $type = null, $isConst = false, $location = null){
        if ($type === null) {
            $type = $this->inferType($value);
        }
        
        // Si es un puntero (representado como array con isReference)
        if (is_array($value) && isset($value['isReference']) && $value['isReference']) {
            $this->values[$name] = [
                'type' => self::TYPE_POINTER,
                'value' => $value,
                'dimensions' => $this->countDimensions($value),
                'pointsTo' => $value['name'],
                'isConst' => $isConst
            ];
        }
        // Si es array, guardamos metadatos
        else if ($type === self::TYPE_ARRAY || $type === 'array' || is_array($value)) {
            $elementType = $this->inferElementType($value);
            $dimensions = $this->countDimensions($value);
            
            $this->values[$name] = [
                'type' => self::TYPE_ARRAY,
                'elementType' => $elementType,
                'dimensions' => $dimensions,
                'value' => $value,
                'isConst' => $isConst
            ];
        } else {
            $this->values[$name] = [
                'type' => $type, 
                'value' => $value, 
                'isConst' => $isConst
            ];
        }
        
        // Registrar en tabla de símbolos para reportes
        $this->symbolTable[] = [
            'identifier' => $name,
            'type' => $type,
            'value' => $this->formatValueForSymbolTable($value),
            'isConst' => $isConst,
            'scope' => $this->getScopeName(),
            'line' => $location ? $location['line'] : null,
            'column' => $location ? $location['column'] : null
        ];

        // Además, si este entorno no es el raíz, también registrar en el entorno raíz
        // para conservar símbolos locales (p. ej. variables dentro de funciones)
        $root = $this;
        while ($root->parent !== null) {
            $root = $root->parent;
        }
        if ($root !== $this) {
            $root->symbolTable[] = [
                'identifier' => $name,
                'type' => $type,
                'value' => $this->formatValueForSymbolTable($value),
                'isConst' => $isConst,
                'scope' => $this->getScopeName(),
                'line' => $location ? $location['line'] : null,
                'column' => $location ? $location['column'] : null
            ];
        }
    }

    /**
     * Formatear valor para mostrar en tabla de símbolos
     */
    private function formatValueForSymbolTable($value) {
        if ($value === null) return 'nil';
        if (is_bool($value)) return $value ? 'true' : 'false';
        if (is_array($value)) {
            if (isset($value['isReference']) && $value['isReference']) {
                return '&' . $value['name'];
            }
            return json_encode($value);
        }
        if (is_string($value)) {
            // Truncar strings largos para la tabla
            if (strlen($value) > 30) {
                return substr($value, 0, 27) . '...';
            }
            return '"' . $value . '"';
        }
        return (string)$value;
    }

    /**
     * Obtener nombre del ámbito actual
     */
    private function getScopeName() {
        if ($this->parent === null) {
            return 'global';
        }
        
        // Intentar determinar el tipo de ámbito
        // Esto es simplificado, idealmente deberías pasar el contexto
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);
        foreach ($trace as $frame) {
            if (isset($frame['function'])) {
                if ($frame['function'] === 'visitBlock') return 'block';
                if ($frame['function'] === 'visitForStmt') return 'for';
                if ($frame['function'] === 'visitIfStmt') return 'if';
                if ($frame['function'] === 'visitFunctionDecl') return 'function';
            }
        }
        return 'local';
    }

    // Inferir tipo runtime (mapeado a constantes del intérprete)
    private function inferType($value){
        if (is_int($value)) return self::TYPE_INT;
        if (is_float($value)) return self::TYPE_FLOAT;
        if (is_bool($value)) return self::TYPE_BOOL;
        if (is_string($value)) {
            // Detectar si es rune (carácter individual)
            if (strlen($value) === 1) {
                return self::TYPE_RUNE;
            }
            return self::TYPE_STRING;
        }
        if (is_array($value)) {
            // Verificar si es un puntero (representación especial)
            if (isset($value['isReference']) && $value['isReference']) {
                return self::TYPE_POINTER;
            }
            return self::TYPE_ARRAY;
        }
        if ($value === null) return self::TYPE_NIL;
        return 'unknown';
    }

    // Inferir tipo de los elementos de un array
    private function inferElementType($array) {
        if (!is_array($array) || empty($array)) return self::TYPE_NIL;
        
        // Tomar el primer elemento como muestra
        $first = reset($array);
        return $this->inferType($first);
    }

    // Contar dimensiones de un array
    private function countDimensions($array) {
        if (!is_array($array) || empty($array)) return 1;
        
        $first = reset($array);
        if (is_array($first) && !isset($first['isReference'])) {
            return 1 + $this->countDimensions($first);
        }
        return 1;
    }

    // BUSCAR VARIABLE
    public function get($name){
        if(array_key_exists($name, $this->values)){
            return $this->values[$name]['value'];
        }

        if ($this->parent !== null){
            return $this->parent->get($name);
        }

        throw new Exception("Variable no definida: $name");
    }

    // Obtener tipo de variable
    public function getType($name){
        if(array_key_exists($name, $this->values)){
            return $this->values[$name]['type'];
        }

        if ($this->parent !== null){
            return $this->parent->getType($name);
        }

        throw new Exception("Variable no definida: $name");
    }

    // Verificar si es constante
    public function isConstant($name) {
        if(array_key_exists($name, $this->values)) {
            return isset($this->values[$name]['isConst']) && $this->values[$name]['isConst'];
        }
        if ($this->parent !== null){
            return $this->parent->isConstant($name);
        }
        return false;
    }

    // Obtener tipo de elemento (para arreglos)
    public function getElementType($name) {
        if(array_key_exists($name, $this->values) && isset($this->values[$name]['elementType'])) {
            return $this->values[$name]['elementType'];
        }
        if ($this->parent !== null){
            return $this->parent->getElementType($name);
        }
        throw new Exception("Variable no es un array o no tiene tipo de elemento: $name");
    }

    // Obtener dimensiones (para arreglos)
    public function getDimensions($name)
    {
        if(array_key_exists($name, $this->values) && isset($this->values[$name]['dimensions'])) {
            return $this->values[$name]['dimensions'];
        }
        if ($this->parent !== null){
            return $this->parent->getDimensions($name);
        }
        return 1; // Por defecto 1 dimensión
    }

    // Verificar si una variable es puntero
    public function isPointer($name) {
        if(array_key_exists($name, $this->values)) {
            return $this->values[$name]['type'] === self::TYPE_POINTER;
        }
        if ($this->parent !== null){
            return $this->parent->isPointer($name);
        }
        return false;
    }

    // Obtener a qué variable apunta un puntero
    public function getPointerTarget($name) {
        if(array_key_exists($name, $this->values) && isset($this->values[$name]['pointsTo'])) {
            return $this->values[$name]['pointsTo'];
        }
        if ($this->parent !== null){
            return $this->parent->getPointerTarget($name);
        }
        throw new Exception("Variable no es un puntero: $name");
    }

    // ASIGNAR VARIABLE (solo para variables, no constantes)
    public function assign($name, $value){
        if(array_key_exists($name, $this->values)){
            // Verificar si es constante
            if ($this->isConstant($name)) {
                throw new Exception("Cannot assign to constant: $name");
            }
            
            $expectedType = $this->values[$name]['type'];
            $actualType = $this->inferType($value);
            
            // Permitir asignación de int a float (promoción automática)
            if ($expectedType === self::TYPE_FLOAT && $actualType === self::TYPE_INT) {
                $value = (float)$value;
                $actualType = self::TYPE_FLOAT;
            }
            
            // Permitir asignación de rune a int32 (rune es alias de int32)
            if ($expectedType === self::TYPE_INT && $actualType === self::TYPE_RUNE) {
                $value = ord($value); // Convertir carácter a código ASCII/Unicode
                $actualType = self::TYPE_INT;
            }
            
            // Permitir asignación de int a rune
            if ($expectedType === self::TYPE_RUNE && $actualType === self::TYPE_INT) {
                $value = chr($value); // Convertir código a carácter
                $actualType = self::TYPE_RUNE;
            }
            
            // No permitir asignación de float a int
            if ($expectedType === self::TYPE_INT && $actualType === self::TYPE_FLOAT) {
                throw new Exception("Type mismatch: cannot assign float to int");
            }
            
            // Para arrays, validar dimensiones y tipo de elementos
            if ($expectedType === self::TYPE_ARRAY && $actualType === self::TYPE_ARRAY) {
                $this->validateArrayAssignment($name, $value);
            }
            // Para tipos normales, validar igualdad
            else if ($expectedType !== $actualType && 
                    !($expectedType === self::TYPE_FLOAT && $actualType === self::TYPE_INT) &&
                    !($expectedType === self::TYPE_INT && $actualType === self::TYPE_RUNE) &&
                    !($expectedType === self::TYPE_RUNE && $actualType === self::TYPE_INT)) {
                throw new Exception("Type mismatch: cannot assign $actualType to $expectedType");
            }
            
            $this->values[$name]['value'] = $value;
            return;
        }
        
        if ($this->parent !== null){
            $this->parent->assign($name, $value);
            return;
        }

        throw new Exception("Variable no definida: $name");
    }

    // Validar asignación a array
    private function validateArrayAssignment($name, $newArray) {
        $oldDims = $this->getDimensions($name);
        $newDims = $this->countDimensions($newArray);
        
        if ($oldDims !== $newDims) {
            throw new Exception("Array dimension mismatch: expected $oldDims, got $newDims");
        }
        
        $oldElementType = $this->getElementType($name);
        if ($oldElementType !== self::TYPE_NIL) {
            // Validar que todos los elementos tengan el tipo correcto
            $this->validateArrayElements($newArray, $oldElementType);
        }
    }

    // Validar recursivamente los elementos de un array
    private function validateArrayElements($array, $expectedType) {
        foreach ($array as $element) {
            if (is_array($element) && !isset($element['isReference'])) {
                $this->validateArrayElements($element, $expectedType);
            } else {
                $actualType = $this->inferType($element);
                
                // Permitir promoción int->float
                $typeOk = ($actualType === $expectedType) || 
                          ($expectedType === self::TYPE_FLOAT && $actualType === self::TYPE_INT) ||
                          ($expectedType === self::TYPE_INT && $actualType === self::TYPE_RUNE) ||
                          ($expectedType === self::TYPE_RUNE && $actualType === self::TYPE_INT);
                
                if (!$typeOk) {
                    throw new Exception("Array element type mismatch: expected $expectedType, got $actualType");
                }
            }
        }
    }

    // Asignar a un índice de arreglo
   public function assignAtIndex($name, array $indices, $value)
    {
        $this->dbg("assignAtIndex: $name, indices=" . json_encode($indices) . ", value=" . json_encode($value));

        // Verificar si es constante
        if ($this->isConstant($name)) {
            throw new Exception("Cannot modify constant array: $name");
        }
        
        // Obtener el array
        $array = $this->get($name);
        $this->dbg("array obtenido = " . json_encode($array));
        
        if (!is_array($array)) {
            throw new Exception("$name no es un arreglo");
        }
        
        // Validar que haya índices
        if (empty($indices)) {
            throw new Exception("No se proporcionaron índices para asignación");
        }
        
        // Navegar hasta la posición y asignar
        $ref = &$array;
        $totalIndices = count($indices);
        
        for ($i = 0; $i < $totalIndices; $i++) {
            $idx = $indices[$i];
            
            // Validar índice
            if (!is_int($idx)) {
                throw new Exception("El índice debe ser un entero, obtenido: " . gettype($idx));
            }
            
            if ($idx < 0 || $idx >= count($ref)) {
                throw new Exception("Índice $idx fuera de rango. Tamaño: " . count($ref));
            }
            
            // Si no es el último índice, navegar al siguiente nivel
            if ($i < $totalIndices - 1) {
                $ref = &$ref[$idx];
                if (!is_array($ref)) {
                    throw new Exception("No es un array en dimensión " . ($i+1));
                }
            }
        }
        
        // Asignar al último nivel
        $lastIdx = $indices[$totalIndices - 1];
        $ref[$lastIdx] = $value;
        
        // Actualizar el arreglo original
        $this->assign($name, $array);
        
        $this->dbg("asignación completada, nuevo array = " . json_encode($this->get($name)));
    }

    /**
     * Obtener la tabla de símbolos para reportes
     */
    public function getSymbolTable(): array {
        if ($this->parent === null) {
            return $this->symbolTable;
        }
        
        // Si hay padre, combinar tablas
        $parentTable = $this->parent->getSymbolTable();
        return array_merge($parentTable, $this->symbolTable);
    }

    /**
     * Limpiar tabla de símbolos (para nueva ejecución)
     */
    public function clearSymbolTable() {
        $this->symbolTable = [];
        if ($this->parent !== null) {
            $this->parent->clearSymbolTable();
        }
    }

    private function dbg(string $msg)
    {
        // Descomentar para debug
        // echo "[DEBUG-ENV] " . $msg . "\n";
    }
    public function getParent() {
        return $this->parent;
    }
    
}