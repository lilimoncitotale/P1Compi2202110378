<?php

/*
 * Generated from grammar/Golampi.g4 by ANTLR 4.13.1
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               CONST = 28, FUNC = 29, VAR = 30, SWITCH = 31, CASE = 32, 
               DEFAULT = 33, IF = 34, ELSE = 35, FOR = 36, RETURN = 37, 
               BREAK = 38, CONTINUE = 39, TRUE = 40, FALSE = 41, LEN = 42, 
               INT = 43, FLOATTYPE = 44, BOOL = 45, STRINGTYPE = 46, RUNETYPE = 47, 
               INTEGER = 48, FLOAT = 49, STRING = 50, RUNE = 51, PLUSPLUS = 52, 
               MINUSMINUS = 53, PLUSEQ = 54, MINUSEQ = 55, STAREQ = 56, 
               SLASHEQ = 57, MODEQ = 58, IDENTIFIER = 59, WS = 60, NL = 61, 
               COMMENT = 62, MULTILINE_COMMENT = 63;

		public const RULE_program = 0, RULE_declaration = 1, RULE_constDecl = 2, 
               RULE_functionDecl = 3, RULE_parameterList = 4, RULE_parameter = 5, 
               RULE_varDecl = 6, RULE_arrayType = 7, RULE_arrayLiteral = 8, 
               RULE_arrayElement = 9, RULE_block = 10, RULE_statement = 11, 
               RULE_shortVarDecl = 12, RULE_assignment = 13, RULE_expresionStmt = 14, 
               RULE_ifStmt = 15, RULE_forStmt = 16, RULE_returnStmt = 17, 
               RULE_switchStmt = 18, RULE_switchCase = 19, RULE_breakStmt = 20, 
               RULE_continueStmt = 21, RULE_expression = 22, RULE_logicalOr = 23, 
               RULE_logicalAnd = 24, RULE_equality = 25, RULE_comparison = 26, 
               RULE_addition = 27, RULE_multiplication = 28, RULE_unary = 29, 
               RULE_primary = 30, RULE_qualified = 31, RULE_argumentList = 32, 
               RULE_type = 33, RULE_pointerType = 34;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declaration', 'constDecl', 'functionDecl', 'parameterList', 
			'parameter', 'varDecl', 'arrayType', 'arrayLiteral', 'arrayElement', 
			'block', 'statement', 'shortVarDecl', 'assignment', 'expresionStmt', 
			'ifStmt', 'forStmt', 'returnStmt', 'switchStmt', 'switchCase', 'breakStmt', 
			'continueStmt', 'expression', 'logicalOr', 'logicalAnd', 'equality', 
			'comparison', 'addition', 'multiplication', 'unary', 'primary', 'qualified', 
			'argumentList', 'type', 'pointerType'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'='", "'('", "')'", "','", "'['", "']'", "'{'", "'}'", "':='", 
		    "'*'", "';'", "':'", "'||'", "'&&'", "'=='", "'!='", "'>'", "'<'", 
		    "'>='", "'<='", "'+'", "'-'", "'/'", "'%'", "'!'", "'&'", "'.'", "'const'", 
		    "'func'", "'var'", "'switch'", "'case'", "'default'", "'if'", "'else'", 
		    "'for'", "'return'", "'break'", "'continue'", "'true'", "'false'", 
		    "'len'", null, null, "'bool'", "'string'", "'rune'", null, null, null, 
		    null, "'++'", "'--'", "'+='", "'-='", "'*='", "'/='", "'%='"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, "CONST", "FUNC", "VAR", "SWITCH", 
		    "CASE", "DEFAULT", "IF", "ELSE", "FOR", "RETURN", "BREAK", "CONTINUE", 
		    "TRUE", "FALSE", "LEN", "INT", "FLOATTYPE", "BOOL", "STRINGTYPE", 
		    "RUNETYPE", "INTEGER", "FLOAT", "STRING", "RUNE", "PLUSPLUS", "MINUSMINUS", 
		    "PLUSEQ", "MINUSEQ", "STAREQ", "SLASHEQ", "MODEQ", "IDENTIFIER", "WS", 
		    "NL", "COMMENT", "MULTILINE_COMMENT"
		];

		private const SERIALIZED_ATN =
			[4, 1, 63, 502, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 1, 0, 5, 0, 72, 8, 0, 10, 0, 12, 0, 75, 9, 0, 1, 
		    0, 1, 0, 1, 1, 1, 1, 1, 1, 3, 1, 82, 8, 1, 1, 2, 1, 2, 1, 2, 1, 2, 
		    1, 2, 1, 2, 1, 3, 1, 3, 1, 3, 1, 3, 3, 3, 94, 8, 3, 1, 3, 1, 3, 3, 
		    3, 98, 8, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 3, 3, 105, 8, 3, 1, 3, 
		    1, 3, 1, 3, 1, 3, 1, 3, 5, 3, 112, 8, 3, 10, 3, 12, 3, 115, 9, 3, 
		    1, 3, 1, 3, 1, 3, 3, 3, 120, 8, 3, 1, 4, 1, 4, 1, 4, 5, 4, 125, 8, 
		    4, 10, 4, 12, 4, 128, 9, 4, 1, 5, 1, 5, 1, 5, 1, 6, 1, 6, 1, 6, 1, 
		    6, 5, 6, 137, 8, 6, 10, 6, 12, 6, 140, 9, 6, 1, 6, 1, 6, 1, 6, 1, 
		    6, 1, 6, 5, 6, 147, 8, 6, 10, 6, 12, 6, 150, 9, 6, 3, 6, 152, 8, 6, 
		    1, 6, 1, 6, 1, 6, 1, 6, 1, 6, 3, 6, 159, 8, 6, 3, 6, 161, 8, 6, 1, 
		    7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 173, 
		    8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 5, 8, 180, 8, 8, 10, 8, 12, 8, 
		    183, 9, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 5, 8, 191, 8, 8, 10, 
		    8, 12, 8, 194, 9, 8, 1, 8, 1, 8, 3, 8, 198, 8, 8, 1, 9, 1, 9, 3, 9, 
		    202, 8, 9, 1, 10, 1, 10, 5, 10, 206, 8, 10, 10, 10, 12, 10, 209, 9, 
		    10, 1, 10, 1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 
		    1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 3, 11, 225, 8, 11, 1, 12, 1, 12, 
		    1, 12, 5, 12, 230, 8, 12, 10, 12, 12, 12, 233, 9, 12, 1, 12, 1, 12, 
		    1, 12, 1, 12, 5, 12, 239, 8, 12, 10, 12, 12, 12, 242, 9, 12, 1, 13, 
		    1, 13, 1, 13, 1, 13, 1, 13, 4, 13, 249, 8, 13, 11, 13, 12, 13, 250, 
		    1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 4, 13, 260, 8, 13, 
		    11, 13, 12, 13, 261, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 
		    13, 1, 13, 1, 13, 3, 13, 273, 8, 13, 1, 14, 1, 14, 1, 15, 1, 15, 1, 
		    15, 1, 15, 1, 15, 1, 15, 3, 15, 283, 8, 15, 3, 15, 285, 8, 15, 1, 
		    16, 1, 16, 3, 16, 289, 8, 16, 1, 16, 1, 16, 1, 16, 1, 16, 1, 16, 1, 
		    16, 1, 16, 3, 16, 298, 8, 16, 1, 16, 1, 16, 3, 16, 302, 8, 16, 1, 
		    17, 1, 17, 1, 17, 1, 17, 5, 17, 308, 8, 17, 10, 17, 12, 17, 311, 9, 
		    17, 3, 17, 313, 8, 17, 1, 18, 1, 18, 3, 18, 317, 8, 18, 1, 18, 1, 
		    18, 5, 18, 321, 8, 18, 10, 18, 12, 18, 324, 9, 18, 1, 18, 1, 18, 1, 
		    18, 1, 18, 4, 18, 330, 8, 18, 11, 18, 12, 18, 331, 3, 18, 334, 8, 
		    18, 3, 18, 336, 8, 18, 1, 18, 1, 18, 1, 19, 1, 19, 1, 19, 1, 19, 5, 
		    19, 344, 8, 19, 10, 19, 12, 19, 347, 9, 19, 1, 19, 1, 19, 1, 19, 4, 
		    19, 352, 8, 19, 11, 19, 12, 19, 353, 3, 19, 356, 8, 19, 1, 20, 1, 
		    20, 1, 21, 1, 21, 1, 22, 1, 22, 1, 23, 1, 23, 1, 23, 5, 23, 367, 8, 
		    23, 10, 23, 12, 23, 370, 9, 23, 1, 24, 1, 24, 1, 24, 5, 24, 375, 8, 
		    24, 10, 24, 12, 24, 378, 9, 24, 1, 25, 1, 25, 1, 25, 5, 25, 383, 8, 
		    25, 10, 25, 12, 25, 386, 9, 25, 1, 26, 1, 26, 1, 26, 5, 26, 391, 8, 
		    26, 10, 26, 12, 26, 394, 9, 26, 1, 27, 1, 27, 1, 27, 5, 27, 399, 8, 
		    27, 10, 27, 12, 27, 402, 9, 27, 1, 28, 1, 28, 1, 28, 5, 28, 407, 8, 
		    28, 10, 28, 12, 28, 410, 9, 28, 1, 29, 1, 29, 1, 29, 1, 29, 1, 29, 
		    1, 29, 1, 29, 3, 29, 419, 8, 29, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 
		    1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 
		    30, 3, 30, 436, 8, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 3, 30, 443, 
		    8, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 
		    30, 1, 30, 1, 30, 1, 30, 1, 30, 5, 30, 458, 8, 30, 10, 30, 12, 30, 
		    461, 9, 30, 3, 30, 463, 8, 30, 1, 30, 1, 30, 1, 30, 1, 30, 5, 30, 
		    469, 8, 30, 10, 30, 12, 30, 472, 9, 30, 1, 31, 1, 31, 1, 31, 5, 31, 
		    477, 8, 31, 10, 31, 12, 31, 480, 9, 31, 1, 32, 1, 32, 1, 32, 5, 32, 
		    485, 8, 32, 10, 32, 12, 32, 488, 9, 32, 1, 33, 1, 33, 1, 33, 1, 33, 
		    1, 33, 1, 33, 1, 33, 3, 33, 497, 8, 33, 1, 34, 1, 34, 1, 34, 1, 34, 
		    0, 1, 60, 35, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 
		    30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 
		    64, 66, 68, 0, 7, 1, 0, 52, 53, 1, 0, 54, 58, 1, 0, 15, 16, 1, 0, 
		    17, 20, 1, 0, 21, 22, 2, 0, 10, 10, 23, 24, 2, 0, 22, 22, 25, 25, 
		    554, 0, 73, 1, 0, 0, 0, 2, 81, 1, 0, 0, 0, 4, 83, 1, 0, 0, 0, 6, 119, 
		    1, 0, 0, 0, 8, 121, 1, 0, 0, 0, 10, 129, 1, 0, 0, 0, 12, 160, 1, 0, 
		    0, 0, 14, 172, 1, 0, 0, 0, 16, 197, 1, 0, 0, 0, 18, 201, 1, 0, 0, 
		    0, 20, 203, 1, 0, 0, 0, 22, 224, 1, 0, 0, 0, 24, 226, 1, 0, 0, 0, 
		    26, 272, 1, 0, 0, 0, 28, 274, 1, 0, 0, 0, 30, 276, 1, 0, 0, 0, 32, 
		    301, 1, 0, 0, 0, 34, 303, 1, 0, 0, 0, 36, 314, 1, 0, 0, 0, 38, 339, 
		    1, 0, 0, 0, 40, 357, 1, 0, 0, 0, 42, 359, 1, 0, 0, 0, 44, 361, 1, 
		    0, 0, 0, 46, 363, 1, 0, 0, 0, 48, 371, 1, 0, 0, 0, 50, 379, 1, 0, 
		    0, 0, 52, 387, 1, 0, 0, 0, 54, 395, 1, 0, 0, 0, 56, 403, 1, 0, 0, 
		    0, 58, 418, 1, 0, 0, 0, 60, 462, 1, 0, 0, 0, 62, 473, 1, 0, 0, 0, 
		    64, 481, 1, 0, 0, 0, 66, 496, 1, 0, 0, 0, 68, 498, 1, 0, 0, 0, 70, 
		    72, 3, 2, 1, 0, 71, 70, 1, 0, 0, 0, 72, 75, 1, 0, 0, 0, 73, 71, 1, 
		    0, 0, 0, 73, 74, 1, 0, 0, 0, 74, 76, 1, 0, 0, 0, 75, 73, 1, 0, 0, 
		    0, 76, 77, 5, 0, 0, 1, 77, 1, 1, 0, 0, 0, 78, 82, 3, 6, 3, 0, 79, 
		    82, 3, 12, 6, 0, 80, 82, 3, 4, 2, 0, 81, 78, 1, 0, 0, 0, 81, 79, 1, 
		    0, 0, 0, 81, 80, 1, 0, 0, 0, 82, 3, 1, 0, 0, 0, 83, 84, 5, 28, 0, 
		    0, 84, 85, 5, 59, 0, 0, 85, 86, 3, 66, 33, 0, 86, 87, 5, 1, 0, 0, 
		    87, 88, 3, 44, 22, 0, 88, 5, 1, 0, 0, 0, 89, 90, 5, 29, 0, 0, 90, 
		    91, 5, 59, 0, 0, 91, 93, 5, 2, 0, 0, 92, 94, 3, 8, 4, 0, 93, 92, 1, 
		    0, 0, 0, 93, 94, 1, 0, 0, 0, 94, 95, 1, 0, 0, 0, 95, 97, 5, 3, 0, 
		    0, 96, 98, 3, 66, 33, 0, 97, 96, 1, 0, 0, 0, 97, 98, 1, 0, 0, 0, 98, 
		    99, 1, 0, 0, 0, 99, 120, 3, 20, 10, 0, 100, 101, 5, 29, 0, 0, 101, 
		    102, 5, 59, 0, 0, 102, 104, 5, 2, 0, 0, 103, 105, 3, 8, 4, 0, 104, 
		    103, 1, 0, 0, 0, 104, 105, 1, 0, 0, 0, 105, 106, 1, 0, 0, 0, 106, 
		    107, 5, 3, 0, 0, 107, 108, 5, 2, 0, 0, 108, 113, 3, 66, 33, 0, 109, 
		    110, 5, 4, 0, 0, 110, 112, 3, 66, 33, 0, 111, 109, 1, 0, 0, 0, 112, 
		    115, 1, 0, 0, 0, 113, 111, 1, 0, 0, 0, 113, 114, 1, 0, 0, 0, 114, 
		    116, 1, 0, 0, 0, 115, 113, 1, 0, 0, 0, 116, 117, 5, 3, 0, 0, 117, 
		    118, 3, 20, 10, 0, 118, 120, 1, 0, 0, 0, 119, 89, 1, 0, 0, 0, 119, 
		    100, 1, 0, 0, 0, 120, 7, 1, 0, 0, 0, 121, 126, 3, 10, 5, 0, 122, 123, 
		    5, 4, 0, 0, 123, 125, 3, 10, 5, 0, 124, 122, 1, 0, 0, 0, 125, 128, 
		    1, 0, 0, 0, 126, 124, 1, 0, 0, 0, 126, 127, 1, 0, 0, 0, 127, 9, 1, 
		    0, 0, 0, 128, 126, 1, 0, 0, 0, 129, 130, 5, 59, 0, 0, 130, 131, 3, 
		    66, 33, 0, 131, 11, 1, 0, 0, 0, 132, 133, 5, 30, 0, 0, 133, 138, 5, 
		    59, 0, 0, 134, 135, 5, 4, 0, 0, 135, 137, 5, 59, 0, 0, 136, 134, 1, 
		    0, 0, 0, 137, 140, 1, 0, 0, 0, 138, 136, 1, 0, 0, 0, 138, 139, 1, 
		    0, 0, 0, 139, 141, 1, 0, 0, 0, 140, 138, 1, 0, 0, 0, 141, 151, 3, 
		    66, 33, 0, 142, 143, 5, 1, 0, 0, 143, 148, 3, 44, 22, 0, 144, 145, 
		    5, 4, 0, 0, 145, 147, 3, 44, 22, 0, 146, 144, 1, 0, 0, 0, 147, 150, 
		    1, 0, 0, 0, 148, 146, 1, 0, 0, 0, 148, 149, 1, 0, 0, 0, 149, 152, 
		    1, 0, 0, 0, 150, 148, 1, 0, 0, 0, 151, 142, 1, 0, 0, 0, 151, 152, 
		    1, 0, 0, 0, 152, 161, 1, 0, 0, 0, 153, 154, 5, 30, 0, 0, 154, 155, 
		    5, 59, 0, 0, 155, 158, 3, 14, 7, 0, 156, 157, 5, 1, 0, 0, 157, 159, 
		    3, 16, 8, 0, 158, 156, 1, 0, 0, 0, 158, 159, 1, 0, 0, 0, 159, 161, 
		    1, 0, 0, 0, 160, 132, 1, 0, 0, 0, 160, 153, 1, 0, 0, 0, 161, 13, 1, 
		    0, 0, 0, 162, 163, 5, 5, 0, 0, 163, 164, 3, 44, 22, 0, 164, 165, 5, 
		    6, 0, 0, 165, 166, 3, 14, 7, 0, 166, 173, 1, 0, 0, 0, 167, 168, 5, 
		    5, 0, 0, 168, 169, 3, 44, 22, 0, 169, 170, 5, 6, 0, 0, 170, 171, 3, 
		    66, 33, 0, 171, 173, 1, 0, 0, 0, 172, 162, 1, 0, 0, 0, 172, 167, 1, 
		    0, 0, 0, 173, 15, 1, 0, 0, 0, 174, 175, 3, 14, 7, 0, 175, 176, 5, 
		    7, 0, 0, 176, 181, 3, 18, 9, 0, 177, 178, 5, 4, 0, 0, 178, 180, 3, 
		    18, 9, 0, 179, 177, 1, 0, 0, 0, 180, 183, 1, 0, 0, 0, 181, 179, 1, 
		    0, 0, 0, 181, 182, 1, 0, 0, 0, 182, 184, 1, 0, 0, 0, 183, 181, 1, 
		    0, 0, 0, 184, 185, 5, 8, 0, 0, 185, 198, 1, 0, 0, 0, 186, 187, 5, 
		    7, 0, 0, 187, 192, 3, 18, 9, 0, 188, 189, 5, 4, 0, 0, 189, 191, 3, 
		    18, 9, 0, 190, 188, 1, 0, 0, 0, 191, 194, 1, 0, 0, 0, 192, 190, 1, 
		    0, 0, 0, 192, 193, 1, 0, 0, 0, 193, 195, 1, 0, 0, 0, 194, 192, 1, 
		    0, 0, 0, 195, 196, 5, 8, 0, 0, 196, 198, 1, 0, 0, 0, 197, 174, 1, 
		    0, 0, 0, 197, 186, 1, 0, 0, 0, 198, 17, 1, 0, 0, 0, 199, 202, 3, 16, 
		    8, 0, 200, 202, 3, 44, 22, 0, 201, 199, 1, 0, 0, 0, 201, 200, 1, 0, 
		    0, 0, 202, 19, 1, 0, 0, 0, 203, 207, 5, 7, 0, 0, 204, 206, 3, 22, 
		    11, 0, 205, 204, 1, 0, 0, 0, 206, 209, 1, 0, 0, 0, 207, 205, 1, 0, 
		    0, 0, 207, 208, 1, 0, 0, 0, 208, 210, 1, 0, 0, 0, 209, 207, 1, 0, 
		    0, 0, 210, 211, 5, 8, 0, 0, 211, 21, 1, 0, 0, 0, 212, 225, 3, 12, 
		    6, 0, 213, 225, 3, 36, 18, 0, 214, 225, 3, 28, 14, 0, 215, 225, 3, 
		    24, 12, 0, 216, 225, 3, 26, 13, 0, 217, 225, 3, 30, 15, 0, 218, 225, 
		    3, 32, 16, 0, 219, 225, 3, 34, 17, 0, 220, 225, 3, 40, 20, 0, 221, 
		    225, 3, 42, 21, 0, 222, 225, 3, 28, 14, 0, 223, 225, 3, 20, 10, 0, 
		    224, 212, 1, 0, 0, 0, 224, 213, 1, 0, 0, 0, 224, 214, 1, 0, 0, 0, 
		    224, 215, 1, 0, 0, 0, 224, 216, 1, 0, 0, 0, 224, 217, 1, 0, 0, 0, 
		    224, 218, 1, 0, 0, 0, 224, 219, 1, 0, 0, 0, 224, 220, 1, 0, 0, 0, 
		    224, 221, 1, 0, 0, 0, 224, 222, 1, 0, 0, 0, 224, 223, 1, 0, 0, 0, 
		    225, 23, 1, 0, 0, 0, 226, 231, 5, 59, 0, 0, 227, 228, 5, 4, 0, 0, 
		    228, 230, 5, 59, 0, 0, 229, 227, 1, 0, 0, 0, 230, 233, 1, 0, 0, 0, 
		    231, 229, 1, 0, 0, 0, 231, 232, 1, 0, 0, 0, 232, 234, 1, 0, 0, 0, 
		    233, 231, 1, 0, 0, 0, 234, 235, 5, 9, 0, 0, 235, 240, 3, 44, 22, 0, 
		    236, 237, 5, 4, 0, 0, 237, 239, 3, 44, 22, 0, 238, 236, 1, 0, 0, 0, 
		    239, 242, 1, 0, 0, 0, 240, 238, 1, 0, 0, 0, 240, 241, 1, 0, 0, 0, 
		    241, 25, 1, 0, 0, 0, 242, 240, 1, 0, 0, 0, 243, 248, 5, 59, 0, 0, 
		    244, 245, 5, 5, 0, 0, 245, 246, 3, 44, 22, 0, 246, 247, 5, 6, 0, 0, 
		    247, 249, 1, 0, 0, 0, 248, 244, 1, 0, 0, 0, 249, 250, 1, 0, 0, 0, 
		    250, 248, 1, 0, 0, 0, 250, 251, 1, 0, 0, 0, 251, 252, 1, 0, 0, 0, 
		    252, 253, 5, 1, 0, 0, 253, 254, 3, 44, 22, 0, 254, 273, 1, 0, 0, 0, 
		    255, 256, 5, 59, 0, 0, 256, 257, 5, 1, 0, 0, 257, 273, 3, 44, 22, 
		    0, 258, 260, 5, 10, 0, 0, 259, 258, 1, 0, 0, 0, 260, 261, 1, 0, 0, 
		    0, 261, 259, 1, 0, 0, 0, 261, 262, 1, 0, 0, 0, 262, 263, 1, 0, 0, 
		    0, 263, 264, 5, 59, 0, 0, 264, 265, 5, 1, 0, 0, 265, 273, 3, 44, 22, 
		    0, 266, 267, 3, 60, 30, 0, 267, 268, 7, 0, 0, 0, 268, 273, 1, 0, 0, 
		    0, 269, 270, 5, 59, 0, 0, 270, 271, 7, 1, 0, 0, 271, 273, 3, 44, 22, 
		    0, 272, 243, 1, 0, 0, 0, 272, 255, 1, 0, 0, 0, 272, 259, 1, 0, 0, 
		    0, 272, 266, 1, 0, 0, 0, 272, 269, 1, 0, 0, 0, 273, 27, 1, 0, 0, 0, 
		    274, 275, 3, 44, 22, 0, 275, 29, 1, 0, 0, 0, 276, 277, 5, 34, 0, 0, 
		    277, 278, 3, 44, 22, 0, 278, 284, 3, 20, 10, 0, 279, 282, 5, 35, 0, 
		    0, 280, 283, 3, 30, 15, 0, 281, 283, 3, 20, 10, 0, 282, 280, 1, 0, 
		    0, 0, 282, 281, 1, 0, 0, 0, 283, 285, 1, 0, 0, 0, 284, 279, 1, 0, 
		    0, 0, 284, 285, 1, 0, 0, 0, 285, 31, 1, 0, 0, 0, 286, 288, 5, 36, 
		    0, 0, 287, 289, 3, 44, 22, 0, 288, 287, 1, 0, 0, 0, 288, 289, 1, 0, 
		    0, 0, 289, 290, 1, 0, 0, 0, 290, 302, 3, 20, 10, 0, 291, 292, 5, 36, 
		    0, 0, 292, 293, 3, 24, 12, 0, 293, 294, 5, 11, 0, 0, 294, 295, 3, 
		    44, 22, 0, 295, 297, 5, 11, 0, 0, 296, 298, 3, 22, 11, 0, 297, 296, 
		    1, 0, 0, 0, 297, 298, 1, 0, 0, 0, 298, 299, 1, 0, 0, 0, 299, 300, 
		    3, 20, 10, 0, 300, 302, 1, 0, 0, 0, 301, 286, 1, 0, 0, 0, 301, 291, 
		    1, 0, 0, 0, 302, 33, 1, 0, 0, 0, 303, 312, 5, 37, 0, 0, 304, 309, 
		    3, 44, 22, 0, 305, 306, 5, 4, 0, 0, 306, 308, 3, 44, 22, 0, 307, 305, 
		    1, 0, 0, 0, 308, 311, 1, 0, 0, 0, 309, 307, 1, 0, 0, 0, 309, 310, 
		    1, 0, 0, 0, 310, 313, 1, 0, 0, 0, 311, 309, 1, 0, 0, 0, 312, 304, 
		    1, 0, 0, 0, 312, 313, 1, 0, 0, 0, 313, 35, 1, 0, 0, 0, 314, 316, 5, 
		    31, 0, 0, 315, 317, 3, 44, 22, 0, 316, 315, 1, 0, 0, 0, 316, 317, 
		    1, 0, 0, 0, 317, 318, 1, 0, 0, 0, 318, 322, 5, 7, 0, 0, 319, 321, 
		    3, 38, 19, 0, 320, 319, 1, 0, 0, 0, 321, 324, 1, 0, 0, 0, 322, 320, 
		    1, 0, 0, 0, 322, 323, 1, 0, 0, 0, 323, 335, 1, 0, 0, 0, 324, 322, 
		    1, 0, 0, 0, 325, 326, 5, 33, 0, 0, 326, 333, 5, 12, 0, 0, 327, 334, 
		    3, 20, 10, 0, 328, 330, 3, 22, 11, 0, 329, 328, 1, 0, 0, 0, 330, 331, 
		    1, 0, 0, 0, 331, 329, 1, 0, 0, 0, 331, 332, 1, 0, 0, 0, 332, 334, 
		    1, 0, 0, 0, 333, 327, 1, 0, 0, 0, 333, 329, 1, 0, 0, 0, 334, 336, 
		    1, 0, 0, 0, 335, 325, 1, 0, 0, 0, 335, 336, 1, 0, 0, 0, 336, 337, 
		    1, 0, 0, 0, 337, 338, 5, 8, 0, 0, 338, 37, 1, 0, 0, 0, 339, 340, 5, 
		    32, 0, 0, 340, 345, 3, 44, 22, 0, 341, 342, 5, 4, 0, 0, 342, 344, 
		    3, 44, 22, 0, 343, 341, 1, 0, 0, 0, 344, 347, 1, 0, 0, 0, 345, 343, 
		    1, 0, 0, 0, 345, 346, 1, 0, 0, 0, 346, 348, 1, 0, 0, 0, 347, 345, 
		    1, 0, 0, 0, 348, 355, 5, 12, 0, 0, 349, 356, 3, 20, 10, 0, 350, 352, 
		    3, 22, 11, 0, 351, 350, 1, 0, 0, 0, 352, 353, 1, 0, 0, 0, 353, 351, 
		    1, 0, 0, 0, 353, 354, 1, 0, 0, 0, 354, 356, 1, 0, 0, 0, 355, 349, 
		    1, 0, 0, 0, 355, 351, 1, 0, 0, 0, 356, 39, 1, 0, 0, 0, 357, 358, 5, 
		    38, 0, 0, 358, 41, 1, 0, 0, 0, 359, 360, 5, 39, 0, 0, 360, 43, 1, 
		    0, 0, 0, 361, 362, 3, 46, 23, 0, 362, 45, 1, 0, 0, 0, 363, 368, 3, 
		    48, 24, 0, 364, 365, 5, 13, 0, 0, 365, 367, 3, 48, 24, 0, 366, 364, 
		    1, 0, 0, 0, 367, 370, 1, 0, 0, 0, 368, 366, 1, 0, 0, 0, 368, 369, 
		    1, 0, 0, 0, 369, 47, 1, 0, 0, 0, 370, 368, 1, 0, 0, 0, 371, 376, 3, 
		    50, 25, 0, 372, 373, 5, 14, 0, 0, 373, 375, 3, 50, 25, 0, 374, 372, 
		    1, 0, 0, 0, 375, 378, 1, 0, 0, 0, 376, 374, 1, 0, 0, 0, 376, 377, 
		    1, 0, 0, 0, 377, 49, 1, 0, 0, 0, 378, 376, 1, 0, 0, 0, 379, 384, 3, 
		    52, 26, 0, 380, 381, 7, 2, 0, 0, 381, 383, 3, 52, 26, 0, 382, 380, 
		    1, 0, 0, 0, 383, 386, 1, 0, 0, 0, 384, 382, 1, 0, 0, 0, 384, 385, 
		    1, 0, 0, 0, 385, 51, 1, 0, 0, 0, 386, 384, 1, 0, 0, 0, 387, 392, 3, 
		    56, 28, 0, 388, 389, 7, 3, 0, 0, 389, 391, 3, 56, 28, 0, 390, 388, 
		    1, 0, 0, 0, 391, 394, 1, 0, 0, 0, 392, 390, 1, 0, 0, 0, 392, 393, 
		    1, 0, 0, 0, 393, 53, 1, 0, 0, 0, 394, 392, 1, 0, 0, 0, 395, 400, 3, 
		    58, 29, 0, 396, 397, 7, 4, 0, 0, 397, 399, 3, 58, 29, 0, 398, 396, 
		    1, 0, 0, 0, 399, 402, 1, 0, 0, 0, 400, 398, 1, 0, 0, 0, 400, 401, 
		    1, 0, 0, 0, 401, 55, 1, 0, 0, 0, 402, 400, 1, 0, 0, 0, 403, 408, 3, 
		    54, 27, 0, 404, 405, 7, 5, 0, 0, 405, 407, 3, 54, 27, 0, 406, 404, 
		    1, 0, 0, 0, 407, 410, 1, 0, 0, 0, 408, 406, 1, 0, 0, 0, 408, 409, 
		    1, 0, 0, 0, 409, 57, 1, 0, 0, 0, 410, 408, 1, 0, 0, 0, 411, 412, 7, 
		    6, 0, 0, 412, 419, 3, 58, 29, 0, 413, 414, 5, 26, 0, 0, 414, 419, 
		    3, 58, 29, 0, 415, 416, 5, 10, 0, 0, 416, 419, 3, 58, 29, 0, 417, 
		    419, 3, 60, 30, 0, 418, 411, 1, 0, 0, 0, 418, 413, 1, 0, 0, 0, 418, 
		    415, 1, 0, 0, 0, 418, 417, 1, 0, 0, 0, 419, 59, 1, 0, 0, 0, 420, 421, 
		    6, 30, -1, 0, 421, 463, 5, 48, 0, 0, 422, 463, 5, 49, 0, 0, 423, 463, 
		    5, 50, 0, 0, 424, 463, 5, 51, 0, 0, 425, 463, 5, 40, 0, 0, 426, 463, 
		    5, 41, 0, 0, 427, 428, 5, 42, 0, 0, 428, 429, 5, 2, 0, 0, 429, 430, 
		    3, 44, 22, 0, 430, 431, 5, 3, 0, 0, 431, 463, 1, 0, 0, 0, 432, 433, 
		    3, 62, 31, 0, 433, 435, 5, 2, 0, 0, 434, 436, 3, 64, 32, 0, 435, 434, 
		    1, 0, 0, 0, 435, 436, 1, 0, 0, 0, 436, 437, 1, 0, 0, 0, 437, 438, 
		    5, 3, 0, 0, 438, 463, 1, 0, 0, 0, 439, 440, 3, 66, 33, 0, 440, 442, 
		    5, 2, 0, 0, 441, 443, 3, 64, 32, 0, 442, 441, 1, 0, 0, 0, 442, 443, 
		    1, 0, 0, 0, 443, 444, 1, 0, 0, 0, 444, 445, 5, 3, 0, 0, 445, 463, 
		    1, 0, 0, 0, 446, 463, 3, 16, 8, 0, 447, 463, 3, 62, 31, 0, 448, 449, 
		    5, 2, 0, 0, 449, 450, 3, 44, 22, 0, 450, 451, 5, 3, 0, 0, 451, 463, 
		    1, 0, 0, 0, 452, 459, 3, 62, 31, 0, 453, 454, 5, 5, 0, 0, 454, 455, 
		    3, 44, 22, 0, 455, 456, 5, 6, 0, 0, 456, 458, 1, 0, 0, 0, 457, 453, 
		    1, 0, 0, 0, 458, 461, 1, 0, 0, 0, 459, 457, 1, 0, 0, 0, 459, 460, 
		    1, 0, 0, 0, 460, 463, 1, 0, 0, 0, 461, 459, 1, 0, 0, 0, 462, 420, 
		    1, 0, 0, 0, 462, 422, 1, 0, 0, 0, 462, 423, 1, 0, 0, 0, 462, 424, 
		    1, 0, 0, 0, 462, 425, 1, 0, 0, 0, 462, 426, 1, 0, 0, 0, 462, 427, 
		    1, 0, 0, 0, 462, 432, 1, 0, 0, 0, 462, 439, 1, 0, 0, 0, 462, 446, 
		    1, 0, 0, 0, 462, 447, 1, 0, 0, 0, 462, 448, 1, 0, 0, 0, 462, 452, 
		    1, 0, 0, 0, 463, 470, 1, 0, 0, 0, 464, 465, 10, 2, 0, 0, 465, 469, 
		    5, 52, 0, 0, 466, 467, 10, 1, 0, 0, 467, 469, 5, 53, 0, 0, 468, 464, 
		    1, 0, 0, 0, 468, 466, 1, 0, 0, 0, 469, 472, 1, 0, 0, 0, 470, 468, 
		    1, 0, 0, 0, 470, 471, 1, 0, 0, 0, 471, 61, 1, 0, 0, 0, 472, 470, 1, 
		    0, 0, 0, 473, 478, 5, 59, 0, 0, 474, 475, 5, 27, 0, 0, 475, 477, 5, 
		    59, 0, 0, 476, 474, 1, 0, 0, 0, 477, 480, 1, 0, 0, 0, 478, 476, 1, 
		    0, 0, 0, 478, 479, 1, 0, 0, 0, 479, 63, 1, 0, 0, 0, 480, 478, 1, 0, 
		    0, 0, 481, 486, 3, 44, 22, 0, 482, 483, 5, 4, 0, 0, 483, 485, 3, 44, 
		    22, 0, 484, 482, 1, 0, 0, 0, 485, 488, 1, 0, 0, 0, 486, 484, 1, 0, 
		    0, 0, 486, 487, 1, 0, 0, 0, 487, 65, 1, 0, 0, 0, 488, 486, 1, 0, 0, 
		    0, 489, 497, 5, 43, 0, 0, 490, 497, 5, 44, 0, 0, 491, 497, 5, 45, 
		    0, 0, 492, 497, 5, 46, 0, 0, 493, 497, 5, 47, 0, 0, 494, 497, 3, 68, 
		    34, 0, 495, 497, 3, 14, 7, 0, 496, 489, 1, 0, 0, 0, 496, 490, 1, 0, 
		    0, 0, 496, 491, 1, 0, 0, 0, 496, 492, 1, 0, 0, 0, 496, 493, 1, 0, 
		    0, 0, 496, 494, 1, 0, 0, 0, 496, 495, 1, 0, 0, 0, 497, 67, 1, 0, 0, 
		    0, 498, 499, 5, 10, 0, 0, 499, 500, 3, 66, 33, 0, 500, 69, 1, 0, 0, 
		    0, 56, 73, 81, 93, 97, 104, 113, 119, 126, 138, 148, 151, 158, 160, 
		    172, 181, 192, 197, 201, 207, 224, 231, 240, 250, 261, 272, 282, 284, 
		    288, 297, 301, 309, 312, 316, 322, 331, 333, 335, 345, 353, 355, 368, 
		    376, 384, 392, 400, 408, 418, 435, 442, 459, 462, 468, 470, 478, 486, 
		    496];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.1', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(73);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1879048192) !== 0)) {
		        	$this->setState(70);
		        	$this->declaration();
		        	$this->setState(75);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(76);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration(): Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declaration);

		    try {
		        $this->setState(81);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::FUNC:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(78);
		            	$this->functionDecl();
		            	break;

		            case self::VAR:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(79);
		            	$this->varDecl();
		            	break;

		            case self::CONST:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(80);
		            	$this->constDecl();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(83);
		        $this->match(self::CONST);
		        $this->setState(84);
		        $this->match(self::IDENTIFIER);
		        $this->setState(85);
		        $this->type();
		        $this->setState(86);
		        $this->match(self::T__0);
		        $this->setState(87);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_functionDecl);

		    try {
		        $this->setState(119);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 6, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(89);
		        	    $this->match(self::FUNC);
		        	    $this->setState(90);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(91);
		        	    $this->match(self::T__1);
		        	    $this->setState(93);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::IDENTIFIER) {
		        	    	$this->setState(92);
		        	    	$this->parameterList();
		        	    }
		        	    $this->setState(95);
		        	    $this->match(self::T__2);
		        	    $this->setState(97);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 272678883689504) !== 0)) {
		        	    	$this->setState(96);
		        	    	$this->type();
		        	    }
		        	    $this->setState(99);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(100);
		        	    $this->match(self::FUNC);
		        	    $this->setState(101);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(102);
		        	    $this->match(self::T__1);
		        	    $this->setState(104);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::IDENTIFIER) {
		        	    	$this->setState(103);
		        	    	$this->parameterList();
		        	    }
		        	    $this->setState(106);
		        	    $this->match(self::T__2);
		        	    $this->setState(107);
		        	    $this->match(self::T__1);
		        	    $this->setState(108);
		        	    $this->type();
		        	    $this->setState(113);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__3) {
		        	    	$this->setState(109);
		        	    	$this->match(self::T__3);
		        	    	$this->setState(110);
		        	    	$this->type();
		        	    	$this->setState(115);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(116);
		        	    $this->match(self::T__2);
		        	    $this->setState(117);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameterList(): Context\ParameterListContext
		{
		    $localContext = new Context\ParameterListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_parameterList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(121);
		        $this->parameter();
		        $this->setState(126);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__3) {
		        	$this->setState(122);
		        	$this->match(self::T__3);
		        	$this->setState(123);
		        	$this->parameter();
		        	$this->setState(128);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameter(): Context\ParameterContext
		{
		    $localContext = new Context\ParameterContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_parameter);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(129);
		        $this->match(self::IDENTIFIER);
		        $this->setState(130);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_varDecl);

		    try {
		        $this->setState(160);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(132);
		        	    $this->match(self::VAR);
		        	    $this->setState(133);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(138);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__3) {
		        	    	$this->setState(134);
		        	    	$this->match(self::T__3);
		        	    	$this->setState(135);
		        	    	$this->match(self::IDENTIFIER);
		        	    	$this->setState(140);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(141);
		        	    $this->type();
		        	    $this->setState(151);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__0) {
		        	    	$this->setState(142);
		        	    	$this->match(self::T__0);
		        	    	$this->setState(143);
		        	    	$this->expression();
		        	    	$this->setState(148);
		        	    	$this->errorHandler->sync($this);

		        	    	$_la = $this->input->LA(1);
		        	    	while ($_la === self::T__3) {
		        	    		$this->setState(144);
		        	    		$this->match(self::T__3);
		        	    		$this->setState(145);
		        	    		$this->expression();
		        	    		$this->setState(150);
		        	    		$this->errorHandler->sync($this);
		        	    		$_la = $this->input->LA(1);
		        	    	}
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(153);
		        	    $this->match(self::VAR);
		        	    $this->setState(154);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(155);
		        	    $this->arrayType();
		        	    $this->setState(158);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__0) {
		        	    	$this->setState(156);
		        	    	$this->match(self::T__0);
		        	    	$this->setState(157);
		        	    	$this->arrayLiteral();
		        	    }
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayType(): Context\ArrayTypeContext
		{
		    $localContext = new Context\ArrayTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_arrayType);

		    try {
		        $this->setState(172);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 13, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(162);
		        	    $this->match(self::T__4);
		        	    $this->setState(163);
		        	    $this->expression();
		        	    $this->setState(164);
		        	    $this->match(self::T__5);
		        	    $this->setState(165);
		        	    $this->arrayType();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(167);
		        	    $this->match(self::T__4);
		        	    $this->setState(168);
		        	    $this->expression();
		        	    $this->setState(169);
		        	    $this->match(self::T__5);
		        	    $this->setState(170);
		        	    $this->type();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_arrayLiteral);

		    try {
		        $this->setState(197);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__4:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(174);
		            	$this->arrayType();
		            	$this->setState(175);
		            	$this->match(self::T__6);
		            	$this->setState(176);
		            	$this->arrayElement();
		            	$this->setState(181);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::T__3) {
		            		$this->setState(177);
		            		$this->match(self::T__3);
		            		$this->setState(178);
		            		$this->arrayElement();
		            		$this->setState(183);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(184);
		            	$this->match(self::T__7);
		            	break;

		            case self::T__6:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(186);
		            	$this->match(self::T__6);
		            	$this->setState(187);
		            	$this->arrayElement();
		            	$this->setState(192);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::T__3) {
		            		$this->setState(188);
		            		$this->match(self::T__3);
		            		$this->setState(189);
		            		$this->arrayElement();
		            		$this->setState(194);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(195);
		            	$this->match(self::T__7);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayElement(): Context\ArrayElementContext
		{
		    $localContext = new Context\ArrayElementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_arrayElement);

		    try {
		        $this->setState(201);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(199);
		        	    $this->arrayLiteral();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(200);
		        	    $this->expression();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(203);
		        $this->match(self::T__6);
		        $this->setState(207);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 580964303717270692) !== 0)) {
		        	$this->setState(204);
		        	$this->statement();
		        	$this->setState(209);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(210);
		        $this->match(self::T__7);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_statement);

		    try {
		        $this->setState(224);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(212);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(213);
		        	    $this->switchStmt();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(214);
		        	    $this->expresionStmt();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(215);
		        	    $this->shortVarDecl();
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(216);
		        	    $this->assignment();
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(217);
		        	    $this->ifStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(218);
		        	    $this->forStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(219);
		        	    $this->returnStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(220);
		        	    $this->breakStmt();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(221);
		        	    $this->continueStmt();
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(222);
		        	    $this->expresionStmt();
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(223);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDecl(): Context\ShortVarDeclContext
		{
		    $localContext = new Context\ShortVarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_shortVarDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(226);
		        $this->match(self::IDENTIFIER);
		        $this->setState(231);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__3) {
		        	$this->setState(227);
		        	$this->match(self::T__3);
		        	$this->setState(228);
		        	$this->match(self::IDENTIFIER);
		        	$this->setState(233);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(234);
		        $this->match(self::T__8);
		        $this->setState(235);
		        $this->expression();
		        $this->setState(240);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__3) {
		        	$this->setState(236);
		        	$this->match(self::T__3);
		        	$this->setState(237);
		        	$this->expression();
		        	$this->setState(242);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_assignment);

		    try {
		        $this->setState(272);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 24, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(243);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(248); 
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    do {
		        	    	$this->setState(244);
		        	    	$this->match(self::T__4);
		        	    	$this->setState(245);
		        	    	$this->expression();
		        	    	$this->setState(246);
		        	    	$this->match(self::T__5);
		        	    	$this->setState(250); 
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    } while ($_la === self::T__4);
		        	    $this->setState(252);
		        	    $this->match(self::T__0);
		        	    $this->setState(253);
		        	    $this->expression();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(255);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(256);
		        	    $this->match(self::T__0);
		        	    $this->setState(257);
		        	    $this->expression();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(259); 
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    do {
		        	    	$this->setState(258);
		        	    	$this->match(self::T__9);
		        	    	$this->setState(261); 
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    } while ($_la === self::T__9);
		        	    $this->setState(263);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(264);
		        	    $this->match(self::T__0);
		        	    $this->setState(265);
		        	    $this->expression();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(266);
		        	    $this->recursivePrimary(0);
		        	    $this->setState(267);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::PLUSPLUS || $_la === self::MINUSMINUS)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(269);
		        	    $this->match(self::IDENTIFIER);
		        	    $this->setState(270);

		        	    $_la = $this->input->LA(1);

		        	    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 558446353793941504) !== 0))) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(271);
		        	    $this->expression();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionStmt(): Context\ExpresionStmtContext
		{
		    $localContext = new Context\ExpresionStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_expresionStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(274);
		        $this->expression();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(276);
		        $this->match(self::IF);
		        $this->setState(277);
		        $this->expression();
		        $this->setState(278);
		        $this->block();
		        $this->setState(284);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(279);
		        	$this->match(self::ELSE);
		        	$this->setState(282);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(280);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::T__6:
		        	    	$this->setState(281);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_forStmt);

		    try {
		        $this->setState(301);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(286);
		        	    $this->match(self::FOR);
		        	    $this->setState(288);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 27, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(287);
		        	    	    $this->expression();
		        	    	break;
		        	    }
		        	    $this->setState(290);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(291);
		        	    $this->match(self::FOR);
		        	    $this->setState(292);
		        	    $this->shortVarDecl();
		        	    $this->setState(293);
		        	    $this->match(self::T__10);
		        	    $this->setState(294);
		        	    $this->expression();
		        	    $this->setState(295);
		        	    $this->match(self::T__10);
		        	    $this->setState(297);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(296);
		        	    	    $this->statement();
		        	    	break;
		        	    }
		        	    $this->setState(299);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(303);
		        $this->match(self::RETURN);
		        $this->setState(312);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 31, $this->ctx)) {
		            case 1:
		        	    $this->setState(304);
		        	    $this->expression();
		        	    $this->setState(309);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__3) {
		        	    	$this->setState(305);
		        	    	$this->match(self::T__3);
		        	    	$this->setState(306);
		        	    	$this->expression();
		        	    	$this->setState(311);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(314);
		        $this->match(self::SWITCH);
		        $this->setState(316);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 32, $this->ctx)) {
		            case 1:
		        	    $this->setState(315);
		        	    $this->expression();
		        	break;
		        }
		        $this->setState(318);
		        $this->match(self::T__6);
		        $this->setState(322);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(319);
		        	$this->switchCase();
		        	$this->setState(324);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(335);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(325);
		        	$this->match(self::DEFAULT);
		        	$this->setState(326);
		        	$this->match(self::T__11);
		        	$this->setState(333);
		        	$this->errorHandler->sync($this);

		        	switch ($this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx)) {
		        		case 1:
		        		    $this->setState(327);
		        		    $this->block();
		        		break;

		        		case 2:
		        		    $this->setState(329); 
		        		    $this->errorHandler->sync($this);

		        		    $_la = $this->input->LA(1);
		        		    do {
		        		    	$this->setState(328);
		        		    	$this->statement();
		        		    	$this->setState(331); 
		        		    	$this->errorHandler->sync($this);
		        		    	$_la = $this->input->LA(1);
		        		    } while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 580964303717270692) !== 0));
		        		break;
		        	}
		        }
		        $this->setState(337);
		        $this->match(self::T__7);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchCase(): Context\SwitchCaseContext
		{
		    $localContext = new Context\SwitchCaseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_switchCase);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(339);
		        $this->match(self::CASE);
		        $this->setState(340);
		        $this->expression();
		        $this->setState(345);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__3) {
		        	$this->setState(341);
		        	$this->match(self::T__3);
		        	$this->setState(342);
		        	$this->expression();
		        	$this->setState(347);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(348);
		        $this->match(self::T__11);
		        $this->setState(355);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx)) {
		        	case 1:
		        	    $this->setState(349);
		        	    $this->block();
		        	break;

		        	case 2:
		        	    $this->setState(351); 
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    do {
		        	    	$this->setState(350);
		        	    	$this->statement();
		        	    	$this->setState(353); 
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    } while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 580964303717270692) !== 0));
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(357);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(359);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
		    $localContext = new Context\ExpressionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_expression);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(361);
		        $this->logicalOr();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalOr(): Context\LogicalOrContext
		{
		    $localContext = new Context\LogicalOrContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_logicalOr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(363);
		        $this->logicalAnd();
		        $this->setState(368);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__12) {
		        	$this->setState(364);
		        	$this->match(self::T__12);
		        	$this->setState(365);
		        	$this->logicalAnd();
		        	$this->setState(370);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function logicalAnd(): Context\LogicalAndContext
		{
		    $localContext = new Context\LogicalAndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_logicalAnd);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(371);
		        $this->equality();
		        $this->setState(376);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(372);
		        	$this->match(self::T__13);
		        	$this->setState(373);
		        	$this->equality();
		        	$this->setState(378);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function equality(): Context\EqualityContext
		{
		    $localContext = new Context\EqualityContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_equality);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(379);
		        $this->comparison();
		        $this->setState(384);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__14 || $_la === self::T__15) {
		        	$this->setState(380);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::T__14 || $_la === self::T__15)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(381);
		        	$this->comparison();
		        	$this->setState(386);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function comparison(): Context\ComparisonContext
		{
		    $localContext = new Context\ComparisonContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_comparison);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(387);
		        $this->multiplication();
		        $this->setState(392);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1966080) !== 0)) {
		        	$this->setState(388);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1966080) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(389);
		        	$this->multiplication();
		        	$this->setState(394);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function addition(): Context\AdditionContext
		{
		    $localContext = new Context\AdditionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_addition);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(395);
		        $this->unary();
		        $this->setState(400);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 44, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(396);

		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::T__20 || $_la === self::T__21)) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(397);
		        		$this->unary(); 
		        	}

		        	$this->setState(402);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 44, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function multiplication(): Context\MultiplicationContext
		{
		    $localContext = new Context\MultiplicationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_multiplication);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(403);
		        $this->addition();
		        $this->setState(408);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 45, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(404);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 25166848) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(405);
		        		$this->addition(); 
		        	}

		        	$this->setState(410);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 45, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function unary(): Context\UnaryContext
		{
		    $localContext = new Context\UnaryContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_unary);

		    try {
		        $this->setState(418);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 46, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(411);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::T__21 || $_la === self::T__24)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(412);
		        	    $this->unary();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(413);
		        	    $this->match(self::T__25);
		        	    $this->setState(414);
		        	    $this->unary();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(415);
		        	    $this->match(self::T__9);
		        	    $this->setState(416);
		        	    $this->unary();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(417);
		        	    $this->recursivePrimary(0);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function primary(): Context\PrimaryContext
		{
			return $this->recursivePrimary(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursivePrimary(int $precedence): Context\PrimaryContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\PrimaryContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 60;
			$this->enterRecursionRule($localContext, 60, self::RULE_primary, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(462);
				$this->errorHandler->sync($this);

				switch ($this->getInterpreter()->adaptivePredict($this->input, 50, $this->ctx)) {
					case 1:
					    $this->setState(421);
					    $this->match(self::INTEGER);
					break;

					case 2:
					    $this->setState(422);
					    $this->match(self::FLOAT);
					break;

					case 3:
					    $this->setState(423);
					    $this->match(self::STRING);
					break;

					case 4:
					    $this->setState(424);
					    $this->match(self::RUNE);
					break;

					case 5:
					    $this->setState(425);
					    $this->match(self::TRUE);
					break;

					case 6:
					    $this->setState(426);
					    $this->match(self::FALSE);
					break;

					case 7:
					    $this->setState(427);
					    $this->match(self::LEN);
					    $this->setState(428);
					    $this->match(self::T__1);
					    $this->setState(429);
					    $this->expression();
					    $this->setState(430);
					    $this->match(self::T__2);
					break;

					case 8:
					    $this->setState(432);
					    $this->qualified();
					    $this->setState(433);
					    $this->match(self::T__1);
					    $this->setState(435);
					    $this->errorHandler->sync($this);
					    $_la = $this->input->LA(1);

					    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 580963252524024996) !== 0)) {
					    	$this->setState(434);
					    	$this->argumentList();
					    }
					    $this->setState(437);
					    $this->match(self::T__2);
					break;

					case 9:
					    $this->setState(439);
					    $this->type();
					    $this->setState(440);
					    $this->match(self::T__1);
					    $this->setState(442);
					    $this->errorHandler->sync($this);
					    $_la = $this->input->LA(1);

					    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 580963252524024996) !== 0)) {
					    	$this->setState(441);
					    	$this->argumentList();
					    }
					    $this->setState(444);
					    $this->match(self::T__2);
					break;

					case 10:
					    $this->setState(446);
					    $this->arrayLiteral();
					break;

					case 11:
					    $this->setState(447);
					    $this->qualified();
					break;

					case 12:
					    $this->setState(448);
					    $this->match(self::T__1);
					    $this->setState(449);
					    $this->expression();
					    $this->setState(450);
					    $this->match(self::T__2);
					break;

					case 13:
					    $this->setState(452);
					    $this->qualified();
					    $this->setState(459);
					    $this->errorHandler->sync($this);

					    $alt = $this->getInterpreter()->adaptivePredict($this->input, 49, $this->ctx);

					    while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					    	if ($alt === 1) {
					    		$this->setState(453);
					    		$this->match(self::T__4);
					    		$this->setState(454);
					    		$this->expression();
					    		$this->setState(455);
					    		$this->match(self::T__5); 
					    	}

					    	$this->setState(461);
					    	$this->errorHandler->sync($this);

					    	$alt = $this->getInterpreter()->adaptivePredict($this->input, 49, $this->ctx);
					    }
					break;
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(470);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 52, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(468);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 51, $this->ctx)) {
							case 1:
							    $localContext = new Context\PrimaryContext($parentContext, $parentState);
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_primary);
							    $this->setState(464);

							    if (!($this->precpred($this->ctx, 2))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 2)");
							    }
							    $this->setState(465);
							    $this->match(self::PLUSPLUS);
							break;

							case 2:
							    $localContext = new Context\PrimaryContext($parentContext, $parentState);
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_primary);
							    $this->setState(466);

							    if (!($this->precpred($this->ctx, 1))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 1)");
							    }
							    $this->setState(467);
							    $this->match(self::MINUSMINUS);
							break;
						} 
					}

					$this->setState(472);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 52, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function qualified(): Context\QualifiedContext
		{
		    $localContext = new Context\QualifiedContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_qualified);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(473);
		        $this->match(self::IDENTIFIER);
		        $this->setState(478);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 53, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(474);
		        		$this->match(self::T__26);
		        		$this->setState(475);
		        		$this->match(self::IDENTIFIER); 
		        	}

		        	$this->setState(480);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 53, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function argumentList(): Context\ArgumentListContext
		{
		    $localContext = new Context\ArgumentListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_argumentList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(481);
		        $this->expression();
		        $this->setState(486);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__3) {
		        	$this->setState(482);
		        	$this->match(self::T__3);
		        	$this->setState(483);
		        	$this->expression();
		        	$this->setState(488);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_type);

		    try {
		        $this->setState(496);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(489);
		            	$this->match(self::INT);
		            	break;

		            case self::FLOATTYPE:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(490);
		            	$this->match(self::FLOATTYPE);
		            	break;

		            case self::BOOL:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(491);
		            	$this->match(self::BOOL);
		            	break;

		            case self::STRINGTYPE:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(492);
		            	$this->match(self::STRINGTYPE);
		            	break;

		            case self::RUNETYPE:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(493);
		            	$this->match(self::RUNETYPE);
		            	break;

		            case self::T__9:
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(494);
		            	$this->pointerType();
		            	break;

		            case self::T__4:
		            	$this->enterOuterAlt($localContext, 7);
		            	$this->setState(495);
		            	$this->arrayType();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function pointerType(): Context\PointerTypeContext
		{
		    $localContext = new Context\PointerTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_pointerType);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(498);
		        $this->match(self::T__9);
		        $this->setState(499);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 30:
						return $this->sempredPrimary($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredPrimary(?Context\PrimaryContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 2);

			    case 1:
			        return $this->precpred($this->ctx, 1);
			}

			return true;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GolampiParser;
	use GolampiVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaration;
	    }

	    public function functionDecl(): ?FunctionDeclContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclContext::class, 0);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_constDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_functionDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameterList(): ?ParameterListContext
	    {
	    	return $this->getTypedRuleContext(ParameterListContext::class, 0);
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parameterList;
	    }

	    /**
	     * @return array<ParameterContext>|ParameterContext|null
	     */
	    public function parameter(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParameterContext::class);
	    	}

	        return $this->getTypedRuleContext(ParameterContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParameterList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parameter;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFIER, $index);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayType;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayLiteral;
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

	    /**
	     * @return array<ArrayElementContext>|ArrayElementContext|null
	     */
	    public function arrayElement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ArrayElementContext::class);
	    	}

	        return $this->getTypedRuleContext(ArrayElementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayElementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayElement;
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayElement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_block;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_statement;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function expresionStmt(): ?ExpresionStmtContext
	    {
	    	return $this->getTypedRuleContext(ExpresionStmtContext::class, 0);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStatement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_shortVarDecl;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFIER, $index);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignment;
	    }

	    public function IDENTIFIER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFIER, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

	    public function PLUSPLUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUSPLUS, 0);
	    }

	    public function MINUSMINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUSMINUS, 0);
	    }

	    public function PLUSEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUSEQ, 0);
	    }

	    public function MINUSEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUSEQ, 0);
	    }

	    public function STAREQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STAREQ, 0);
	    }

	    public function SLASHEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SLASHEQ, 0);
	    }

	    public function MODEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MODEQ, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionStmt;
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    public function statement(): ?StatementContext
	    {
	    	return $this->getTypedRuleContext(StatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<SwitchCaseContext>|SwitchCaseContext|null
	     */
	    public function switchCase(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SwitchCaseContext::class);
	    	}

	        return $this->getTypedRuleContext(SwitchCaseContext::class, $index);
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchCaseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchCase;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchCase($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTINUE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expression;
	    }

	    public function logicalOr(): ?LogicalOrContext
	    {
	    	return $this->getTypedRuleContext(LogicalOrContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpression($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalOrContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_logicalOr;
	    }

	    /**
	     * @return array<LogicalAndContext>|LogicalAndContext|null
	     */
	    public function logicalAnd(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(LogicalAndContext::class);
	    	}

	        return $this->getTypedRuleContext(LogicalAndContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LogicalAndContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_logicalAnd;
	    }

	    /**
	     * @return array<EqualityContext>|EqualityContext|null
	     */
	    public function equality(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(EqualityContext::class);
	    	}

	        return $this->getTypedRuleContext(EqualityContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLogicalAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class EqualityContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_equality;
	    }

	    /**
	     * @return array<ComparisonContext>|ComparisonContext|null
	     */
	    public function comparison(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ComparisonContext::class);
	    	}

	        return $this->getTypedRuleContext(ComparisonContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitEquality($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ComparisonContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_comparison;
	    }

	    /**
	     * @return array<MultiplicationContext>|MultiplicationContext|null
	     */
	    public function multiplication(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(MultiplicationContext::class);
	    	}

	        return $this->getTypedRuleContext(MultiplicationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitComparison($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AdditionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_addition;
	    }

	    /**
	     * @return array<UnaryContext>|UnaryContext|null
	     */
	    public function unary(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(UnaryContext::class);
	    	}

	        return $this->getTypedRuleContext(UnaryContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAddition($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MultiplicationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_multiplication;
	    }

	    /**
	     * @return array<AdditionContext>|AdditionContext|null
	     */
	    public function addition(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(AdditionContext::class);
	    	}

	        return $this->getTypedRuleContext(AdditionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitMultiplication($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UnaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_unary;
	    }

	    public function unary(): ?UnaryContext
	    {
	    	return $this->getTypedRuleContext(UnaryContext::class, 0);
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitUnary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrimaryContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_primary;
	    }

	    public function INTEGER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INTEGER, 0);
	    }

	    public function FLOAT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

	    public function TRUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TRUE, 0);
	    }

	    public function FALSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FALSE, 0);
	    }

	    public function LEN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LEN, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function qualified(): ?QualifiedContext
	    {
	    	return $this->getTypedRuleContext(QualifiedContext::class, 0);
	    }

	    public function argumentList(): ?ArgumentListContext
	    {
	    	return $this->getTypedRuleContext(ArgumentListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

	    public function primary(): ?PrimaryContext
	    {
	    	return $this->getTypedRuleContext(PrimaryContext::class, 0);
	    }

	    public function PLUSPLUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUSPLUS, 0);
	    }

	    public function MINUSMINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUSMINUS, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrimary($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class QualifiedContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_qualified;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFIER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFIER);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFIER, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitQualified($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgumentListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_argumentList;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArgumentList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_type;
	    }

	    public function INT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT, 0);
	    }

	    public function FLOATTYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOATTYPE, 0);
	    }

	    public function BOOL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL, 0);
	    }

	    public function STRINGTYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRINGTYPE, 0);
	    }

	    public function RUNETYPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNETYPE, 0);
	    }

	    public function pointerType(): ?PointerTypeContext
	    {
	    	return $this->getTypedRuleContext(PointerTypeContext::class, 0);
	    }

	    public function arrayType(): ?ArrayTypeContext
	    {
	    	return $this->getTypedRuleContext(ArrayTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PointerTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_pointerType;
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPointerType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}