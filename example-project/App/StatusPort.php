<?php

declare(strict_types=1);

namespace Anner\ExampleProject\App;

use Anner\ExampleProject\Domain\StatusRepository;

readonly class StatusPort
{
    public function __construct(
        private StatusRepository $statusRepository,
    ) {
    }

    public function __invoke(int $number): string
    {
        $this->statusRepository->getStatus();

        return 'all good';
    }
}
