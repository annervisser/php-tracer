<?php

declare(strict_types=1);

namespace Anner\PhpTracer;

use Anner\PhpTracer\Trace\Trace;

use function array_slice;
use function debug_backtrace;
use function error_log;

class PhpTracer
{
    public static function mark(string $message): void
    {
        // get backtrace, and cut off ourself
        $backtrace = array_slice(debug_backtrace(0), 1);
        $trace     = new Trace($backtrace);
        error_log($trace->toString());
    }
}
