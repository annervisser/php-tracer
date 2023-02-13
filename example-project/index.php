<?php

declare(strict_types=1);

use Anner\ExampleProject\App\StatusPort;
use Anner\ExampleProject\Infra\StatusAdapter;
use Anner\ExampleProject\Infra\StatusRepositoryUsingConnection;
use Anner\ExampleProject\Lib\Connection;

require_once __DIR__ . '/../vendor/autoload.php';

function run(): void
{
    $connection       = new Connection();
    $statusRepository = new StatusRepositoryUsingConnection($connection);
    $port             = new StatusPort($statusRepository);
    $adapter          = new StatusAdapter($port);
    $inline           = static fn (): null => ($adapter)();
    ($inline)();
}

run();
