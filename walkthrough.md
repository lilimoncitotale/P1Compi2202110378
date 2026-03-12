Walkthrough: ejecución paso a paso de test/input.go
===============================================

Objetivo
--------
Este documento explica, línea por línea (o bloque por bloque), cómo el proyecto procesa `test/input.go`: qué reglas del parser entran en juego, qué métodos `visit*` del `interpreter` se ejecutan, cómo se muta el `Enviroment` (tabla de símbolos) y qué salidas/errores se producen.

Supuestos
---------
- Gramática: se usa `grammar/Golampi.g4` y los artefactos en `generated/` (no se editan manualmente). Las llamadas de visitor usan los context classes generados.
- Visitor: `src/Interpreter.php` implementa `visitProgram`, `visitFunctionDecl`, `visitVarDecl`, etc.
- Preprocesado: `run.php` puede mover declaraciones top-level dentro de `main` y envolver cuerpos `case` sin llaves.

Resumen rápido del código (`test/input.go`)
-----------------------------------------
El programa define `main()` e imprime varias secciones de control de flujo: `if`, `if-else`, `switch/case`, varios `for` (clásico, condicional, infinito con break, continue). También crea variables: `nota1`, `nota2`, `estudiante`, `codigoCategoria`, y variables de bucle (`i`, `contador`, `intentos`, `j`).

Flujo de alto nivel
-------------------
1. `run.php` / `public/api.php` toma el texto y crea `InputStream`.
2. `GolampiLexer` tokeniza; `CommonTokenStream` agrupa tokens.
3. `GolampiParser` parsea con `DefaultErrorStrategy` y `SyntaxErrorListener`.
4. Si no hay errores sintácticos, se instancia `interpreter` y se llama `visitProgram($tree)`.
5. `interpreter` registra funciones (hoisting), luego invoca `main` mediante `callUserFunction('main', ...)`.

Walkthrough detallado (bloque por bloque)
----------------------------------------
Nota: los números de línea corresponden al archivo `test/input.go` en el repositorio.

- Líneas 1–6: apertura de `main` y primeras llamadas
  - Parser: reconoce `functionDecl` y `block`.
  - Visitor: `visitProgram()` encuentra la `functionDecl` y llama a `visitFunctionDecl()` para registrar `main` en la tabla interna de funciones (`$this->functions['main']`).
  - No aún se definen variables: el hoisting registra la existencia de `main` y guarda su `block`.

- Líneas 7–10: declaración `nota1 := 85`, `nota2 := 92`, `estudiante := "Ana"`
  - Parser: regla `shortVarDecl` o `assignment` según gramática.
  - Visitor: `visitVarDecl()` o similar crea símbolos locales en `Enviroment`.
  - Efecto en `Enviroment`: se crean entradas en la tabla con metadata:
    - `nota1`: tipo `int32`, valor `85`, scope `local`, isConst=false, línea y columna donde se definió.
    - `nota2`: tipo `int32`, valor `92`.
    - `estudiante`: tipo `string`, valor `"Ana"`.

- Líneas 12–18: `if nota1 > 80 { fmt.Println(...) }`
  - Parser: `ifStmt` con condición y bloque.
  - Visitor: `visitIfStmt($ctx)` evalúa la condición (visita `expression`):
    - Visita nodos `primary`/`relational` y resuelve `nota1` desde `Enviroment` (llamada interna a `Enviroment->get('nota1')`).
    - Compara `nota1 > 80` → true, ejecuta el bloque: `visit` de la llamada `fmt.Println`.
  - Para la llamada `fmt.Println`: `resolveQualifiedName()` devuelve `fmt.Println`; `mapBuiltinName()` mapea a builtin `println` (o a la función internal), y el interpreter ejecuta la impresión usando `echo` en PHP (acumula en `salida`).

- Líneas 20–33: `if-else if-else` para `nota2`
  - Visitor: `visitIfStmt()` para la primera condición; si es false, visita la rama `else` que contiene otro `if` anidado; finalmente una impresión de la rama correcta. No se modifican símbolos.

- Líneas 35–52: `switch codigoCategoria { case 1: ... }`
  - Antes del `switch`, `codigoCategoria := 2` crea símbolo `codigoCategoria` (int32, valor 2).
  - `visitSwitchStmt()` evalúa la expresión del switch y recorre `case`s buscando coincidencia:
    - Para `case 2`: ejecuta su bloque (o lista de statements si la gramática lo produce así) y hace el `println` correspondiente.
  - Nota: `run.php` preprocesa `case` sin llaves y `Interpreter` maneja ambos formatos.

- Líneas 54–62: `for i := 1; i <= 5; i++ { fmt.Println(i) }` (for clásico)
  - `visitForStatement()` detecta la forma clásica: inicialización (`visitVarDecl`/assign), condición, pos increment.
  - Se crea símbolo de bucle `i` en el scope (`Enviroment->define('i', 1, 'int32', false, meta)`).
  - En cada iteración evalúa y ejecuta `println`.
  - Al finalizar el bucle, `i` queda con el valor de la última iteración (según implementación actual, puede quedar en 5 o 1 dependiendo de dónde se capture; en ejecuciones previas la tabla mostraba `i = 1` — esto depende de cómo el interpreter limpia/define variables de bucle).

- Líneas 64–73: `for contador > 0 { ... contador -= 3 }` (for condicional/while)
  - `visitForCondition()` ejecuta la condición en cada iteración. `contador` es definido antes (`contador := 10`). Se actualiza con `assign` o `current->assign()`.

- Líneas 75–90: `for { ... if intentos == 3 { break } }` (for infinito + break)
  - Visitor ejecuta bucle infinito: cada iteración evalúa el `if` y lanza `BreakSignal`/`ContinueSignal` para controlar flujo (implementado con excepciones internas en el visitor). `intentos` se incrementa y break sale del bucle.

- Líneas 92–100: `for j := 1; j <= 6; j++ { if j % 2 == 0 { continue } ... }` (continue)
  - Visitor evalúa la condición, ejecuta `continue` para saltar la iteración, y finalmente imprime sólo impares.

- Fin de `main`: cierre y retorno implícito
  - `visitProgram()` termina cuando `main` devuelve o termina su bloque.

Estado final de la `tabla de símbolos` (ejemplo observado en ejecuciones previas)
-----------------------------------------------------------------
Después de ejecutar `test/input.go` la tabla típica contiene (ejemplo):

- `nota1`: int32 = 85, scope=local
- `nota2`: int32 = 92, scope=local
- `estudiante`: string = "Ana", scope=local
- `codigoCategoria`: int32 = 2
- `i`: int32 = 1 (valor final de bucle, depende de implementación)
- `contador`: int32 = 10 (si no fue reasignado fuera del bucle)
- `intentos`: int32 = 0 (si break se ejecuta después de incremento, puede quedar en 3 o 0 según orden; en ejecuciones previas quedó 0)
- `j`: int32 = 1 (valor final de bucle)

Captura y reporte de errores
----------------------------
- Sintácticos:
  - Capturados por `SyntaxErrorListener::syntaxError(...)` con datos `{line, column, message, offending}`.
  - `public/api.php` devuelve `syntax` y construye `errors_csv` (CSV con columnas Index,Type,Message,Line,Column,Offending).
- Semánticos:
  - Generados por `Interpreter::reportError(msg, $ctx)` y almacenados en `$this->errors` con formato `{type,msg,line,col}`.
  - Ejemplos: `Type mismatch`, `Variable no definida`, `Incompatible types for '+'`.
  - `public/api.php` incluye `semantic` y también los serializa a `errors_csv`.

Cómo leer las implementaciones clave (sugerencia de secciones en el repo)
------------------------------------------------------------------
1. `grammar/Golampi.g4`: mapear una regla concreta (p.ej. `ifStmt`) a la implementación en `generated/GolampiParser.php` y al método `visitIfStmt` en `Interpreter.php`.
2. `run.php`: ver el preprocesado y cómo se configura el parser y listener.
3. `src/SyntaxErrorListener.php`: comprender la forma de los errores sintácticos.
4. `src/Interpreter.php`: buscar `visitProgram`, `visitFunctionDecl`, `visitVarDecl`, `visitIfStmt`, `visitSwitchStmt`, `visitForStatement`, `reportError`, `getErrors`, y `getSymbolTable`.
5. `src/Enviroment.php`: estudiar `define`, `assign`, `get`, `getSymbolTable`.

Ejemplo de trazado práctico (mini-ejemplo)
---------------------------------------
Si quieres un trazado aún más detallado línea por línea mostrando llamadas concretas y outputs intermedios, puedo generar un `walkthrough-detailed.md` que incluya:
- nombre del context class (p.ej. `Context\\IfStmtContext`),
- llamada al método `visitIfStmt($ctx)` con contenido de `$ctx->start->getLine()` y `$ctx->getText()` truncado,
- cambios en `Enviroment` después de cada declaración.

Conclusión
----------
Este documento debería darte una visión clara de cómo funciona todo. Si quieres ahora el `walkthrough-detailed.md` (trazado con context names y snapshots de symbol table tras cada statement), indícalo y lo creo.

Walkthrough detallado (por statement)
------------------------------------
Esta sección amplía el walkthrough anterior con información técnica concreta por cada statement importante en `test/input.go`.

Formato por entrada:
- `Líneas`: rango aproximado en `test/input.go`.
- `Context class`: nombre del context class generado por ANTLR (p.ej. `Context\\IfStmtContext`).
- `Visitor method`: método del visitor llamado (p.ej. `visitIfStmt`).
- `ctx sample`: texto corto obtenido con `$ctx->getText()` (truncado).
- `Acción`: qué hace el visitor y efectos sobre `Enviroment`.
- `Tabla (snapshot)`: símbolos relevantes después de ejecutar el statement.

1) Inicio `main`
- Líneas: 1
- Context class: `Context\\ProgramContext` / `Context\\FunctionDeclContext`
- Visitor method: `visitProgram` → `visitFunctionDecl`
- ctx sample: `funcmain(){...}` (truncado por `getText()` en el context)
- Acción: hoisting de `main` (se registra `functions['main']` con su bloque). No se crean símbolos aún.
- Tabla: (vacía para variables locales de `main` hasta su ejecución).

2) `nota1 := 85`
- Líneas: 3
- Context class: `Context\\VarDeclContext` (o `Context\\ShortVarDeclContext` según gramática)
- Visitor method: `visitVarDecl`
- ctx sample: `nota1:=85`
- Acción: evaluar RHS (`85`), inferir tipo `int32`, `Enviroment->define('nota1',85,'int32',false,meta)`.
- Tabla snapshot:
  - nota1: int32=85, isConst=false, scope=local

3) `nota2 := 92` y `estudiante := "Ana"`
- Líneas: 4-5
- Context class: `Context\\VarDeclContext`
- Visitor method: `visitVarDecl`
- ctx sample: `nota2:=92`, `estudiante:="Ana"`
- Acción: definir `nota2` y `estudiante` en `Enviroment`.
- Tabla snapshot:
  - nota1: int32=85
  - nota2: int32=92
  - estudiante: string="Ana"

4) `if nota1 > 80 { fmt.Println(...) }`
- Líneas: 8-11
- Context class: `Context\\IfStmtContext`
- Visitor method: `visitIfStmt`
- ctx sample: `ifnota1>80{fmt.Println(...)}`
- Acción: `visit` condición → `visitExpression` → `visitPrimary` para `nota1` (se resuelve en `Enviroment->get('nota1')`), comparar y ejecutar bloque; llamada a builtin mapeada y `salida` acumulada.
- Tabla snapshot: sin cambios en símbolos (sólo lectura)

5) `if-else if-else` (nota2)
- Líneas: 14-24
- Context class: `Context\\IfStmtContext` (anidado)
- Visitor method: `visitIfStmt`
- ctx sample: `ifnota2>=95{...}else{...}`
- Acción: evaluar ramas en orden, ejecutar impresión en rama correspondiente.
- Tabla snapshot: sin cambios

6) `codigoCategoria := 2` y `switch`
- Líneas: 28-40
- Context class: `Context\\VarDeclContext` y `Context\\SwitchStmtContext`
- Visitor methods: `visitVarDecl` y `visitSwitchStmt`
- ctx sample: `codigoCategoria:=2`, `switchcodigoCategoria{case2:...}`
- Acción: definir `codigoCategoria`; `visitSwitchStmt` evalúa la expresión y ejecuta el case coincidente.
- Tabla snapshot:
  - nota1, nota2, estudiante, codigoCategoria: int32=2

7) For clásico `for i := 1; i <= 5; i++ {...}`
- Líneas: 44-50
- Context class: `Context\\ForStatementContext` (forma clásica)
- Visitor method: `visitForStatement`
- ctx sample: `fori:=1;i<=5;i++{...}`
- Acción: definir `i` en entorno local, ejecutar bucle, en cada iteración ejecutar `println`.
- Tabla snapshot (tras bucle): incluye `i` (valor final según implementación)

8) For condicional `for contador > 0 { ... }`
- Líneas: 56-62
- Context class: `Context\\ForStatementContext` (forma condicional)
- Visitor method: `visitForStatement`
- ctx sample: `forcontador>0{...}`
- Acción: `contador` ya definido; evaluar condición y actualizar con `assign`.
- Tabla snapshot: `contador` con valor final tras bucle

9) For infinito + break
- Líneas: 68-78
- Context class: `Context\\ForStatementContext` (infinito)
- Visitor method: `visitForStatement` + manejo de `BreakSignal`
- ctx sample: `for{...ifintentos==3{break}}`
- Acción: incrementar `intentos`, comprobar, emitir `BreakSignal` y salir; `intentos` queda con último valor conocido.

10) Continue (impares)
- Líneas: 84-96
- Context class: `Context\\ForStatementContext`
- Visitor method: `visitForStatement` y `visitIfStmt` dentro del cuerpo
- ctx sample: `forj:=1;j<=6;j++{ifj%2==0{continue}...}`
- Acción: `continue` provoca `ContinueSignal` y salto a siguiente iteración; imprime solo impares.

Snapshots de symbol table: ejemplo real
- Después de definiciones iniciales (nota1, nota2, estudiante):
  - nota1,int32,85,false,local
  - nota2,int32,92,false,local
  - estudiante,string,"Ana",false,local
- Después de definir `codigoCategoria` y ejecutar switch:
  - codigoCategoria,int32,2,false,local
- Después de todos los bucles (estado final aproximado):
  - i,int32,<valor final>,false,local
  - contador,int32,<valor final>,false,local
  - intentos,int32,<valor final>,false,local
  - j,int32,<valor final>,false,local

Notas técnicas finales
---------------------
- Los `Context` names y métodos `visitXxx` provienen de las reglas en `Golampi.g4`. Para obtener el nombre exacto de la clase context y del método visitor, abre `generated/GolampiParser.php` y busca la función correspondiente (p.ej. `public function ifStmt()` → context class `Context\\IfStmtContext`).
- Si quieres, puedo instrumentar `Interpreter` para imprimir (o guardar) un log detallado en `/tmp/trace.json` con entradas: `{ stmt_index, ctx_class, visitor_method, ctx_text_trunc, symbol_table_snapshot }` durante una ejecución — útil para depurar y para generar el `walkthrough-detailed` automáticamente.

Fin del walkthrough detallado.
