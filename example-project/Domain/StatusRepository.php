<?php

declare(strict_types=1);

namespace Anner\ExampleProject\Domain;

interface StatusRepository
{
    public function getStatus(): string;
}
