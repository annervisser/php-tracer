<?php

declare(strict_types=1);

namespace Anner\ExampleProject\Lib;

use Anner\PhpTracer\PhpTracer;

class Connection
{
    public function query(string $query): void
    {
        PhpTracer::mark($query);
    }
}
