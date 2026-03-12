// Generated from /home/lilimon/Documentos/Compiladores 2/C2P1 202110378/grammar/Golampi.g4 by ANTLR 4.13.1
import org.antlr.v4.runtime.atn.*;
import org.antlr.v4.runtime.dfa.DFA;
import org.antlr.v4.runtime.*;
import org.antlr.v4.runtime.misc.*;
import org.antlr.v4.runtime.tree.*;
import java.util.List;
import java.util.Iterator;
import java.util.ArrayList;

@SuppressWarnings({"all", "warnings", "unchecked", "unused", "cast", "CheckReturnValue"})
public class GolampiParser extends Parser {
	static { RuntimeMetaData.checkVersion("4.13.1", RuntimeMetaData.VERSION); }

	protected static final DFA[] _decisionToDFA;
	protected static final PredictionContextCache _sharedContextCache =
		new PredictionContextCache();
	public static final int
		T__0=1, T__1=2, T__2=3, T__3=4, T__4=5, T__5=6, T__6=7, T__7=8, T__8=9, 
		T__9=10, T__10=11, T__11=12, T__12=13, T__13=14, T__14=15, T__15=16, T__16=17, 
		T__17=18, T__18=19, T__19=20, T__20=21, T__21=22, T__22=23, T__23=24, 
		T__24=25, T__25=26, T__26=27, CONST=28, FUNC=29, VAR=30, SWITCH=31, CASE=32, 
		DEFAULT=33, IF=34, ELSE=35, FOR=36, RETURN=37, BREAK=38, CONTINUE=39, 
		TRUE=40, FALSE=41, LEN=42, INT=43, FLOATTYPE=44, BOOL=45, STRINGTYPE=46, 
		RUNETYPE=47, INTEGER=48, FLOAT=49, STRING=50, RUNE=51, PLUSPLUS=52, MINUSMINUS=53, 
		PLUSEQ=54, MINUSEQ=55, STAREQ=56, SLASHEQ=57, MODEQ=58, IDENTIFIER=59, 
		WS=60, NL=61, COMMENT=62, MULTILINE_COMMENT=63;
	public static final int
		RULE_program = 0, RULE_declaration = 1, RULE_constDecl = 2, RULE_functionDecl = 3, 
		RULE_parameterList = 4, RULE_parameter = 5, RULE_varDecl = 6, RULE_arrayType = 7, 
		RULE_arrayLiteral = 8, RULE_arrayElement = 9, RULE_block = 10, RULE_statement = 11, 
		RULE_shortVarDecl = 12, RULE_assignment = 13, RULE_expresionStmt = 14, 
		RULE_ifStmt = 15, RULE_forStmt = 16, RULE_returnStmt = 17, RULE_switchStmt = 18, 
		RULE_switchCase = 19, RULE_breakStmt = 20, RULE_continueStmt = 21, RULE_expression = 22, 
		RULE_logicalOr = 23, RULE_logicalAnd = 24, RULE_equality = 25, RULE_comparison = 26, 
		RULE_addition = 27, RULE_multiplication = 28, RULE_unary = 29, RULE_primary = 30, 
		RULE_qualified = 31, RULE_argumentList = 32, RULE_type = 33, RULE_pointerType = 34;
	private static String[] makeRuleNames() {
		return new String[] {
			"program", "declaration", "constDecl", "functionDecl", "parameterList", 
			"parameter", "varDecl", "arrayType", "arrayLiteral", "arrayElement", 
			"block", "statement", "shortVarDecl", "assignment", "expresionStmt", 
			"ifStmt", "forStmt", "returnStmt", "switchStmt", "switchCase", "breakStmt", 
			"continueStmt", "expression", "logicalOr", "logicalAnd", "equality", 
			"comparison", "addition", "multiplication", "unary", "primary", "qualified", 
			"argumentList", "type", "pointerType"
		};
	}
	public static final String[] ruleNames = makeRuleNames();

	private static String[] makeLiteralNames() {
		return new String[] {
			null, "'='", "'('", "')'", "','", "'['", "']'", "'{'", "'}'", "':='", 
			"'*'", "';'", "':'", "'||'", "'&&'", "'=='", "'!='", "'>'", "'<'", "'>='", 
			"'<='", "'+'", "'-'", "'/'", "'%'", "'!'", "'&'", "'.'", "'const'", "'func'", 
			"'var'", "'switch'", "'case'", "'default'", "'if'", "'else'", "'for'", 
			"'return'", "'break'", "'continue'", "'true'", "'false'", "'len'", null, 
			null, "'bool'", "'string'", "'rune'", null, null, null, null, "'++'", 
			"'--'", "'+='", "'-='", "'*='", "'/='", "'%='"
		};
	}
	private static final String[] _LITERAL_NAMES = makeLiteralNames();
	private static String[] makeSymbolicNames() {
		return new String[] {
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, "CONST", "FUNC", "VAR", "SWITCH", "CASE", "DEFAULT", 
			"IF", "ELSE", "FOR", "RETURN", "BREAK", "CONTINUE", "TRUE", "FALSE", 
			"LEN", "INT", "FLOATTYPE", "BOOL", "STRINGTYPE", "RUNETYPE", "INTEGER", 
			"FLOAT", "STRING", "RUNE", "PLUSPLUS", "MINUSMINUS", "PLUSEQ", "MINUSEQ", 
			"STAREQ", "SLASHEQ", "MODEQ", "IDENTIFIER", "WS", "NL", "COMMENT", "MULTILINE_COMMENT"
		};
	}
	private static final String[] _SYMBOLIC_NAMES = makeSymbolicNames();
	public static final Vocabulary VOCABULARY = new VocabularyImpl(_LITERAL_NAMES, _SYMBOLIC_NAMES);

	/**
	 * @deprecated Use {@link #VOCABULARY} instead.
	 */
	@Deprecated
	public static final String[] tokenNames;
	static {
		tokenNames = new String[_SYMBOLIC_NAMES.length];
		for (int i = 0; i < tokenNames.length; i++) {
			tokenNames[i] = VOCABULARY.getLiteralName(i);
			if (tokenNames[i] == null) {
				tokenNames[i] = VOCABULARY.getSymbolicName(i);
			}

			if (tokenNames[i] == null) {
				tokenNames[i] = "<INVALID>";
			}
		}
	}

	@Override
	@Deprecated
	public String[] getTokenNames() {
		return tokenNames;
	}

	@Override

	public Vocabulary getVocabulary() {
		return VOCABULARY;
	}

	@Override
	public String getGrammarFileName() { return "Golampi.g4"; }

	@Override
	public String[] getRuleNames() { return ruleNames; }

	@Override
	public String getSerializedATN() { return _serializedATN; }

	@Override
	public ATN getATN() { return _ATN; }

	public GolampiParser(TokenStream input) {
		super(input);
		_interp = new ParserATNSimulator(this,_ATN,_decisionToDFA,_sharedContextCache);
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ProgramContext extends ParserRuleContext {
		public TerminalNode EOF() { return getToken(GolampiParser.EOF, 0); }
		public List<DeclarationContext> declaration() {
			return getRuleContexts(DeclarationContext.class);
		}
		public DeclarationContext declaration(int i) {
			return getRuleContext(DeclarationContext.class,i);
		}
		public ProgramContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_program; }
	}

	public final ProgramContext program() throws RecognitionException {
		ProgramContext _localctx = new ProgramContext(_ctx, getState());
		enterRule(_localctx, 0, RULE_program);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(73);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 1879048192L) != 0)) {
				{
				{
				setState(70);
				declaration();
				}
				}
				setState(75);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(76);
			match(EOF);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class DeclarationContext extends ParserRuleContext {
		public FunctionDeclContext functionDecl() {
			return getRuleContext(FunctionDeclContext.class,0);
		}
		public VarDeclContext varDecl() {
			return getRuleContext(VarDeclContext.class,0);
		}
		public ConstDeclContext constDecl() {
			return getRuleContext(ConstDeclContext.class,0);
		}
		public DeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_declaration; }
	}

	public final DeclarationContext declaration() throws RecognitionException {
		DeclarationContext _localctx = new DeclarationContext(_ctx, getState());
		enterRule(_localctx, 2, RULE_declaration);
		try {
			setState(81);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case FUNC:
				enterOuterAlt(_localctx, 1);
				{
				setState(78);
				functionDecl();
				}
				break;
			case VAR:
				enterOuterAlt(_localctx, 2);
				{
				setState(79);
				varDecl();
				}
				break;
			case CONST:
				enterOuterAlt(_localctx, 3);
				{
				setState(80);
				constDecl();
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ConstDeclContext extends ParserRuleContext {
		public TerminalNode CONST() { return getToken(GolampiParser.CONST, 0); }
		public TerminalNode IDENTIFIER() { return getToken(GolampiParser.IDENTIFIER, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ConstDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_constDecl; }
	}

	public final ConstDeclContext constDecl() throws RecognitionException {
		ConstDeclContext _localctx = new ConstDeclContext(_ctx, getState());
		enterRule(_localctx, 4, RULE_constDecl);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(83);
			match(CONST);
			setState(84);
			match(IDENTIFIER);
			setState(85);
			type();
			setState(86);
			match(T__0);
			setState(87);
			expression();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class FunctionDeclContext extends ParserRuleContext {
		public TerminalNode FUNC() { return getToken(GolampiParser.FUNC, 0); }
		public TerminalNode IDENTIFIER() { return getToken(GolampiParser.IDENTIFIER, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ParameterListContext parameterList() {
			return getRuleContext(ParameterListContext.class,0);
		}
		public List<TypeContext> type() {
			return getRuleContexts(TypeContext.class);
		}
		public TypeContext type(int i) {
			return getRuleContext(TypeContext.class,i);
		}
		public FunctionDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_functionDecl; }
	}

	public final FunctionDeclContext functionDecl() throws RecognitionException {
		FunctionDeclContext _localctx = new FunctionDeclContext(_ctx, getState());
		enterRule(_localctx, 6, RULE_functionDecl);
		int _la;
		try {
			setState(119);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,6,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(89);
				match(FUNC);
				setState(90);
				match(IDENTIFIER);
				setState(91);
				match(T__1);
				setState(93);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==IDENTIFIER) {
					{
					setState(92);
					parameterList();
					}
				}

				setState(95);
				match(T__2);
				setState(97);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 272678883689504L) != 0)) {
					{
					setState(96);
					type();
					}
				}

				setState(99);
				block();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(100);
				match(FUNC);
				setState(101);
				match(IDENTIFIER);
				setState(102);
				match(T__1);
				setState(104);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==IDENTIFIER) {
					{
					setState(103);
					parameterList();
					}
				}

				setState(106);
				match(T__2);
				setState(107);
				match(T__1);
				setState(108);
				type();
				setState(113);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__3) {
					{
					{
					setState(109);
					match(T__3);
					setState(110);
					type();
					}
					}
					setState(115);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(116);
				match(T__2);
				setState(117);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParameterListContext extends ParserRuleContext {
		public List<ParameterContext> parameter() {
			return getRuleContexts(ParameterContext.class);
		}
		public ParameterContext parameter(int i) {
			return getRuleContext(ParameterContext.class,i);
		}
		public ParameterListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameterList; }
	}

	public final ParameterListContext parameterList() throws RecognitionException {
		ParameterListContext _localctx = new ParameterListContext(_ctx, getState());
		enterRule(_localctx, 8, RULE_parameterList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(121);
			parameter();
			setState(126);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__3) {
				{
				{
				setState(122);
				match(T__3);
				setState(123);
				parameter();
				}
				}
				setState(128);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParameterContext extends ParserRuleContext {
		public TerminalNode IDENTIFIER() { return getToken(GolampiParser.IDENTIFIER, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ParameterContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameter; }
	}

	public final ParameterContext parameter() throws RecognitionException {
		ParameterContext _localctx = new ParameterContext(_ctx, getState());
		enterRule(_localctx, 10, RULE_parameter);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(129);
			match(IDENTIFIER);
			setState(130);
			type();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclContext extends ParserRuleContext {
		public TerminalNode VAR() { return getToken(GolampiParser.VAR, 0); }
		public List<TerminalNode> IDENTIFIER() { return getTokens(GolampiParser.IDENTIFIER); }
		public TerminalNode IDENTIFIER(int i) {
			return getToken(GolampiParser.IDENTIFIER, i);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ArrayTypeContext arrayType() {
			return getRuleContext(ArrayTypeContext.class,0);
		}
		public ArrayLiteralContext arrayLiteral() {
			return getRuleContext(ArrayLiteralContext.class,0);
		}
		public VarDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_varDecl; }
	}

	public final VarDeclContext varDecl() throws RecognitionException {
		VarDeclContext _localctx = new VarDeclContext(_ctx, getState());
		enterRule(_localctx, 12, RULE_varDecl);
		int _la;
		try {
			setState(160);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,12,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(132);
				match(VAR);
				setState(133);
				match(IDENTIFIER);
				setState(138);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__3) {
					{
					{
					setState(134);
					match(T__3);
					setState(135);
					match(IDENTIFIER);
					}
					}
					setState(140);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(141);
				type();
				setState(151);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__0) {
					{
					setState(142);
					match(T__0);
					setState(143);
					expression();
					setState(148);
					_errHandler.sync(this);
					_la = _input.LA(1);
					while (_la==T__3) {
						{
						{
						setState(144);
						match(T__3);
						setState(145);
						expression();
						}
						}
						setState(150);
						_errHandler.sync(this);
						_la = _input.LA(1);
					}
					}
				}

				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(153);
				match(VAR);
				setState(154);
				match(IDENTIFIER);
				setState(155);
				arrayType();
				setState(158);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__0) {
					{
					setState(156);
					match(T__0);
					setState(157);
					arrayLiteral();
					}
				}

				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArrayTypeContext extends ParserRuleContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ArrayTypeContext arrayType() {
			return getRuleContext(ArrayTypeContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ArrayTypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_arrayType; }
	}

	public final ArrayTypeContext arrayType() throws RecognitionException {
		ArrayTypeContext _localctx = new ArrayTypeContext(_ctx, getState());
		enterRule(_localctx, 14, RULE_arrayType);
		try {
			setState(172);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,13,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(162);
				match(T__4);
				setState(163);
				expression();
				setState(164);
				match(T__5);
				setState(165);
				arrayType();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(167);
				match(T__4);
				setState(168);
				expression();
				setState(169);
				match(T__5);
				setState(170);
				type();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArrayLiteralContext extends ParserRuleContext {
		public ArrayTypeContext arrayType() {
			return getRuleContext(ArrayTypeContext.class,0);
		}
		public List<ArrayElementContext> arrayElement() {
			return getRuleContexts(ArrayElementContext.class);
		}
		public ArrayElementContext arrayElement(int i) {
			return getRuleContext(ArrayElementContext.class,i);
		}
		public ArrayLiteralContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_arrayLiteral; }
	}

	public final ArrayLiteralContext arrayLiteral() throws RecognitionException {
		ArrayLiteralContext _localctx = new ArrayLiteralContext(_ctx, getState());
		enterRule(_localctx, 16, RULE_arrayLiteral);
		int _la;
		try {
			setState(197);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case T__4:
				enterOuterAlt(_localctx, 1);
				{
				setState(174);
				arrayType();
				setState(175);
				match(T__6);
				setState(176);
				arrayElement();
				setState(181);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__3) {
					{
					{
					setState(177);
					match(T__3);
					setState(178);
					arrayElement();
					}
					}
					setState(183);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(184);
				match(T__7);
				}
				break;
			case T__6:
				enterOuterAlt(_localctx, 2);
				{
				setState(186);
				match(T__6);
				setState(187);
				arrayElement();
				setState(192);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__3) {
					{
					{
					setState(188);
					match(T__3);
					setState(189);
					arrayElement();
					}
					}
					setState(194);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(195);
				match(T__7);
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArrayElementContext extends ParserRuleContext {
		public ArrayLiteralContext arrayLiteral() {
			return getRuleContext(ArrayLiteralContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ArrayElementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_arrayElement; }
	}

	public final ArrayElementContext arrayElement() throws RecognitionException {
		ArrayElementContext _localctx = new ArrayElementContext(_ctx, getState());
		enterRule(_localctx, 18, RULE_arrayElement);
		try {
			setState(201);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,17,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(199);
				arrayLiteral();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(200);
				expression();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class BlockContext extends ParserRuleContext {
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public BlockContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_block; }
	}

	public final BlockContext block() throws RecognitionException {
		BlockContext _localctx = new BlockContext(_ctx, getState());
		enterRule(_localctx, 20, RULE_block);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(203);
			match(T__6);
			setState(207);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 580964303717270692L) != 0)) {
				{
				{
				setState(204);
				statement();
				}
				}
				setState(209);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(210);
			match(T__7);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class StatementContext extends ParserRuleContext {
		public VarDeclContext varDecl() {
			return getRuleContext(VarDeclContext.class,0);
		}
		public SwitchStmtContext switchStmt() {
			return getRuleContext(SwitchStmtContext.class,0);
		}
		public ExpresionStmtContext expresionStmt() {
			return getRuleContext(ExpresionStmtContext.class,0);
		}
		public ShortVarDeclContext shortVarDecl() {
			return getRuleContext(ShortVarDeclContext.class,0);
		}
		public AssignmentContext assignment() {
			return getRuleContext(AssignmentContext.class,0);
		}
		public IfStmtContext ifStmt() {
			return getRuleContext(IfStmtContext.class,0);
		}
		public ForStmtContext forStmt() {
			return getRuleContext(ForStmtContext.class,0);
		}
		public ReturnStmtContext returnStmt() {
			return getRuleContext(ReturnStmtContext.class,0);
		}
		public BreakStmtContext breakStmt() {
			return getRuleContext(BreakStmtContext.class,0);
		}
		public ContinueStmtContext continueStmt() {
			return getRuleContext(ContinueStmtContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public StatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_statement; }
	}

	public final StatementContext statement() throws RecognitionException {
		StatementContext _localctx = new StatementContext(_ctx, getState());
		enterRule(_localctx, 22, RULE_statement);
		try {
			setState(224);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,19,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(212);
				varDecl();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(213);
				switchStmt();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(214);
				expresionStmt();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(215);
				shortVarDecl();
				}
				break;
			case 5:
				enterOuterAlt(_localctx, 5);
				{
				setState(216);
				assignment();
				}
				break;
			case 6:
				enterOuterAlt(_localctx, 6);
				{
				setState(217);
				ifStmt();
				}
				break;
			case 7:
				enterOuterAlt(_localctx, 7);
				{
				setState(218);
				forStmt();
				}
				break;
			case 8:
				enterOuterAlt(_localctx, 8);
				{
				setState(219);
				returnStmt();
				}
				break;
			case 9:
				enterOuterAlt(_localctx, 9);
				{
				setState(220);
				breakStmt();
				}
				break;
			case 10:
				enterOuterAlt(_localctx, 10);
				{
				setState(221);
				continueStmt();
				}
				break;
			case 11:
				enterOuterAlt(_localctx, 11);
				{
				setState(222);
				expresionStmt();
				}
				break;
			case 12:
				enterOuterAlt(_localctx, 12);
				{
				setState(223);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ShortVarDeclContext extends ParserRuleContext {
		public List<TerminalNode> IDENTIFIER() { return getTokens(GolampiParser.IDENTIFIER); }
		public TerminalNode IDENTIFIER(int i) {
			return getToken(GolampiParser.IDENTIFIER, i);
		}
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ShortVarDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_shortVarDecl; }
	}

	public final ShortVarDeclContext shortVarDecl() throws RecognitionException {
		ShortVarDeclContext _localctx = new ShortVarDeclContext(_ctx, getState());
		enterRule(_localctx, 24, RULE_shortVarDecl);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(226);
			match(IDENTIFIER);
			setState(231);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__3) {
				{
				{
				setState(227);
				match(T__3);
				setState(228);
				match(IDENTIFIER);
				}
				}
				setState(233);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(234);
			match(T__8);
			setState(235);
			expression();
			setState(240);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__3) {
				{
				{
				setState(236);
				match(T__3);
				setState(237);
				expression();
				}
				}
				setState(242);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class AssignmentContext extends ParserRuleContext {
		public TerminalNode IDENTIFIER() { return getToken(GolampiParser.IDENTIFIER, 0); }
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public PrimaryContext primary() {
			return getRuleContext(PrimaryContext.class,0);
		}
		public TerminalNode PLUSPLUS() { return getToken(GolampiParser.PLUSPLUS, 0); }
		public TerminalNode MINUSMINUS() { return getToken(GolampiParser.MINUSMINUS, 0); }
		public TerminalNode PLUSEQ() { return getToken(GolampiParser.PLUSEQ, 0); }
		public TerminalNode MINUSEQ() { return getToken(GolampiParser.MINUSEQ, 0); }
		public TerminalNode STAREQ() { return getToken(GolampiParser.STAREQ, 0); }
		public TerminalNode SLASHEQ() { return getToken(GolampiParser.SLASHEQ, 0); }
		public TerminalNode MODEQ() { return getToken(GolampiParser.MODEQ, 0); }
		public AssignmentContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_assignment; }
	}

	public final AssignmentContext assignment() throws RecognitionException {
		AssignmentContext _localctx = new AssignmentContext(_ctx, getState());
		enterRule(_localctx, 26, RULE_assignment);
		int _la;
		try {
			setState(272);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,24,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(243);
				match(IDENTIFIER);
				setState(248); 
				_errHandler.sync(this);
				_la = _input.LA(1);
				do {
					{
					{
					setState(244);
					match(T__4);
					setState(245);
					expression();
					setState(246);
					match(T__5);
					}
					}
					setState(250); 
					_errHandler.sync(this);
					_la = _input.LA(1);
				} while ( _la==T__4 );
				setState(252);
				match(T__0);
				setState(253);
				expression();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(255);
				match(IDENTIFIER);
				setState(256);
				match(T__0);
				setState(257);
				expression();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(259); 
				_errHandler.sync(this);
				_la = _input.LA(1);
				do {
					{
					{
					setState(258);
					match(T__9);
					}
					}
					setState(261); 
					_errHandler.sync(this);
					_la = _input.LA(1);
				} while ( _la==T__9 );
				setState(263);
				match(IDENTIFIER);
				setState(264);
				match(T__0);
				setState(265);
				expression();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(266);
				primary(0);
				setState(267);
				_la = _input.LA(1);
				if ( !(_la==PLUSPLUS || _la==MINUSMINUS) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				}
				break;
			case 5:
				enterOuterAlt(_localctx, 5);
				{
				setState(269);
				match(IDENTIFIER);
				setState(270);
				_la = _input.LA(1);
				if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 558446353793941504L) != 0)) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(271);
				expression();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExpresionStmtContext extends ParserRuleContext {
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ExpresionStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expresionStmt; }
	}

	public final ExpresionStmtContext expresionStmt() throws RecognitionException {
		ExpresionStmtContext _localctx = new ExpresionStmtContext(_ctx, getState());
		enterRule(_localctx, 28, RULE_expresionStmt);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(274);
			expression();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IfStmtContext extends ParserRuleContext {
		public TerminalNode IF() { return getToken(GolampiParser.IF, 0); }
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public List<BlockContext> block() {
			return getRuleContexts(BlockContext.class);
		}
		public BlockContext block(int i) {
			return getRuleContext(BlockContext.class,i);
		}
		public TerminalNode ELSE() { return getToken(GolampiParser.ELSE, 0); }
		public IfStmtContext ifStmt() {
			return getRuleContext(IfStmtContext.class,0);
		}
		public IfStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_ifStmt; }
	}

	public final IfStmtContext ifStmt() throws RecognitionException {
		IfStmtContext _localctx = new IfStmtContext(_ctx, getState());
		enterRule(_localctx, 30, RULE_ifStmt);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(276);
			match(IF);
			setState(277);
			expression();
			setState(278);
			block();
			setState(284);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==ELSE) {
				{
				setState(279);
				match(ELSE);
				setState(282);
				_errHandler.sync(this);
				switch (_input.LA(1)) {
				case IF:
					{
					setState(280);
					ifStmt();
					}
					break;
				case T__6:
					{
					setState(281);
					block();
					}
					break;
				default:
					throw new NoViableAltException(this);
				}
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ForStmtContext extends ParserRuleContext {
		public TerminalNode FOR() { return getToken(GolampiParser.FOR, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public ShortVarDeclContext shortVarDecl() {
			return getRuleContext(ShortVarDeclContext.class,0);
		}
		public StatementContext statement() {
			return getRuleContext(StatementContext.class,0);
		}
		public ForStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_forStmt; }
	}

	public final ForStmtContext forStmt() throws RecognitionException {
		ForStmtContext _localctx = new ForStmtContext(_ctx, getState());
		enterRule(_localctx, 32, RULE_forStmt);
		try {
			setState(301);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,29,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(286);
				match(FOR);
				setState(288);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,27,_ctx) ) {
				case 1:
					{
					setState(287);
					expression();
					}
					break;
				}
				setState(290);
				block();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(291);
				match(FOR);
				setState(292);
				shortVarDecl();
				setState(293);
				match(T__10);
				setState(294);
				expression();
				setState(295);
				match(T__10);
				setState(297);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,28,_ctx) ) {
				case 1:
					{
					setState(296);
					statement();
					}
					break;
				}
				setState(299);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ReturnStmtContext extends ParserRuleContext {
		public TerminalNode RETURN() { return getToken(GolampiParser.RETURN, 0); }
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ReturnStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_returnStmt; }
	}

	public final ReturnStmtContext returnStmt() throws RecognitionException {
		ReturnStmtContext _localctx = new ReturnStmtContext(_ctx, getState());
		enterRule(_localctx, 34, RULE_returnStmt);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(303);
			match(RETURN);
			setState(312);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,31,_ctx) ) {
			case 1:
				{
				setState(304);
				expression();
				setState(309);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__3) {
					{
					{
					setState(305);
					match(T__3);
					setState(306);
					expression();
					}
					}
					setState(311);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				}
				break;
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class SwitchStmtContext extends ParserRuleContext {
		public TerminalNode SWITCH() { return getToken(GolampiParser.SWITCH, 0); }
		public ExpressionContext expression() {
			return getRuleContext(ExpressionContext.class,0);
		}
		public List<SwitchCaseContext> switchCase() {
			return getRuleContexts(SwitchCaseContext.class);
		}
		public SwitchCaseContext switchCase(int i) {
			return getRuleContext(SwitchCaseContext.class,i);
		}
		public TerminalNode DEFAULT() { return getToken(GolampiParser.DEFAULT, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public SwitchStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_switchStmt; }
	}

	public final SwitchStmtContext switchStmt() throws RecognitionException {
		SwitchStmtContext _localctx = new SwitchStmtContext(_ctx, getState());
		enterRule(_localctx, 36, RULE_switchStmt);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(314);
			match(SWITCH);
			setState(316);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,32,_ctx) ) {
			case 1:
				{
				setState(315);
				expression();
				}
				break;
			}
			setState(318);
			match(T__6);
			setState(322);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==CASE) {
				{
				{
				setState(319);
				switchCase();
				}
				}
				setState(324);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(335);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==DEFAULT) {
				{
				setState(325);
				match(DEFAULT);
				setState(326);
				match(T__11);
				setState(333);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,35,_ctx) ) {
				case 1:
					{
					setState(327);
					block();
					}
					break;
				case 2:
					{
					setState(329); 
					_errHandler.sync(this);
					_la = _input.LA(1);
					do {
						{
						{
						setState(328);
						statement();
						}
						}
						setState(331); 
						_errHandler.sync(this);
						_la = _input.LA(1);
					} while ( (((_la) & ~0x3f) == 0 && ((1L << _la) & 580964303717270692L) != 0) );
					}
					break;
				}
				}
			}

			setState(337);
			match(T__7);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class SwitchCaseContext extends ParserRuleContext {
		public TerminalNode CASE() { return getToken(GolampiParser.CASE, 0); }
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public SwitchCaseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_switchCase; }
	}

	public final SwitchCaseContext switchCase() throws RecognitionException {
		SwitchCaseContext _localctx = new SwitchCaseContext(_ctx, getState());
		enterRule(_localctx, 38, RULE_switchCase);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(339);
			match(CASE);
			setState(340);
			expression();
			setState(345);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__3) {
				{
				{
				setState(341);
				match(T__3);
				setState(342);
				expression();
				}
				}
				setState(347);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(348);
			match(T__11);
			setState(355);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,39,_ctx) ) {
			case 1:
				{
				setState(349);
				block();
				}
				break;
			case 2:
				{
				setState(351); 
				_errHandler.sync(this);
				_la = _input.LA(1);
				do {
					{
					{
					setState(350);
					statement();
					}
					}
					setState(353); 
					_errHandler.sync(this);
					_la = _input.LA(1);
				} while ( (((_la) & ~0x3f) == 0 && ((1L << _la) & 580964303717270692L) != 0) );
				}
				break;
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class BreakStmtContext extends ParserRuleContext {
		public TerminalNode BREAK() { return getToken(GolampiParser.BREAK, 0); }
		public BreakStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_breakStmt; }
	}

	public final BreakStmtContext breakStmt() throws RecognitionException {
		BreakStmtContext _localctx = new BreakStmtContext(_ctx, getState());
		enterRule(_localctx, 40, RULE_breakStmt);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(357);
			match(BREAK);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ContinueStmtContext extends ParserRuleContext {
		public TerminalNode CONTINUE() { return getToken(GolampiParser.CONTINUE, 0); }
		public ContinueStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_continueStmt; }
	}

	public final ContinueStmtContext continueStmt() throws RecognitionException {
		ContinueStmtContext _localctx = new ContinueStmtContext(_ctx, getState());
		enterRule(_localctx, 42, RULE_continueStmt);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(359);
			match(CONTINUE);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExpressionContext extends ParserRuleContext {
		public LogicalOrContext logicalOr() {
			return getRuleContext(LogicalOrContext.class,0);
		}
		public ExpressionContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expression; }
	}

	public final ExpressionContext expression() throws RecognitionException {
		ExpressionContext _localctx = new ExpressionContext(_ctx, getState());
		enterRule(_localctx, 44, RULE_expression);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(361);
			logicalOr();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class LogicalOrContext extends ParserRuleContext {
		public List<LogicalAndContext> logicalAnd() {
			return getRuleContexts(LogicalAndContext.class);
		}
		public LogicalAndContext logicalAnd(int i) {
			return getRuleContext(LogicalAndContext.class,i);
		}
		public LogicalOrContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_logicalOr; }
	}

	public final LogicalOrContext logicalOr() throws RecognitionException {
		LogicalOrContext _localctx = new LogicalOrContext(_ctx, getState());
		enterRule(_localctx, 46, RULE_logicalOr);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(363);
			logicalAnd();
			setState(368);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__12) {
				{
				{
				setState(364);
				match(T__12);
				setState(365);
				logicalAnd();
				}
				}
				setState(370);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class LogicalAndContext extends ParserRuleContext {
		public List<EqualityContext> equality() {
			return getRuleContexts(EqualityContext.class);
		}
		public EqualityContext equality(int i) {
			return getRuleContext(EqualityContext.class,i);
		}
		public LogicalAndContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_logicalAnd; }
	}

	public final LogicalAndContext logicalAnd() throws RecognitionException {
		LogicalAndContext _localctx = new LogicalAndContext(_ctx, getState());
		enterRule(_localctx, 48, RULE_logicalAnd);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(371);
			equality();
			setState(376);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__13) {
				{
				{
				setState(372);
				match(T__13);
				setState(373);
				equality();
				}
				}
				setState(378);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class EqualityContext extends ParserRuleContext {
		public List<ComparisonContext> comparison() {
			return getRuleContexts(ComparisonContext.class);
		}
		public ComparisonContext comparison(int i) {
			return getRuleContext(ComparisonContext.class,i);
		}
		public EqualityContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_equality; }
	}

	public final EqualityContext equality() throws RecognitionException {
		EqualityContext _localctx = new EqualityContext(_ctx, getState());
		enterRule(_localctx, 50, RULE_equality);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(379);
			comparison();
			setState(384);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__14 || _la==T__15) {
				{
				{
				setState(380);
				_la = _input.LA(1);
				if ( !(_la==T__14 || _la==T__15) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(381);
				comparison();
				}
				}
				setState(386);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ComparisonContext extends ParserRuleContext {
		public List<AdditionContext> addition() {
			return getRuleContexts(AdditionContext.class);
		}
		public AdditionContext addition(int i) {
			return getRuleContext(AdditionContext.class,i);
		}
		public ComparisonContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_comparison; }
	}

	public final ComparisonContext comparison() throws RecognitionException {
		ComparisonContext _localctx = new ComparisonContext(_ctx, getState());
		enterRule(_localctx, 52, RULE_comparison);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(387);
			addition();
			setState(392);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 1966080L) != 0)) {
				{
				{
				setState(388);
				_la = _input.LA(1);
				if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 1966080L) != 0)) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(389);
				addition();
				}
				}
				setState(394);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class AdditionContext extends ParserRuleContext {
		public List<MultiplicationContext> multiplication() {
			return getRuleContexts(MultiplicationContext.class);
		}
		public MultiplicationContext multiplication(int i) {
			return getRuleContext(MultiplicationContext.class,i);
		}
		public AdditionContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_addition; }
	}

	public final AdditionContext addition() throws RecognitionException {
		AdditionContext _localctx = new AdditionContext(_ctx, getState());
		enterRule(_localctx, 54, RULE_addition);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(395);
			multiplication();
			setState(400);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,44,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(396);
					_la = _input.LA(1);
					if ( !(_la==T__20 || _la==T__21) ) {
					_errHandler.recoverInline(this);
					}
					else {
						if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
						_errHandler.reportMatch(this);
						consume();
					}
					setState(397);
					multiplication();
					}
					} 
				}
				setState(402);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,44,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class MultiplicationContext extends ParserRuleContext {
		public List<UnaryContext> unary() {
			return getRuleContexts(UnaryContext.class);
		}
		public UnaryContext unary(int i) {
			return getRuleContext(UnaryContext.class,i);
		}
		public MultiplicationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_multiplication; }
	}

	public final MultiplicationContext multiplication() throws RecognitionException {
		MultiplicationContext _localctx = new MultiplicationContext(_ctx, getState());
		enterRule(_localctx, 56, RULE_multiplication);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(403);
			unary();
			setState(408);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,45,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(404);
					_la = _input.LA(1);
					if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 25166848L) != 0)) ) {
					_errHandler.recoverInline(this);
					}
					else {
						if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
						_errHandler.reportMatch(this);
						consume();
					}
					setState(405);
					unary();
					}
					} 
				}
				setState(410);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,45,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class UnaryContext extends ParserRuleContext {
		public UnaryContext unary() {
			return getRuleContext(UnaryContext.class,0);
		}
		public PrimaryContext primary() {
			return getRuleContext(PrimaryContext.class,0);
		}
		public UnaryContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_unary; }
	}

	public final UnaryContext unary() throws RecognitionException {
		UnaryContext _localctx = new UnaryContext(_ctx, getState());
		enterRule(_localctx, 58, RULE_unary);
		int _la;
		try {
			setState(418);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,46,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(411);
				_la = _input.LA(1);
				if ( !(_la==T__21 || _la==T__24) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(412);
				unary();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(413);
				match(T__25);
				setState(414);
				unary();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(415);
				match(T__9);
				setState(416);
				unary();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(417);
				primary(0);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class PrimaryContext extends ParserRuleContext {
		public TerminalNode INTEGER() { return getToken(GolampiParser.INTEGER, 0); }
		public TerminalNode FLOAT() { return getToken(GolampiParser.FLOAT, 0); }
		public TerminalNode STRING() { return getToken(GolampiParser.STRING, 0); }
		public TerminalNode RUNE() { return getToken(GolampiParser.RUNE, 0); }
		public TerminalNode TRUE() { return getToken(GolampiParser.TRUE, 0); }
		public TerminalNode FALSE() { return getToken(GolampiParser.FALSE, 0); }
		public TerminalNode LEN() { return getToken(GolampiParser.LEN, 0); }
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public QualifiedContext qualified() {
			return getRuleContext(QualifiedContext.class,0);
		}
		public ArgumentListContext argumentList() {
			return getRuleContext(ArgumentListContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ArrayLiteralContext arrayLiteral() {
			return getRuleContext(ArrayLiteralContext.class,0);
		}
		public PrimaryContext primary() {
			return getRuleContext(PrimaryContext.class,0);
		}
		public TerminalNode PLUSPLUS() { return getToken(GolampiParser.PLUSPLUS, 0); }
		public TerminalNode MINUSMINUS() { return getToken(GolampiParser.MINUSMINUS, 0); }
		public PrimaryContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_primary; }
	}

	public final PrimaryContext primary() throws RecognitionException {
		return primary(0);
	}

	private PrimaryContext primary(int _p) throws RecognitionException {
		ParserRuleContext _parentctx = _ctx;
		int _parentState = getState();
		PrimaryContext _localctx = new PrimaryContext(_ctx, _parentState);
		PrimaryContext _prevctx = _localctx;
		int _startState = 60;
		enterRecursionRule(_localctx, 60, RULE_primary, _p);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(462);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,50,_ctx) ) {
			case 1:
				{
				setState(421);
				match(INTEGER);
				}
				break;
			case 2:
				{
				setState(422);
				match(FLOAT);
				}
				break;
			case 3:
				{
				setState(423);
				match(STRING);
				}
				break;
			case 4:
				{
				setState(424);
				match(RUNE);
				}
				break;
			case 5:
				{
				setState(425);
				match(TRUE);
				}
				break;
			case 6:
				{
				setState(426);
				match(FALSE);
				}
				break;
			case 7:
				{
				setState(427);
				match(LEN);
				setState(428);
				match(T__1);
				setState(429);
				expression();
				setState(430);
				match(T__2);
				}
				break;
			case 8:
				{
				setState(432);
				qualified();
				setState(433);
				match(T__1);
				setState(435);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 580963252524024996L) != 0)) {
					{
					setState(434);
					argumentList();
					}
				}

				setState(437);
				match(T__2);
				}
				break;
			case 9:
				{
				setState(439);
				type();
				setState(440);
				match(T__1);
				setState(442);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 580963252524024996L) != 0)) {
					{
					setState(441);
					argumentList();
					}
				}

				setState(444);
				match(T__2);
				}
				break;
			case 10:
				{
				setState(446);
				arrayLiteral();
				}
				break;
			case 11:
				{
				setState(447);
				qualified();
				}
				break;
			case 12:
				{
				setState(448);
				match(T__1);
				setState(449);
				expression();
				setState(450);
				match(T__2);
				}
				break;
			case 13:
				{
				setState(452);
				qualified();
				setState(459);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,49,_ctx);
				while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
					if ( _alt==1 ) {
						{
						{
						setState(453);
						match(T__4);
						setState(454);
						expression();
						setState(455);
						match(T__5);
						}
						} 
					}
					setState(461);
					_errHandler.sync(this);
					_alt = getInterpreter().adaptivePredict(_input,49,_ctx);
				}
				}
				break;
			}
			_ctx.stop = _input.LT(-1);
			setState(470);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,52,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					if ( _parseListeners!=null ) triggerExitRuleEvent();
					_prevctx = _localctx;
					{
					setState(468);
					_errHandler.sync(this);
					switch ( getInterpreter().adaptivePredict(_input,51,_ctx) ) {
					case 1:
						{
						_localctx = new PrimaryContext(_parentctx, _parentState);
						pushNewRecursionContext(_localctx, _startState, RULE_primary);
						setState(464);
						if (!(precpred(_ctx, 2))) throw new FailedPredicateException(this, "precpred(_ctx, 2)");
						setState(465);
						match(PLUSPLUS);
						}
						break;
					case 2:
						{
						_localctx = new PrimaryContext(_parentctx, _parentState);
						pushNewRecursionContext(_localctx, _startState, RULE_primary);
						setState(466);
						if (!(precpred(_ctx, 1))) throw new FailedPredicateException(this, "precpred(_ctx, 1)");
						setState(467);
						match(MINUSMINUS);
						}
						break;
					}
					} 
				}
				setState(472);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,52,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			unrollRecursionContexts(_parentctx);
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class QualifiedContext extends ParserRuleContext {
		public List<TerminalNode> IDENTIFIER() { return getTokens(GolampiParser.IDENTIFIER); }
		public TerminalNode IDENTIFIER(int i) {
			return getToken(GolampiParser.IDENTIFIER, i);
		}
		public QualifiedContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_qualified; }
	}

	public final QualifiedContext qualified() throws RecognitionException {
		QualifiedContext _localctx = new QualifiedContext(_ctx, getState());
		enterRule(_localctx, 62, RULE_qualified);
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(473);
			match(IDENTIFIER);
			setState(478);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,53,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(474);
					match(T__26);
					setState(475);
					match(IDENTIFIER);
					}
					} 
				}
				setState(480);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,53,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ArgumentListContext extends ParserRuleContext {
		public List<ExpressionContext> expression() {
			return getRuleContexts(ExpressionContext.class);
		}
		public ExpressionContext expression(int i) {
			return getRuleContext(ExpressionContext.class,i);
		}
		public ArgumentListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_argumentList; }
	}

	public final ArgumentListContext argumentList() throws RecognitionException {
		ArgumentListContext _localctx = new ArgumentListContext(_ctx, getState());
		enterRule(_localctx, 64, RULE_argumentList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(481);
			expression();
			setState(486);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__3) {
				{
				{
				setState(482);
				match(T__3);
				setState(483);
				expression();
				}
				}
				setState(488);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class TypeContext extends ParserRuleContext {
		public TerminalNode INT() { return getToken(GolampiParser.INT, 0); }
		public TerminalNode FLOATTYPE() { return getToken(GolampiParser.FLOATTYPE, 0); }
		public TerminalNode BOOL() { return getToken(GolampiParser.BOOL, 0); }
		public TerminalNode STRINGTYPE() { return getToken(GolampiParser.STRINGTYPE, 0); }
		public TerminalNode RUNETYPE() { return getToken(GolampiParser.RUNETYPE, 0); }
		public PointerTypeContext pointerType() {
			return getRuleContext(PointerTypeContext.class,0);
		}
		public ArrayTypeContext arrayType() {
			return getRuleContext(ArrayTypeContext.class,0);
		}
		public TypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_type; }
	}

	public final TypeContext type() throws RecognitionException {
		TypeContext _localctx = new TypeContext(_ctx, getState());
		enterRule(_localctx, 66, RULE_type);
		try {
			setState(496);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case INT:
				enterOuterAlt(_localctx, 1);
				{
				setState(489);
				match(INT);
				}
				break;
			case FLOATTYPE:
				enterOuterAlt(_localctx, 2);
				{
				setState(490);
				match(FLOATTYPE);
				}
				break;
			case BOOL:
				enterOuterAlt(_localctx, 3);
				{
				setState(491);
				match(BOOL);
				}
				break;
			case STRINGTYPE:
				enterOuterAlt(_localctx, 4);
				{
				setState(492);
				match(STRINGTYPE);
				}
				break;
			case RUNETYPE:
				enterOuterAlt(_localctx, 5);
				{
				setState(493);
				match(RUNETYPE);
				}
				break;
			case T__9:
				enterOuterAlt(_localctx, 6);
				{
				setState(494);
				pointerType();
				}
				break;
			case T__4:
				enterOuterAlt(_localctx, 7);
				{
				setState(495);
				arrayType();
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class PointerTypeContext extends ParserRuleContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public PointerTypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_pointerType; }
	}

	public final PointerTypeContext pointerType() throws RecognitionException {
		PointerTypeContext _localctx = new PointerTypeContext(_ctx, getState());
		enterRule(_localctx, 68, RULE_pointerType);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(498);
			match(T__9);
			setState(499);
			type();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	public boolean sempred(RuleContext _localctx, int ruleIndex, int predIndex) {
		switch (ruleIndex) {
		case 30:
			return primary_sempred((PrimaryContext)_localctx, predIndex);
		}
		return true;
	}
	private boolean primary_sempred(PrimaryContext _localctx, int predIndex) {
		switch (predIndex) {
		case 0:
			return precpred(_ctx, 2);
		case 1:
			return precpred(_ctx, 1);
		}
		return true;
	}

	public static final String _serializedATN =
		"\u0004\u0001?\u01f6\u0002\u0000\u0007\u0000\u0002\u0001\u0007\u0001\u0002"+
		"\u0002\u0007\u0002\u0002\u0003\u0007\u0003\u0002\u0004\u0007\u0004\u0002"+
		"\u0005\u0007\u0005\u0002\u0006\u0007\u0006\u0002\u0007\u0007\u0007\u0002"+
		"\b\u0007\b\u0002\t\u0007\t\u0002\n\u0007\n\u0002\u000b\u0007\u000b\u0002"+
		"\f\u0007\f\u0002\r\u0007\r\u0002\u000e\u0007\u000e\u0002\u000f\u0007\u000f"+
		"\u0002\u0010\u0007\u0010\u0002\u0011\u0007\u0011\u0002\u0012\u0007\u0012"+
		"\u0002\u0013\u0007\u0013\u0002\u0014\u0007\u0014\u0002\u0015\u0007\u0015"+
		"\u0002\u0016\u0007\u0016\u0002\u0017\u0007\u0017\u0002\u0018\u0007\u0018"+
		"\u0002\u0019\u0007\u0019\u0002\u001a\u0007\u001a\u0002\u001b\u0007\u001b"+
		"\u0002\u001c\u0007\u001c\u0002\u001d\u0007\u001d\u0002\u001e\u0007\u001e"+
		"\u0002\u001f\u0007\u001f\u0002 \u0007 \u0002!\u0007!\u0002\"\u0007\"\u0001"+
		"\u0000\u0005\u0000H\b\u0000\n\u0000\f\u0000K\t\u0000\u0001\u0000\u0001"+
		"\u0000\u0001\u0001\u0001\u0001\u0001\u0001\u0003\u0001R\b\u0001\u0001"+
		"\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001"+
		"\u0003\u0001\u0003\u0001\u0003\u0001\u0003\u0003\u0003^\b\u0003\u0001"+
		"\u0003\u0001\u0003\u0003\u0003b\b\u0003\u0001\u0003\u0001\u0003\u0001"+
		"\u0003\u0001\u0003\u0001\u0003\u0003\u0003i\b\u0003\u0001\u0003\u0001"+
		"\u0003\u0001\u0003\u0001\u0003\u0001\u0003\u0005\u0003p\b\u0003\n\u0003"+
		"\f\u0003s\t\u0003\u0001\u0003\u0001\u0003\u0001\u0003\u0003\u0003x\b\u0003"+
		"\u0001\u0004\u0001\u0004\u0001\u0004\u0005\u0004}\b\u0004\n\u0004\f\u0004"+
		"\u0080\t\u0004\u0001\u0005\u0001\u0005\u0001\u0005\u0001\u0006\u0001\u0006"+
		"\u0001\u0006\u0001\u0006\u0005\u0006\u0089\b\u0006\n\u0006\f\u0006\u008c"+
		"\t\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0005"+
		"\u0006\u0093\b\u0006\n\u0006\f\u0006\u0096\t\u0006\u0003\u0006\u0098\b"+
		"\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0001\u0006\u0003"+
		"\u0006\u009f\b\u0006\u0003\u0006\u00a1\b\u0006\u0001\u0007\u0001\u0007"+
		"\u0001\u0007\u0001\u0007\u0001\u0007\u0001\u0007\u0001\u0007\u0001\u0007"+
		"\u0001\u0007\u0001\u0007\u0003\u0007\u00ad\b\u0007\u0001\b\u0001\b\u0001"+
		"\b\u0001\b\u0001\b\u0005\b\u00b4\b\b\n\b\f\b\u00b7\t\b\u0001\b\u0001\b"+
		"\u0001\b\u0001\b\u0001\b\u0001\b\u0005\b\u00bf\b\b\n\b\f\b\u00c2\t\b\u0001"+
		"\b\u0001\b\u0003\b\u00c6\b\b\u0001\t\u0001\t\u0003\t\u00ca\b\t\u0001\n"+
		"\u0001\n\u0005\n\u00ce\b\n\n\n\f\n\u00d1\t\n\u0001\n\u0001\n\u0001\u000b"+
		"\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b"+
		"\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0001\u000b\u0003\u000b"+
		"\u00e1\b\u000b\u0001\f\u0001\f\u0001\f\u0005\f\u00e6\b\f\n\f\f\f\u00e9"+
		"\t\f\u0001\f\u0001\f\u0001\f\u0001\f\u0005\f\u00ef\b\f\n\f\f\f\u00f2\t"+
		"\f\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0004\r\u00f9\b\r\u000b\r\f"+
		"\r\u00fa\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0004"+
		"\r\u0104\b\r\u000b\r\f\r\u0105\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r"+
		"\u0001\r\u0001\r\u0001\r\u0001\r\u0003\r\u0111\b\r\u0001\u000e\u0001\u000e"+
		"\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f"+
		"\u0003\u000f\u011b\b\u000f\u0003\u000f\u011d\b\u000f\u0001\u0010\u0001"+
		"\u0010\u0003\u0010\u0121\b\u0010\u0001\u0010\u0001\u0010\u0001\u0010\u0001"+
		"\u0010\u0001\u0010\u0001\u0010\u0001\u0010\u0003\u0010\u012a\b\u0010\u0001"+
		"\u0010\u0001\u0010\u0003\u0010\u012e\b\u0010\u0001\u0011\u0001\u0011\u0001"+
		"\u0011\u0001\u0011\u0005\u0011\u0134\b\u0011\n\u0011\f\u0011\u0137\t\u0011"+
		"\u0003\u0011\u0139\b\u0011\u0001\u0012\u0001\u0012\u0003\u0012\u013d\b"+
		"\u0012\u0001\u0012\u0001\u0012\u0005\u0012\u0141\b\u0012\n\u0012\f\u0012"+
		"\u0144\t\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0004\u0012"+
		"\u014a\b\u0012\u000b\u0012\f\u0012\u014b\u0003\u0012\u014e\b\u0012\u0003"+
		"\u0012\u0150\b\u0012\u0001\u0012\u0001\u0012\u0001\u0013\u0001\u0013\u0001"+
		"\u0013\u0001\u0013\u0005\u0013\u0158\b\u0013\n\u0013\f\u0013\u015b\t\u0013"+
		"\u0001\u0013\u0001\u0013\u0001\u0013\u0004\u0013\u0160\b\u0013\u000b\u0013"+
		"\f\u0013\u0161\u0003\u0013\u0164\b\u0013\u0001\u0014\u0001\u0014\u0001"+
		"\u0015\u0001\u0015\u0001\u0016\u0001\u0016\u0001\u0017\u0001\u0017\u0001"+
		"\u0017\u0005\u0017\u016f\b\u0017\n\u0017\f\u0017\u0172\t\u0017\u0001\u0018"+
		"\u0001\u0018\u0001\u0018\u0005\u0018\u0177\b\u0018\n\u0018\f\u0018\u017a"+
		"\t\u0018\u0001\u0019\u0001\u0019\u0001\u0019\u0005\u0019\u017f\b\u0019"+
		"\n\u0019\f\u0019\u0182\t\u0019\u0001\u001a\u0001\u001a\u0001\u001a\u0005"+
		"\u001a\u0187\b\u001a\n\u001a\f\u001a\u018a\t\u001a\u0001\u001b\u0001\u001b"+
		"\u0001\u001b\u0005\u001b\u018f\b\u001b\n\u001b\f\u001b\u0192\t\u001b\u0001"+
		"\u001c\u0001\u001c\u0001\u001c\u0005\u001c\u0197\b\u001c\n\u001c\f\u001c"+
		"\u019a\t\u001c\u0001\u001d\u0001\u001d\u0001\u001d\u0001\u001d\u0001\u001d"+
		"\u0001\u001d\u0001\u001d\u0003\u001d\u01a3\b\u001d\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0003\u001e\u01b4\b\u001e\u0001\u001e\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0001\u001e\u0003\u001e\u01bb\b\u001e\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e"+
		"\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0005\u001e"+
		"\u01ca\b\u001e\n\u001e\f\u001e\u01cd\t\u001e\u0003\u001e\u01cf\b\u001e"+
		"\u0001\u001e\u0001\u001e\u0001\u001e\u0001\u001e\u0005\u001e\u01d5\b\u001e"+
		"\n\u001e\f\u001e\u01d8\t\u001e\u0001\u001f\u0001\u001f\u0001\u001f\u0005"+
		"\u001f\u01dd\b\u001f\n\u001f\f\u001f\u01e0\t\u001f\u0001 \u0001 \u0001"+
		" \u0005 \u01e5\b \n \f \u01e8\t \u0001!\u0001!\u0001!\u0001!\u0001!\u0001"+
		"!\u0001!\u0003!\u01f1\b!\u0001\"\u0001\"\u0001\"\u0001\"\u0000\u0001<"+
		"#\u0000\u0002\u0004\u0006\b\n\f\u000e\u0010\u0012\u0014\u0016\u0018\u001a"+
		"\u001c\u001e \"$&(*,.02468:<>@BD\u0000\u0007\u0001\u000045\u0001\u0000"+
		"6:\u0001\u0000\u000f\u0010\u0001\u0000\u0011\u0014\u0001\u0000\u0015\u0016"+
		"\u0002\u0000\n\n\u0017\u0018\u0002\u0000\u0016\u0016\u0019\u0019\u022a"+
		"\u0000I\u0001\u0000\u0000\u0000\u0002Q\u0001\u0000\u0000\u0000\u0004S"+
		"\u0001\u0000\u0000\u0000\u0006w\u0001\u0000\u0000\u0000\by\u0001\u0000"+
		"\u0000\u0000\n\u0081\u0001\u0000\u0000\u0000\f\u00a0\u0001\u0000\u0000"+
		"\u0000\u000e\u00ac\u0001\u0000\u0000\u0000\u0010\u00c5\u0001\u0000\u0000"+
		"\u0000\u0012\u00c9\u0001\u0000\u0000\u0000\u0014\u00cb\u0001\u0000\u0000"+
		"\u0000\u0016\u00e0\u0001\u0000\u0000\u0000\u0018\u00e2\u0001\u0000\u0000"+
		"\u0000\u001a\u0110\u0001\u0000\u0000\u0000\u001c\u0112\u0001\u0000\u0000"+
		"\u0000\u001e\u0114\u0001\u0000\u0000\u0000 \u012d\u0001\u0000\u0000\u0000"+
		"\"\u012f\u0001\u0000\u0000\u0000$\u013a\u0001\u0000\u0000\u0000&\u0153"+
		"\u0001\u0000\u0000\u0000(\u0165\u0001\u0000\u0000\u0000*\u0167\u0001\u0000"+
		"\u0000\u0000,\u0169\u0001\u0000\u0000\u0000.\u016b\u0001\u0000\u0000\u0000"+
		"0\u0173\u0001\u0000\u0000\u00002\u017b\u0001\u0000\u0000\u00004\u0183"+
		"\u0001\u0000\u0000\u00006\u018b\u0001\u0000\u0000\u00008\u0193\u0001\u0000"+
		"\u0000\u0000:\u01a2\u0001\u0000\u0000\u0000<\u01ce\u0001\u0000\u0000\u0000"+
		">\u01d9\u0001\u0000\u0000\u0000@\u01e1\u0001\u0000\u0000\u0000B\u01f0"+
		"\u0001\u0000\u0000\u0000D\u01f2\u0001\u0000\u0000\u0000FH\u0003\u0002"+
		"\u0001\u0000GF\u0001\u0000\u0000\u0000HK\u0001\u0000\u0000\u0000IG\u0001"+
		"\u0000\u0000\u0000IJ\u0001\u0000\u0000\u0000JL\u0001\u0000\u0000\u0000"+
		"KI\u0001\u0000\u0000\u0000LM\u0005\u0000\u0000\u0001M\u0001\u0001\u0000"+
		"\u0000\u0000NR\u0003\u0006\u0003\u0000OR\u0003\f\u0006\u0000PR\u0003\u0004"+
		"\u0002\u0000QN\u0001\u0000\u0000\u0000QO\u0001\u0000\u0000\u0000QP\u0001"+
		"\u0000\u0000\u0000R\u0003\u0001\u0000\u0000\u0000ST\u0005\u001c\u0000"+
		"\u0000TU\u0005;\u0000\u0000UV\u0003B!\u0000VW\u0005\u0001\u0000\u0000"+
		"WX\u0003,\u0016\u0000X\u0005\u0001\u0000\u0000\u0000YZ\u0005\u001d\u0000"+
		"\u0000Z[\u0005;\u0000\u0000[]\u0005\u0002\u0000\u0000\\^\u0003\b\u0004"+
		"\u0000]\\\u0001\u0000\u0000\u0000]^\u0001\u0000\u0000\u0000^_\u0001\u0000"+
		"\u0000\u0000_a\u0005\u0003\u0000\u0000`b\u0003B!\u0000a`\u0001\u0000\u0000"+
		"\u0000ab\u0001\u0000\u0000\u0000bc\u0001\u0000\u0000\u0000cx\u0003\u0014"+
		"\n\u0000de\u0005\u001d\u0000\u0000ef\u0005;\u0000\u0000fh\u0005\u0002"+
		"\u0000\u0000gi\u0003\b\u0004\u0000hg\u0001\u0000\u0000\u0000hi\u0001\u0000"+
		"\u0000\u0000ij\u0001\u0000\u0000\u0000jk\u0005\u0003\u0000\u0000kl\u0005"+
		"\u0002\u0000\u0000lq\u0003B!\u0000mn\u0005\u0004\u0000\u0000np\u0003B"+
		"!\u0000om\u0001\u0000\u0000\u0000ps\u0001\u0000\u0000\u0000qo\u0001\u0000"+
		"\u0000\u0000qr\u0001\u0000\u0000\u0000rt\u0001\u0000\u0000\u0000sq\u0001"+
		"\u0000\u0000\u0000tu\u0005\u0003\u0000\u0000uv\u0003\u0014\n\u0000vx\u0001"+
		"\u0000\u0000\u0000wY\u0001\u0000\u0000\u0000wd\u0001\u0000\u0000\u0000"+
		"x\u0007\u0001\u0000\u0000\u0000y~\u0003\n\u0005\u0000z{\u0005\u0004\u0000"+
		"\u0000{}\u0003\n\u0005\u0000|z\u0001\u0000\u0000\u0000}\u0080\u0001\u0000"+
		"\u0000\u0000~|\u0001\u0000\u0000\u0000~\u007f\u0001\u0000\u0000\u0000"+
		"\u007f\t\u0001\u0000\u0000\u0000\u0080~\u0001\u0000\u0000\u0000\u0081"+
		"\u0082\u0005;\u0000\u0000\u0082\u0083\u0003B!\u0000\u0083\u000b\u0001"+
		"\u0000\u0000\u0000\u0084\u0085\u0005\u001e\u0000\u0000\u0085\u008a\u0005"+
		";\u0000\u0000\u0086\u0087\u0005\u0004\u0000\u0000\u0087\u0089\u0005;\u0000"+
		"\u0000\u0088\u0086\u0001\u0000\u0000\u0000\u0089\u008c\u0001\u0000\u0000"+
		"\u0000\u008a\u0088\u0001\u0000\u0000\u0000\u008a\u008b\u0001\u0000\u0000"+
		"\u0000\u008b\u008d\u0001\u0000\u0000\u0000\u008c\u008a\u0001\u0000\u0000"+
		"\u0000\u008d\u0097\u0003B!\u0000\u008e\u008f\u0005\u0001\u0000\u0000\u008f"+
		"\u0094\u0003,\u0016\u0000\u0090\u0091\u0005\u0004\u0000\u0000\u0091\u0093"+
		"\u0003,\u0016\u0000\u0092\u0090\u0001\u0000\u0000\u0000\u0093\u0096\u0001"+
		"\u0000\u0000\u0000\u0094\u0092\u0001\u0000\u0000\u0000\u0094\u0095\u0001"+
		"\u0000\u0000\u0000\u0095\u0098\u0001\u0000\u0000\u0000\u0096\u0094\u0001"+
		"\u0000\u0000\u0000\u0097\u008e\u0001\u0000\u0000\u0000\u0097\u0098\u0001"+
		"\u0000\u0000\u0000\u0098\u00a1\u0001\u0000\u0000\u0000\u0099\u009a\u0005"+
		"\u001e\u0000\u0000\u009a\u009b\u0005;\u0000\u0000\u009b\u009e\u0003\u000e"+
		"\u0007\u0000\u009c\u009d\u0005\u0001\u0000\u0000\u009d\u009f\u0003\u0010"+
		"\b\u0000\u009e\u009c\u0001\u0000\u0000\u0000\u009e\u009f\u0001\u0000\u0000"+
		"\u0000\u009f\u00a1\u0001\u0000\u0000\u0000\u00a0\u0084\u0001\u0000\u0000"+
		"\u0000\u00a0\u0099\u0001\u0000\u0000\u0000\u00a1\r\u0001\u0000\u0000\u0000"+
		"\u00a2\u00a3\u0005\u0005\u0000\u0000\u00a3\u00a4\u0003,\u0016\u0000\u00a4"+
		"\u00a5\u0005\u0006\u0000\u0000\u00a5\u00a6\u0003\u000e\u0007\u0000\u00a6"+
		"\u00ad\u0001\u0000\u0000\u0000\u00a7\u00a8\u0005\u0005\u0000\u0000\u00a8"+
		"\u00a9\u0003,\u0016\u0000\u00a9\u00aa\u0005\u0006\u0000\u0000\u00aa\u00ab"+
		"\u0003B!\u0000\u00ab\u00ad\u0001\u0000\u0000\u0000\u00ac\u00a2\u0001\u0000"+
		"\u0000\u0000\u00ac\u00a7\u0001\u0000\u0000\u0000\u00ad\u000f\u0001\u0000"+
		"\u0000\u0000\u00ae\u00af\u0003\u000e\u0007\u0000\u00af\u00b0\u0005\u0007"+
		"\u0000\u0000\u00b0\u00b5\u0003\u0012\t\u0000\u00b1\u00b2\u0005\u0004\u0000"+
		"\u0000\u00b2\u00b4\u0003\u0012\t\u0000\u00b3\u00b1\u0001\u0000\u0000\u0000"+
		"\u00b4\u00b7\u0001\u0000\u0000\u0000\u00b5\u00b3\u0001\u0000\u0000\u0000"+
		"\u00b5\u00b6\u0001\u0000\u0000\u0000\u00b6\u00b8\u0001\u0000\u0000\u0000"+
		"\u00b7\u00b5\u0001\u0000\u0000\u0000\u00b8\u00b9\u0005\b\u0000\u0000\u00b9"+
		"\u00c6\u0001\u0000\u0000\u0000\u00ba\u00bb\u0005\u0007\u0000\u0000\u00bb"+
		"\u00c0\u0003\u0012\t\u0000\u00bc\u00bd\u0005\u0004\u0000\u0000\u00bd\u00bf"+
		"\u0003\u0012\t\u0000\u00be\u00bc\u0001\u0000\u0000\u0000\u00bf\u00c2\u0001"+
		"\u0000\u0000\u0000\u00c0\u00be\u0001\u0000\u0000\u0000\u00c0\u00c1\u0001"+
		"\u0000\u0000\u0000\u00c1\u00c3\u0001\u0000\u0000\u0000\u00c2\u00c0\u0001"+
		"\u0000\u0000\u0000\u00c3\u00c4\u0005\b\u0000\u0000\u00c4\u00c6\u0001\u0000"+
		"\u0000\u0000\u00c5\u00ae\u0001\u0000\u0000\u0000\u00c5\u00ba\u0001\u0000"+
		"\u0000\u0000\u00c6\u0011\u0001\u0000\u0000\u0000\u00c7\u00ca\u0003\u0010"+
		"\b\u0000\u00c8\u00ca\u0003,\u0016\u0000\u00c9\u00c7\u0001\u0000\u0000"+
		"\u0000\u00c9\u00c8\u0001\u0000\u0000\u0000\u00ca\u0013\u0001\u0000\u0000"+
		"\u0000\u00cb\u00cf\u0005\u0007\u0000\u0000\u00cc\u00ce\u0003\u0016\u000b"+
		"\u0000\u00cd\u00cc\u0001\u0000\u0000\u0000\u00ce\u00d1\u0001\u0000\u0000"+
		"\u0000\u00cf\u00cd\u0001\u0000\u0000\u0000\u00cf\u00d0\u0001\u0000\u0000"+
		"\u0000\u00d0\u00d2\u0001\u0000\u0000\u0000\u00d1\u00cf\u0001\u0000\u0000"+
		"\u0000\u00d2\u00d3\u0005\b\u0000\u0000\u00d3\u0015\u0001\u0000\u0000\u0000"+
		"\u00d4\u00e1\u0003\f\u0006\u0000\u00d5\u00e1\u0003$\u0012\u0000\u00d6"+
		"\u00e1\u0003\u001c\u000e\u0000\u00d7\u00e1\u0003\u0018\f\u0000\u00d8\u00e1"+
		"\u0003\u001a\r\u0000\u00d9\u00e1\u0003\u001e\u000f\u0000\u00da\u00e1\u0003"+
		" \u0010\u0000\u00db\u00e1\u0003\"\u0011\u0000\u00dc\u00e1\u0003(\u0014"+
		"\u0000\u00dd\u00e1\u0003*\u0015\u0000\u00de\u00e1\u0003\u001c\u000e\u0000"+
		"\u00df\u00e1\u0003\u0014\n\u0000\u00e0\u00d4\u0001\u0000\u0000\u0000\u00e0"+
		"\u00d5\u0001\u0000\u0000\u0000\u00e0\u00d6\u0001\u0000\u0000\u0000\u00e0"+
		"\u00d7\u0001\u0000\u0000\u0000\u00e0\u00d8\u0001\u0000\u0000\u0000\u00e0"+
		"\u00d9\u0001\u0000\u0000\u0000\u00e0\u00da\u0001\u0000\u0000\u0000\u00e0"+
		"\u00db\u0001\u0000\u0000\u0000\u00e0\u00dc\u0001\u0000\u0000\u0000\u00e0"+
		"\u00dd\u0001\u0000\u0000\u0000\u00e0\u00de\u0001\u0000\u0000\u0000\u00e0"+
		"\u00df\u0001\u0000\u0000\u0000\u00e1\u0017\u0001\u0000\u0000\u0000\u00e2"+
		"\u00e7\u0005;\u0000\u0000\u00e3\u00e4\u0005\u0004\u0000\u0000\u00e4\u00e6"+
		"\u0005;\u0000\u0000\u00e5\u00e3\u0001\u0000\u0000\u0000\u00e6\u00e9\u0001"+
		"\u0000\u0000\u0000\u00e7\u00e5\u0001\u0000\u0000\u0000\u00e7\u00e8\u0001"+
		"\u0000\u0000\u0000\u00e8\u00ea\u0001\u0000\u0000\u0000\u00e9\u00e7\u0001"+
		"\u0000\u0000\u0000\u00ea\u00eb\u0005\t\u0000\u0000\u00eb\u00f0\u0003,"+
		"\u0016\u0000\u00ec\u00ed\u0005\u0004\u0000\u0000\u00ed\u00ef\u0003,\u0016"+
		"\u0000\u00ee\u00ec\u0001\u0000\u0000\u0000\u00ef\u00f2\u0001\u0000\u0000"+
		"\u0000\u00f0\u00ee\u0001\u0000\u0000\u0000\u00f0\u00f1\u0001\u0000\u0000"+
		"\u0000\u00f1\u0019\u0001\u0000\u0000\u0000\u00f2\u00f0\u0001\u0000\u0000"+
		"\u0000\u00f3\u00f8\u0005;\u0000\u0000\u00f4\u00f5\u0005\u0005\u0000\u0000"+
		"\u00f5\u00f6\u0003,\u0016\u0000\u00f6\u00f7\u0005\u0006\u0000\u0000\u00f7"+
		"\u00f9\u0001\u0000\u0000\u0000\u00f8\u00f4\u0001\u0000\u0000\u0000\u00f9"+
		"\u00fa\u0001\u0000\u0000\u0000\u00fa\u00f8\u0001\u0000\u0000\u0000\u00fa"+
		"\u00fb\u0001\u0000\u0000\u0000\u00fb\u00fc\u0001\u0000\u0000\u0000\u00fc"+
		"\u00fd\u0005\u0001\u0000\u0000\u00fd\u00fe\u0003,\u0016\u0000\u00fe\u0111"+
		"\u0001\u0000\u0000\u0000\u00ff\u0100\u0005;\u0000\u0000\u0100\u0101\u0005"+
		"\u0001\u0000\u0000\u0101\u0111\u0003,\u0016\u0000\u0102\u0104\u0005\n"+
		"\u0000\u0000\u0103\u0102\u0001\u0000\u0000\u0000\u0104\u0105\u0001\u0000"+
		"\u0000\u0000\u0105\u0103\u0001\u0000\u0000\u0000\u0105\u0106\u0001\u0000"+
		"\u0000\u0000\u0106\u0107\u0001\u0000\u0000\u0000\u0107\u0108\u0005;\u0000"+
		"\u0000\u0108\u0109\u0005\u0001\u0000\u0000\u0109\u0111\u0003,\u0016\u0000"+
		"\u010a\u010b\u0003<\u001e\u0000\u010b\u010c\u0007\u0000\u0000\u0000\u010c"+
		"\u0111\u0001\u0000\u0000\u0000\u010d\u010e\u0005;\u0000\u0000\u010e\u010f"+
		"\u0007\u0001\u0000\u0000\u010f\u0111\u0003,\u0016\u0000\u0110\u00f3\u0001"+
		"\u0000\u0000\u0000\u0110\u00ff\u0001\u0000\u0000\u0000\u0110\u0103\u0001"+
		"\u0000\u0000\u0000\u0110\u010a\u0001\u0000\u0000\u0000\u0110\u010d\u0001"+
		"\u0000\u0000\u0000\u0111\u001b\u0001\u0000\u0000\u0000\u0112\u0113\u0003"+
		",\u0016\u0000\u0113\u001d\u0001\u0000\u0000\u0000\u0114\u0115\u0005\""+
		"\u0000\u0000\u0115\u0116\u0003,\u0016\u0000\u0116\u011c\u0003\u0014\n"+
		"\u0000\u0117\u011a\u0005#\u0000\u0000\u0118\u011b\u0003\u001e\u000f\u0000"+
		"\u0119\u011b\u0003\u0014\n\u0000\u011a\u0118\u0001\u0000\u0000\u0000\u011a"+
		"\u0119\u0001\u0000\u0000\u0000\u011b\u011d\u0001\u0000\u0000\u0000\u011c"+
		"\u0117\u0001\u0000\u0000\u0000\u011c\u011d\u0001\u0000\u0000\u0000\u011d"+
		"\u001f\u0001\u0000\u0000\u0000\u011e\u0120\u0005$\u0000\u0000\u011f\u0121"+
		"\u0003,\u0016\u0000\u0120\u011f\u0001\u0000\u0000\u0000\u0120\u0121\u0001"+
		"\u0000\u0000\u0000\u0121\u0122\u0001\u0000\u0000\u0000\u0122\u012e\u0003"+
		"\u0014\n\u0000\u0123\u0124\u0005$\u0000\u0000\u0124\u0125\u0003\u0018"+
		"\f\u0000\u0125\u0126\u0005\u000b\u0000\u0000\u0126\u0127\u0003,\u0016"+
		"\u0000\u0127\u0129\u0005\u000b\u0000\u0000\u0128\u012a\u0003\u0016\u000b"+
		"\u0000\u0129\u0128\u0001\u0000\u0000\u0000\u0129\u012a\u0001\u0000\u0000"+
		"\u0000\u012a\u012b\u0001\u0000\u0000\u0000\u012b\u012c\u0003\u0014\n\u0000"+
		"\u012c\u012e\u0001\u0000\u0000\u0000\u012d\u011e\u0001\u0000\u0000\u0000"+
		"\u012d\u0123\u0001\u0000\u0000\u0000\u012e!\u0001\u0000\u0000\u0000\u012f"+
		"\u0138\u0005%\u0000\u0000\u0130\u0135\u0003,\u0016\u0000\u0131\u0132\u0005"+
		"\u0004\u0000\u0000\u0132\u0134\u0003,\u0016\u0000\u0133\u0131\u0001\u0000"+
		"\u0000\u0000\u0134\u0137\u0001\u0000\u0000\u0000\u0135\u0133\u0001\u0000"+
		"\u0000\u0000\u0135\u0136\u0001\u0000\u0000\u0000\u0136\u0139\u0001\u0000"+
		"\u0000\u0000\u0137\u0135\u0001\u0000\u0000\u0000\u0138\u0130\u0001\u0000"+
		"\u0000\u0000\u0138\u0139\u0001\u0000\u0000\u0000\u0139#\u0001\u0000\u0000"+
		"\u0000\u013a\u013c\u0005\u001f\u0000\u0000\u013b\u013d\u0003,\u0016\u0000"+
		"\u013c\u013b\u0001\u0000\u0000\u0000\u013c\u013d\u0001\u0000\u0000\u0000"+
		"\u013d\u013e\u0001\u0000\u0000\u0000\u013e\u0142\u0005\u0007\u0000\u0000"+
		"\u013f\u0141\u0003&\u0013\u0000\u0140\u013f\u0001\u0000\u0000\u0000\u0141"+
		"\u0144\u0001\u0000\u0000\u0000\u0142\u0140\u0001\u0000\u0000\u0000\u0142"+
		"\u0143\u0001\u0000\u0000\u0000\u0143\u014f\u0001\u0000\u0000\u0000\u0144"+
		"\u0142\u0001\u0000\u0000\u0000\u0145\u0146\u0005!\u0000\u0000\u0146\u014d"+
		"\u0005\f\u0000\u0000\u0147\u014e\u0003\u0014\n\u0000\u0148\u014a\u0003"+
		"\u0016\u000b\u0000\u0149\u0148\u0001\u0000\u0000\u0000\u014a\u014b\u0001"+
		"\u0000\u0000\u0000\u014b\u0149\u0001\u0000\u0000\u0000\u014b\u014c\u0001"+
		"\u0000\u0000\u0000\u014c\u014e\u0001\u0000\u0000\u0000\u014d\u0147\u0001"+
		"\u0000\u0000\u0000\u014d\u0149\u0001\u0000\u0000\u0000\u014e\u0150\u0001"+
		"\u0000\u0000\u0000\u014f\u0145\u0001\u0000\u0000\u0000\u014f\u0150\u0001"+
		"\u0000\u0000\u0000\u0150\u0151\u0001\u0000\u0000\u0000\u0151\u0152\u0005"+
		"\b\u0000\u0000\u0152%\u0001\u0000\u0000\u0000\u0153\u0154\u0005 \u0000"+
		"\u0000\u0154\u0159\u0003,\u0016\u0000\u0155\u0156\u0005\u0004\u0000\u0000"+
		"\u0156\u0158\u0003,\u0016\u0000\u0157\u0155\u0001\u0000\u0000\u0000\u0158"+
		"\u015b\u0001\u0000\u0000\u0000\u0159\u0157\u0001\u0000\u0000\u0000\u0159"+
		"\u015a\u0001\u0000\u0000\u0000\u015a\u015c\u0001\u0000\u0000\u0000\u015b"+
		"\u0159\u0001\u0000\u0000\u0000\u015c\u0163\u0005\f\u0000\u0000\u015d\u0164"+
		"\u0003\u0014\n\u0000\u015e\u0160\u0003\u0016\u000b\u0000\u015f\u015e\u0001"+
		"\u0000\u0000\u0000\u0160\u0161\u0001\u0000\u0000\u0000\u0161\u015f\u0001"+
		"\u0000\u0000\u0000\u0161\u0162\u0001\u0000\u0000\u0000\u0162\u0164\u0001"+
		"\u0000\u0000\u0000\u0163\u015d\u0001\u0000\u0000\u0000\u0163\u015f\u0001"+
		"\u0000\u0000\u0000\u0164\'\u0001\u0000\u0000\u0000\u0165\u0166\u0005&"+
		"\u0000\u0000\u0166)\u0001\u0000\u0000\u0000\u0167\u0168\u0005\'\u0000"+
		"\u0000\u0168+\u0001\u0000\u0000\u0000\u0169\u016a\u0003.\u0017\u0000\u016a"+
		"-\u0001\u0000\u0000\u0000\u016b\u0170\u00030\u0018\u0000\u016c\u016d\u0005"+
		"\r\u0000\u0000\u016d\u016f\u00030\u0018\u0000\u016e\u016c\u0001\u0000"+
		"\u0000\u0000\u016f\u0172\u0001\u0000\u0000\u0000\u0170\u016e\u0001\u0000"+
		"\u0000\u0000\u0170\u0171\u0001\u0000\u0000\u0000\u0171/\u0001\u0000\u0000"+
		"\u0000\u0172\u0170\u0001\u0000\u0000\u0000\u0173\u0178\u00032\u0019\u0000"+
		"\u0174\u0175\u0005\u000e\u0000\u0000\u0175\u0177\u00032\u0019\u0000\u0176"+
		"\u0174\u0001\u0000\u0000\u0000\u0177\u017a\u0001\u0000\u0000\u0000\u0178"+
		"\u0176\u0001\u0000\u0000\u0000\u0178\u0179\u0001\u0000\u0000\u0000\u0179"+
		"1\u0001\u0000\u0000\u0000\u017a\u0178\u0001\u0000\u0000\u0000\u017b\u0180"+
		"\u00034\u001a\u0000\u017c\u017d\u0007\u0002\u0000\u0000\u017d\u017f\u0003"+
		"4\u001a\u0000\u017e\u017c\u0001\u0000\u0000\u0000\u017f\u0182\u0001\u0000"+
		"\u0000\u0000\u0180\u017e\u0001\u0000\u0000\u0000\u0180\u0181\u0001\u0000"+
		"\u0000\u0000\u01813\u0001\u0000\u0000\u0000\u0182\u0180\u0001\u0000\u0000"+
		"\u0000\u0183\u0188\u00036\u001b\u0000\u0184\u0185\u0007\u0003\u0000\u0000"+
		"\u0185\u0187\u00036\u001b\u0000\u0186\u0184\u0001\u0000\u0000\u0000\u0187"+
		"\u018a\u0001\u0000\u0000\u0000\u0188\u0186\u0001\u0000\u0000\u0000\u0188"+
		"\u0189\u0001\u0000\u0000\u0000\u01895\u0001\u0000\u0000\u0000\u018a\u0188"+
		"\u0001\u0000\u0000\u0000\u018b\u0190\u00038\u001c\u0000\u018c\u018d\u0007"+
		"\u0004\u0000\u0000\u018d\u018f\u00038\u001c\u0000\u018e\u018c\u0001\u0000"+
		"\u0000\u0000\u018f\u0192\u0001\u0000\u0000\u0000\u0190\u018e\u0001\u0000"+
		"\u0000\u0000\u0190\u0191\u0001\u0000\u0000\u0000\u01917\u0001\u0000\u0000"+
		"\u0000\u0192\u0190\u0001\u0000\u0000\u0000\u0193\u0198\u0003:\u001d\u0000"+
		"\u0194\u0195\u0007\u0005\u0000\u0000\u0195\u0197\u0003:\u001d\u0000\u0196"+
		"\u0194\u0001\u0000\u0000\u0000\u0197\u019a\u0001\u0000\u0000\u0000\u0198"+
		"\u0196\u0001\u0000\u0000\u0000\u0198\u0199\u0001\u0000\u0000\u0000\u0199"+
		"9\u0001\u0000\u0000\u0000\u019a\u0198\u0001\u0000\u0000\u0000\u019b\u019c"+
		"\u0007\u0006\u0000\u0000\u019c\u01a3\u0003:\u001d\u0000\u019d\u019e\u0005"+
		"\u001a\u0000\u0000\u019e\u01a3\u0003:\u001d\u0000\u019f\u01a0\u0005\n"+
		"\u0000\u0000\u01a0\u01a3\u0003:\u001d\u0000\u01a1\u01a3\u0003<\u001e\u0000"+
		"\u01a2\u019b\u0001\u0000\u0000\u0000\u01a2\u019d\u0001\u0000\u0000\u0000"+
		"\u01a2\u019f\u0001\u0000\u0000\u0000\u01a2\u01a1\u0001\u0000\u0000\u0000"+
		"\u01a3;\u0001\u0000\u0000\u0000\u01a4\u01a5\u0006\u001e\uffff\uffff\u0000"+
		"\u01a5\u01cf\u00050\u0000\u0000\u01a6\u01cf\u00051\u0000\u0000\u01a7\u01cf"+
		"\u00052\u0000\u0000\u01a8\u01cf\u00053\u0000\u0000\u01a9\u01cf\u0005("+
		"\u0000\u0000\u01aa\u01cf\u0005)\u0000\u0000\u01ab\u01ac\u0005*\u0000\u0000"+
		"\u01ac\u01ad\u0005\u0002\u0000\u0000\u01ad\u01ae\u0003,\u0016\u0000\u01ae"+
		"\u01af\u0005\u0003\u0000\u0000\u01af\u01cf\u0001\u0000\u0000\u0000\u01b0"+
		"\u01b1\u0003>\u001f\u0000\u01b1\u01b3\u0005\u0002\u0000\u0000\u01b2\u01b4"+
		"\u0003@ \u0000\u01b3\u01b2\u0001\u0000\u0000\u0000\u01b3\u01b4\u0001\u0000"+
		"\u0000\u0000\u01b4\u01b5\u0001\u0000\u0000\u0000\u01b5\u01b6\u0005\u0003"+
		"\u0000\u0000\u01b6\u01cf\u0001\u0000\u0000\u0000\u01b7\u01b8\u0003B!\u0000"+
		"\u01b8\u01ba\u0005\u0002\u0000\u0000\u01b9\u01bb\u0003@ \u0000\u01ba\u01b9"+
		"\u0001\u0000\u0000\u0000\u01ba\u01bb\u0001\u0000\u0000\u0000\u01bb\u01bc"+
		"\u0001\u0000\u0000\u0000\u01bc\u01bd\u0005\u0003\u0000\u0000\u01bd\u01cf"+
		"\u0001\u0000\u0000\u0000\u01be\u01cf\u0003\u0010\b\u0000\u01bf\u01cf\u0003"+
		">\u001f\u0000\u01c0\u01c1\u0005\u0002\u0000\u0000\u01c1\u01c2\u0003,\u0016"+
		"\u0000\u01c2\u01c3\u0005\u0003\u0000\u0000\u01c3\u01cf\u0001\u0000\u0000"+
		"\u0000\u01c4\u01cb\u0003>\u001f\u0000\u01c5\u01c6\u0005\u0005\u0000\u0000"+
		"\u01c6\u01c7\u0003,\u0016\u0000\u01c7\u01c8\u0005\u0006\u0000\u0000\u01c8"+
		"\u01ca\u0001\u0000\u0000\u0000\u01c9\u01c5\u0001\u0000\u0000\u0000\u01ca"+
		"\u01cd\u0001\u0000\u0000\u0000\u01cb\u01c9\u0001\u0000\u0000\u0000\u01cb"+
		"\u01cc\u0001\u0000\u0000\u0000\u01cc\u01cf\u0001\u0000\u0000\u0000\u01cd"+
		"\u01cb\u0001\u0000\u0000\u0000\u01ce\u01a4\u0001\u0000\u0000\u0000\u01ce"+
		"\u01a6\u0001\u0000\u0000\u0000\u01ce\u01a7\u0001\u0000\u0000\u0000\u01ce"+
		"\u01a8\u0001\u0000\u0000\u0000\u01ce\u01a9\u0001\u0000\u0000\u0000\u01ce"+
		"\u01aa\u0001\u0000\u0000\u0000\u01ce\u01ab\u0001\u0000\u0000\u0000\u01ce"+
		"\u01b0\u0001\u0000\u0000\u0000\u01ce\u01b7\u0001\u0000\u0000\u0000\u01ce"+
		"\u01be\u0001\u0000\u0000\u0000\u01ce\u01bf\u0001\u0000\u0000\u0000\u01ce"+
		"\u01c0\u0001\u0000\u0000\u0000\u01ce\u01c4\u0001\u0000\u0000\u0000\u01cf"+
		"\u01d6\u0001\u0000\u0000\u0000\u01d0\u01d1\n\u0002\u0000\u0000\u01d1\u01d5"+
		"\u00054\u0000\u0000\u01d2\u01d3\n\u0001\u0000\u0000\u01d3\u01d5\u0005"+
		"5\u0000\u0000\u01d4\u01d0\u0001\u0000\u0000\u0000\u01d4\u01d2\u0001\u0000"+
		"\u0000\u0000\u01d5\u01d8\u0001\u0000\u0000\u0000\u01d6\u01d4\u0001\u0000"+
		"\u0000\u0000\u01d6\u01d7\u0001\u0000\u0000\u0000\u01d7=\u0001\u0000\u0000"+
		"\u0000\u01d8\u01d6\u0001\u0000\u0000\u0000\u01d9\u01de\u0005;\u0000\u0000"+
		"\u01da\u01db\u0005\u001b\u0000\u0000\u01db\u01dd\u0005;\u0000\u0000\u01dc"+
		"\u01da\u0001\u0000\u0000\u0000\u01dd\u01e0\u0001\u0000\u0000\u0000\u01de"+
		"\u01dc\u0001\u0000\u0000\u0000\u01de\u01df\u0001\u0000\u0000\u0000\u01df"+
		"?\u0001\u0000\u0000\u0000\u01e0\u01de\u0001\u0000\u0000\u0000\u01e1\u01e6"+
		"\u0003,\u0016\u0000\u01e2\u01e3\u0005\u0004\u0000\u0000\u01e3\u01e5\u0003"+
		",\u0016\u0000\u01e4\u01e2\u0001\u0000\u0000\u0000\u01e5\u01e8\u0001\u0000"+
		"\u0000\u0000\u01e6\u01e4\u0001\u0000\u0000\u0000\u01e6\u01e7\u0001\u0000"+
		"\u0000\u0000\u01e7A\u0001\u0000\u0000\u0000\u01e8\u01e6\u0001\u0000\u0000"+
		"\u0000\u01e9\u01f1\u0005+\u0000\u0000\u01ea\u01f1\u0005,\u0000\u0000\u01eb"+
		"\u01f1\u0005-\u0000\u0000\u01ec\u01f1\u0005.\u0000\u0000\u01ed\u01f1\u0005"+
		"/\u0000\u0000\u01ee\u01f1\u0003D\"\u0000\u01ef\u01f1\u0003\u000e\u0007"+
		"\u0000\u01f0\u01e9\u0001\u0000\u0000\u0000\u01f0\u01ea\u0001\u0000\u0000"+
		"\u0000\u01f0\u01eb\u0001\u0000\u0000\u0000\u01f0\u01ec\u0001\u0000\u0000"+
		"\u0000\u01f0\u01ed\u0001\u0000\u0000\u0000\u01f0\u01ee\u0001\u0000\u0000"+
		"\u0000\u01f0\u01ef\u0001\u0000\u0000\u0000\u01f1C\u0001\u0000\u0000\u0000"+
		"\u01f2\u01f3\u0005\n\u0000\u0000\u01f3\u01f4\u0003B!\u0000\u01f4E\u0001"+
		"\u0000\u0000\u00008IQ]ahqw~\u008a\u0094\u0097\u009e\u00a0\u00ac\u00b5"+
		"\u00c0\u00c5\u00c9\u00cf\u00e0\u00e7\u00f0\u00fa\u0105\u0110\u011a\u011c"+
		"\u0120\u0129\u012d\u0135\u0138\u013c\u0142\u014b\u014d\u014f\u0159\u0161"+
		"\u0163\u0170\u0178\u0180\u0188\u0190\u0198\u01a2\u01b3\u01ba\u01cb\u01ce"+
		"\u01d4\u01d6\u01de\u01e6\u01f0";
	public static final ATN _ATN =
		new ATNDeserializer().deserialize(_serializedATN.toCharArray());
	static {
		_decisionToDFA = new DFA[_ATN.getNumberOfDecisions()];
		for (int i = 0; i < _ATN.getNumberOfDecisions(); i++) {
			_decisionToDFA[i] = new DFA(_ATN.getDecisionState(i), i);
		}
	}
}