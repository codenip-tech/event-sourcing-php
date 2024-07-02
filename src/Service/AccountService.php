<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Symfony\Component\Uid\Uuid;

class AccountService
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
    ) {}

    public function create(string $iban): string
    {
        $account = new Account(Uuid::v7()->toRfc4122(), $iban);

        $this->accountRepository->save($account);

        return $account->getId();
    }
}
