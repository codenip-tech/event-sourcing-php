<?php

declare(strict_types=1);

namespace App\Projection;

use App\Store\EventStore;

class AccountProjectionBuilder
{
    public function __construct(
        private readonly EventStore $eventStore,
    ) {}

    public function rebuildProjectionForAccount(string $accountId): AccountProjection
    {
        $entries = $this->eventStore->getEntriesForAccount($accountId);

        $accountProjection = new AccountProjection($accountId);

        foreach ($entries as $entry) {
            $accountProjection->setBalance($accountProjection->getBalance() + $entry->getAmount());
        }

        return $accountProjection;
    }
}
