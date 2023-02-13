<?php

declare(strict_types=1);

namespace Anner\PhpTracer\Trace;

use function array_map;
use function implode;
use function json_encode;

use const JSON_THROW_ON_ERROR;

final readonly class TraceEntry
{
    /** @param list<scalar | null> $args */
    public function __construct(
        public string $file,
        public int $line,
        public string $function,
        public array $args,
        public string|null $class = null,
        public string|null $type = null,
    ) {
    }

    public function toString(): string
    {
        if ($this->class) {
            return $this->getFunctionCallString();
        }

        return $this->getFunctionCallString() . "\t" . $this->getFileString();
    }

    public function getFunctionCallString(): string
    {
        $string = '';
        if ($this->class) {
            $string .= $this->class . ($this->type ?? '::');
        }

        $string .= $this->function . '(' . $this->getArgumentsString() . ')';

        return $string;
    }

    public function getArgumentsString(): string
    {
        $args = array_map(
            static fn (mixed $arg) => json_encode($arg, JSON_THROW_ON_ERROR),
            $this->args,
        );

        return implode(', ', $args);
    }

    public function getFileString(): string
    {
        return $this->file . ':' . $this->line;
    }

    /**
     * @param array<string, mixed> $data
     * @psalm-param array{file: string, line: int, function: string, args: list<scalar | null>, class?: string, type?: string} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            file: $data['file'],
            line: $data['line'],
            function: $data['function'],
            args: $data['args'],
            class: $data['class'] ?? null,
            type: $data['type'] ?? null,
        );
    }
}
