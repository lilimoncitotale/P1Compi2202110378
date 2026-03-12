<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/generated/GolampiLexer.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

if ($argc < 2) {
    echo "Usage: php dump_tokens.php <file>\n";
    exit(1);
}

$file = $argv[1];
if (!file_exists($file)) {
    echo "File not found: $file\n";
    exit(1);
}

$input = file_get_contents($file);
$stream = InputStream::fromString($input);
$lexer = new GolampiLexer($stream);
$tokens = new CommonTokenStream($lexer);
$tokens->fill();
$all = $tokens->getAllTokens();

foreach ($all as $i => $t) {
    printf("%04d: text='%s' type=%d line=%d pos=%d\n", $i, addslashes($t->getText()), $t->getType(), $t->getLine(), $t->getCharPositionInLine());
}

echo "Total tokens: " . count($all) . "\n";
