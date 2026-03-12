<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;

class SyntaxErrorListener extends BaseErrorListener {
    private $errors = [];

    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception,
    ): void {
        $text = null;
        try {
            if (is_object($offendingSymbol) && method_exists($offendingSymbol, 'getText')) {
                $text = $offendingSymbol->getText();
            } elseif (is_object($offendingSymbol) && property_exists($offendingSymbol, 'text')) {
                $text = $offendingSymbol->text;
            }
        } catch (Exception $e) {
            $text = null;
        }

        $this->errors[] = [
            'line' => $line,
            'column' => $charPositionInLine,
            'message' => $msg,
            'offending' => $text,
        ];
    }

    public function hasErrors(): bool {
        return count($this->errors) > 0;
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
