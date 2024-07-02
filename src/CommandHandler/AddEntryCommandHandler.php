<?php

declare(strict_types=1);

namespace App\CommandHandler;

use App\Command\AddEntryCommand;
use App\Entity\Entry;
use App\Repository\AccountRepository;
use App\Store\EventStore;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class AddEntryCommandHandler
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly EventStore $eventStore,
    ) {}

    public function __invoke(AddEntryCommand $command): void
    {
        $account = $this->accountRepository->byId($command->accountId);

        $entry = new Entry(Uuid::v7()->toRfc4122(), $account, $command->amout);

        $this->eventStore->append($entry);
    }
}
