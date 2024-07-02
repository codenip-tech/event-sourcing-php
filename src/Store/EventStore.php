<?php

declare(strict_types=1);

namespace App\Store;

use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;

class EventStore
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function append(Entry $entry): void
    {
        $this->entityManager->persist($entry);
        $this->entityManager->flush();
    }

    /**
     * @return array<int, Entry>
     */
    public function getEntriesForAccount(string $accountId): array
    {
        return $this->entityManager
            ->getRepository(Entry::class)
            ->findBy(
                [
                    'account' => $accountId,
                ],
                [
                    'occurredOn' => 'ASC',
                ],
            );
    }
}
