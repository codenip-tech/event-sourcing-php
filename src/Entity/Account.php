<?php

declare(strict_types=1);

namespace App\Entity;

class Account
{
    public function __construct(
        private readonly string $id,
        private readonly string $iban,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getIban(): string
    {
        return $this->iban;
    }
}
