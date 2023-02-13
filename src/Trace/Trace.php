<?php

declare(strict_types=1);

namespace Anner\PhpTracer\Trace;

use function array_map;
use function implode;

use const PHP_EOL;

readonly class Trace
{
    /** @var list<TraceEntry> */
    private array $entries;

    /** @psalm-param list<array<string, mixed>> $backtrace */
    public function __construct(array $backtrace)
    {
        /**
         * @psalm-suppress ArgumentTypeCoercion
         * @TODO use valinor
         */
        $this->entries = array_map(
            TraceEntry::fromArray(...),
            $backtrace,
        );
    }

    public function toString(): string
    {
        return implode(
            PHP_EOL,
            array_map(static fn (TraceEntry $entry) => $entry->toString(), $this->entries),
        );
    }
}
