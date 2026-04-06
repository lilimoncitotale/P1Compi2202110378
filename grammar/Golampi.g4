grammar Golampi;

//=======================
//  Programa
//========================

program: declaration* EOF;

//=======================
//  declaraciones
//========================

declaration
    : functionDecl
    | varDecl
    | constDecl
    ;

constDecl
    : CONST IDENTIFIER type '=' expression
    ;

functionDecl
    : FUNC IDENTIFIER '(' parameterList?')' type? block
    | FUNC IDENTIFIER '(' parameterList?')' '(' type (',' type)* ')' block
    ;

parameterList
	: parameter (',' parameter)*
	;

parameter
    : IDENTIFIER type
    ;

varDecl
    : VAR IDENTIFIER (',' IDENTIFIER)* type ('=' expression (',' expression)*)?
    | VAR IDENTIFIER arrayType ('=' arrayLiteral)?
    ;
arrayType
    : '[' expression ']' arrayType
    | '[' expression ']' type
    ;

arrayLiteral
	: arrayType '{' arrayElement (',' arrayElement)* '}'
	| '{' arrayElement (',' arrayElement)* '}'
	;

arrayElement
    : arrayLiteral
    | expression
    ;

//==================================
//	BLOQUES Y SENTENCIAS
//================================

block
	: '{' statement* '}'
	;

statement
	: varDecl
	| switchStmt
	| expresionStmt
	| shortVarDecl
	| assignment
	| ifStmt
	| forStmt
	| returnStmt
	| breakStmt
	| continueStmt
	| expresionStmt
	| block
	;

shortVarDecl 
	: IDENTIFIER (',' IDENTIFIER)* ':=' expression (',' expression)*
	;

assignment
    : IDENTIFIER ('[' expression ']')+ '=' expression      // Array access
    | IDENTIFIER '=' expression                             // Simple assignment
    | ('*')+ IDENTIFIER '=' expression                      // Pointer assignment
    | primary ('++' | '--')                                 // Incremento/decremento
    | IDENTIFIER ('+=' | '-=' | '*=' | '/=' | '%=') expression  // Asignación compuesta
    ;

expresionStmt
	: expression
	;

//=====================================
//		CONTROL DE FLUJO
//====================================

ifStmt
	: IF expression block (ELSE (ifStmt | block))?
	;

forStmt
    : FOR expression? block
    | FOR shortVarDecl ';' expression ';' statement? block
    ;

returnStmt
	: RETURN (expression (',' expression)*)? 
	;

// switch/case/default
switchStmt
	: SWITCH expression? '{' switchCase* (DEFAULT ':' (block | statement+))? '}'
	;

switchCase
	: CASE expression (',' expression)* ':' (block | statement+)
	;

breakStmt
	: BREAK
	;
	
continueStmt
	: CONTINUE
	;

//===============================================
// 		EXPRESIONES (PRECEDENCIA)
//==============================================

expression
	: logicalOr
	;

logicalOr
	: logicalAnd ('||' logicalAnd)*
	;

logicalAnd
	: equality ('&&' equality)*
	;

equality
	: comparison (('==' | '!=') comparison)*
	;

comparison
	: multiplication (('>' | '<' | '>=' | '<=') multiplication)*
	;

addition
	: unary (('+' | '-') unary)*
	;

multiplication
	: addition (('*' | '/' | '%') addition)*
	;

unary
	: ('!' | '-') unary
	| '&' unary
	| '*' unary
	| primary
	;

primary
    : INTEGER
    | FLOAT
    | STRING
    | RUNE
    | TRUE
    | FALSE
    | LEN '(' expression ')'
	| qualified '(' argumentList? ')'
	| type '(' argumentList? ')'
	| arrayLiteral
	| qualified
    | '(' expression ')'
	| qualified ('[' expression ']')*
    | primary '++'          // Incremento postfijo
    | primary '--'          // Decremento postfijo
    ;

qualified
	: IDENTIFIER ('.' IDENTIFIER)*
	;

argumentList
	: expression (',' expression)*
	;

//==========================================
//		Tipos
//=====================================

type
	: INT
	| FLOATTYPE
	| BOOL
	| STRINGTYPE
	| RUNETYPE
	| pointerType
	| arrayType
	;

pointerType
    : '*' type
    ;

// ============================
// 7. TOKENS
// ============================

// Palabras reservadas (deben ir antes que IDENTIFIER)
CONST 		: 'const';
FUNC        : 'func';
VAR         : 'var';
SWITCH      : 'switch';
CASE        : 'case';
DEFAULT     : 'default';
IF          : 'if';
ELSE        : 'else';
FOR         : 'for';
RETURN      : 'return';
BREAK       : 'break';
CONTINUE    : 'continue';
TRUE        : 'true';
FALSE       : 'false';
LEN         : 'len';

// Tipos base
INT         : 'int' [0-9]*;
FLOATTYPE   : 'float' [0-9]*;
BOOL        : 'bool';
STRINGTYPE  : 'string';
RUNETYPE    : 'rune';  

// Literales
INTEGER     : [0-9]+;
FLOAT       : [0-9]+ '.' [0-9]+;
STRING      : '"' .*? '"';
RUNE        : '\'' . '\'';  // Un solo carácter entre comillas simples

// Operadores de incremento/decremento y asignación compuesta
PLUSPLUS    : '++';
MINUSMINUS  : '--';
PLUSEQ      : '+=';
MINUSEQ     : '-=';
STAREQ      : '*=';
SLASHEQ     : '/=';
MODEQ       : '%=';

// Identificadores (cualquier cosa que no sea palabra reservada)
IDENTIFIER  : [a-zA-Z_][a-zA-Z0-9_]*;

// Espacios y comentarios
WS          : [ \t]+ -> skip;
NL          : '\r'? '\n' -> channel(HIDDEN);
COMMENT     : '//' ~[\r\n]* -> skip;
MULTILINE_COMMENT : '/*' .*? '*/' -> skip;