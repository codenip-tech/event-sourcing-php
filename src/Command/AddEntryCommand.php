<?php

declare(strict_types=1);

namespace App\Command;

readonly class AddEntryCommand
{
    public function __construct(
        public string $accountId,
        public int $amout,
    ) {}
}
