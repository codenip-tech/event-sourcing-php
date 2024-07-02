<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

class Entry
{
    private readonly DateTimeImmutable $occurredOn;

    public function __construct(
        private readonly string $id,
        private readonly Account $account,
        private readonly int $amount,
    ) {
        $this->occurredOn = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
