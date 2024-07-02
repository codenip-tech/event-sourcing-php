<?php

declare(strict_types=1);

namespace App\Projection;

class AccountProjection
{
    public function __construct(
        private readonly string $accountId,
        private int $balance = 0,
    ) {}

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }
}
