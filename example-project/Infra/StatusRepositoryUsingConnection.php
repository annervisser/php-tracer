<?php

declare(strict_types=1);

namespace Anner\ExampleProject\Infra;

use Anner\ExampleProject\Domain\StatusRepository;
use Anner\ExampleProject\Lib\Connection;

class StatusRepositoryUsingConnection implements StatusRepository
{
    public function __construct(
        private readonly Connection $connection,
    ) {
    }

    public function getStatus(): string
    {
        $this->connection->query('SELECT STATUS');

        return 'status';
    }
}
