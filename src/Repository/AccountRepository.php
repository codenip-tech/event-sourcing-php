<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;

class AccountRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function save(Account $account): void
    {
        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }

    public function byId(string $id): ?Account
    {
        return $this->entityManager->getRepository(Account::class)->find($id);
    }
}
