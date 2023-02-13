<?php

declare(strict_types=1);

namespace Anner\ExampleProject\Infra;

use Anner\ExampleProject\App\StatusPort;

class StatusAdapter
{
    public function __construct(
        private readonly StatusPort $statusPort,
    ) {
    }

    public function __invoke(): void
    {
        ($this->statusPort)(123);
    }
}
