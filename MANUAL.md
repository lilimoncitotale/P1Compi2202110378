**Manual técnico: Golampi Interpreter (Guía de estudio detallada)**

Objetivo
-------
Esta guía explica en detalle cómo está construido el proyecto Golampi en este repositorio, cómo fluyen los datos desde el código fuente hasta la ejecución, y qué archivos y componentes debes estudiar para comprender, extender o depurar el compilador/interprete. Está pensada como material de referencia y plan de estudio.

1. Arquitectura general
----------------------
- Entrada: archivo de código fuente (estilo Go reducido, extensión .go en `test/` o en la UI).
- Preprocesamiento: `run.php` hace pequeños ajustes (mover declaraciones top-level dentro de `main`, envolver `case` que no usan llaves, etc.). Esto facilita el parseo con la gramática actual.
- Análisis léxico / Tokens: `GolampiLexer` (generado por ANTLR) divide la entrada en tokens; `public/api.php` y `run.php` crean `CommonTokenStream` y vuelcan tokens a CSV para debugging (`tokens_csv`).
- Parseo: `GolampiParser` (generado) crea el árbol de parseo (parse tree). El proyecto usa `DefaultErrorStrategy` + `SyntaxErrorListener` para intentar recuperar errores sintácticos y reportarlos.
- Visitor / Intérprete: `src/Interpreter.php` extiende `GolampiBaseVisitor` y contiene la lógica de ejecución y chequeos semánticos. Produce la `salida`, genera errores semánticos y actualiza la `Enviroment`.
- Entorno / tabla: `src/Enviroment.php` mantiene símbolos (definiciones, asignaciones, scope). `getSymbolTable()` expone la tabla para la API y CSV.
- API web / UI: `public/api.php` invoca el pipeline lexer→parser→visitor y devuelve JSON con `salida`, `syntax`, `semantic`, `tabla`, `errors_csv`, `tokens`, `tokens_csv`. `public/index.html` + `public/script.js` permiten ejecutar y descargar resultados en la web.

2. Archivos clave y responsabilidades
-------------------------------------
- `grammar/Golampi.g4` — gramática ANTLR. Define la sintaxis del lenguaje. Cambios aquí requieren regenerar `generated/`.
- `generated/` — artefactos generados por ANTLR: `GolampiLexer.php`, `GolampiParser.php`, `GolampiVisitor.php`, `GolampiBaseVisitor.php`. No modificar a mano.
- `run.php` — runner CLI con diagnóstico y preprocesado. Mapea la secuencia: InputStream→Lexer→TokenStream→Parser→Visitor. Contiene código para volcar tokens y para elegir estrategia de errores.
- `public/api.php` — endpoint HTTP: usa el mismo pipeline que `run.php` y construye la respuesta JSON con información extendida (errores CSV, tokens, tabla).
- `src/SyntaxErrorListener.php` — captura errores sintácticos (línea, columna, mensaje, token offending).
- `src/Interpreter.php` — núcleo del intérprete/visitor: funciones `visitProgram`, `visitFunctionDecl`, `visitVarDecl`, evaluadores de expresiones, manejo de control (if/for/switch), soporte de builtins y conversión de tipos. Contiene `reportError()` que clasifica errores y los almacena en `errors` (disponible con `getErrors()`).
- `src/Enviroment.php` — maneja scopes, definiciones, asignaciones, lookup y construcción de tabla de símbolos. También contiene validaciones de tipos para asignaciones.
- `public/script.js` — lógica de la UI: envío de código a la API, manejo de la respuesta, almacenamiento local de `tablaActual`, `erroresActuales`, `tokensActuales` y funciones para descargar CSV/text.
- `test/` — ejemplos y pruebas (ej.: `input.go`, `error_input.go`, `semantic_only.go`). Útiles para validar comportamiento y aprender.

3. Flujo de ejecución (paso a paso)
---------------------------------
1. El usuario proporciona código (archivo o textarea en la UI).
2. `run.php` o `public/api.php` crea un `InputStream` a partir del texto.
3. Se crea el `GolampiLexer` que produce tokens, y `CommonTokenStream` almacena tokens.
4. Se llama al `GolampiParser` y se le asocia una `ErrorStrategy` y `ErrorListener`:
   - `DefaultErrorStrategy` intenta recuperar en presencia de errores.
   - `SyntaxErrorListener` recoge ocurrencias y permite reportarlas al usuario sin derrumbar el proceso.
5. Si el listener reporta errores sintácticos, la API no lanza la interpretación; en su lugar devuelve `syntax` y `errors_csv`.
6. Si no hay errores sintácticos, se instancia `interpreter` y se llama `visit($tree)`.
7. El `interpreter` hace un primer pase de hoisting (registro de funciones), inicializa `Enviroment` (tabla), y ejecuta `main`.
8. Durante la visita, se evalúan expresiones, se ejecutan statements y se invocan builtins. Cuando surgen errores semánticos se llama `reportError()` para agregarlos a `errors`.
9. Al terminar, la API retorna `salida` (lo impreso), `semantic` (lista de errores semánticos), `tabla` (símbolos) y CSVs si es necesario.

4. Manejo de errores — detalles
-----------------------------
- Sintácticos: capturados por el listener en `syntaxError(...)` y almacenados con formato: `{ line, column, message, offending }`. `public/api.php` transforma esa lista a CSV y la devuelve en `errors_csv`.
- Semánticos: generados por el intérprete (ej.: `Type mismatch`, `Variable no definida`, etc.). `Interpreter::reportError()` agrega entradas con `type`, `msg`, `line`, `col`. Estas se devuelven en `semantic` y se agrupan en `errors_csv` (CSV unificado posible).
- Tokens/leves diagnósticos: se generan y vuelcan a `tokens_csv` para debugging léxico.

5. Estructura y diseño de `Enviroment`
-------------------------------------
- Propósito: mantener símbolos (variables/constantes) con su metadata (tipo, valor, const flag, scope, línea/columna).
- API típica:
  - `define(name, value, type, isConst, meta)` — registra símbolo.
  - `get(name)` — busca símbolo en el scope actual y ancestros.
  - `assign(name, value)` — asigna validando tipos y constness.
  - `getSymbolTable()` — devuelve array con los símbolos listos para exportar.
- Recomendación: lee `Enviroment.php` y sigue cómo se construye la tabla (campos, alcance, cómo se retorna a la UI).

6. Diseño y patrones en `Interpreter.php`
----------------------------------------
- Implementa el patrón Visitor (hereda de `GolampiBaseVisitor`). Cada `visitXxx($ctx)` realiza la semántica de la regla correspondiente.
- Mecanismos clave:
  - `errorSentinel`: valor especial devuelto para indicar fallo en evaluación de subexpresión sin lanzar excepción global.
  - `reportError()`: centraliza la creación de mensajes semánticos (clasificación automática).
  - `coerceNumeric()`: lógica de promoción numérica (int/float/rune).
  - `mapBuiltinName()` y resolución de nombres calificados para builtins (ej. `fmt.Println`).
- Control de flujo: `visitProgram()` hace hoisting de funciones y luego `callUserFunction('main', ...)`.
- Robustez: tras cambios en la gramática, el intérprete contiene defensas para distintos shapes de contextos (ej. `IDENTIFIER` puede venir como array o nodo) — observa estos lugares para entender compatibilidad con el parser.

7. API y Frontend
------------------
- `public/api.php`: orquestador usado por la UI. Campos clave en la respuesta JSON:
  - `success` (bool)
  - `salida` (string) — texto producido por el programa
  - `syntax` (array) — errores sintácticos detallados
  - `semantic` (array) — errores semánticos reportados por el visitor
  - `tabla` (array) — tabla de símbolos
  - `errors_csv` (string) — CSV con errores (string)
  - `tokens`, `tokens_csv` — tokens lexicos y CSV
- `public/script.js`: maneja la llamada POST a `api.php`, normaliza errores (combina `syntax` + `semantic` para la descarga), y genera CSVs de tabla y tokens.

8. Cómo estudiar esto en profundidad (plan sugerido)
---------------------------------------------------
1. Lee `grammar/Golampi.g4` y relaciónalo con los context classes en `generated/`.
2. Siguiendo un archivo de test (p.ej. `test/input.go`), haz trazas: activa debug en `run.php` o `Interpreter::dbg()` para ver llamadas `visit*`.
3. Lee `Interpreter::visitProgram`, `visitFunctionDecl`, `visitVarDecl`, y los evaluadores de expresiones (`+`, `-`, `*`, `/`, indexación, llamadas a funciones). Intenta dibujar el flujo de ejecución.
4. Revisa `Enviroment.php` para comprender scope y lookup; simula la inserción de símbolos por mano si te ayuda.
5. Modifica una regla simple en la gramática (ej. añadir una forma de expresión) → regenera `generated/` → arregla `Interpreter` si cambian los context shapes → ejecutar pruebas.
6. Escribe tests unitarios pequeños en `test/` (ej.: archivos que provoquen solo semánticos) y automatiza ejecuciones con un script `scripts/test-all.sh`.

9. Ejercicios prácticos sugeridos
--------------------------------
- Añadir un builtin nuevo (p.ej. `math.Abs`) y mapearlo en `mapBuiltinName()`; implementa ejecución en el visitor.
- Añadir soporte en la gramática para un pequeño literal o expresión, regenerar parser y adaptar `Interpreter`.
- Mejorar el formateo CSV (si quieres campos adicionales) o separar `syntax` y `semantic` en descargas independientes en la UI.
- Implementar pruebas automatizadas: script que lanza `php run.php` sobre todos los `test/*.go` y compara salida/erros esperados.

10. Referencias útiles
---------------------
- ANTLR4 docs: https://www.antlr.org
- "The Definitive ANTLR 4 Reference" (Terence Parr)
- ANTLR4 PHP runtime source: `vendor/antlr/...` (leer `DefaultErrorStrategy`, `CommonTokenStream`)
- Interpreters tutorial: "Writing An Interpreter In Go" (muy didáctico sobre visitor/eval patterns)
- Compilers textbook: Dragon Book (principios amplios sobre análisis y semántica)

11. Archivos que recomiendo leer primero (orden sugerido)
------------------------------------------------------
1. `grammar/Golampi.g4` (comprender la sintaxis)
2. `run.php` (pipeline y preprocesado)
3. `public/api.php` (versión API del pipeline)
4. `src/SyntaxErrorListener.php` (cómo capturamos sintácticos)
5. `src/Enviroment.php` (scope y tabla de símbolos)
6. `src/Interpreter.php` (visitas principales y manejo de errores)
7. `public/script.js` y `public/index.html` (cómo se muestran los resultados)

12. Notas finales y cómo puedo ayudarte
-------------------------------------
- Si quieres, puedo generar un `walkthrough.md` que tome `test/input.go` y muestre, línea por línea, qué visitas se ejecutan, cómo se definen símbolos y qué errores se producen (p. ej. un trazo de ejecución). Esto es útil para entender el runtime.
- También puedo preparar un conjunto de tests automatizados y un script `scripts/run-tests.sh` que ejecute y verifique resultados.

---
Archivo creado: MANUAL.md — ábrelo para lectura y dime si quieres que convierta secciones en documentos separados o que genere diagramas (mermaid) del flujo.
