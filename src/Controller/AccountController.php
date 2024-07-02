<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\AddEntryCommand;
use App\Projection\AccountProjectionBuilder;
use App\Service\AccountService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

use function sprintf;

class AccountController extends AbstractController
{
    public function __construct(
        private readonly AccountService $accountService,
        private readonly MessageBusInterface $bus,
        private readonly AccountProjectionBuilder $accountProjectionBuilder,
    ) {}

    #[Route(
        '/account/create/{iban}',
        'create_account',
        methods: ['GET'],
    )]
    public function createAccount(string $iban): Response
    {
        $accountId = $this->accountService->create($iban);

        return $this->json(['accountId' => $accountId], Response::HTTP_CREATED);
    }

    #[Route(
        '/account/{accountId}/add-entry/{amount}',
        'add_entry_to_account',
        methods: ['GET'],
    )]
    public function addEntry(string $accountId, int $amount): Response
    {
        $command = new AddEntryCommand($accountId, $amount);

        $this->bus->dispatch($command);

        return $this->json([sprintf('Entry added for account <%s> with amount <%s>', $accountId, $amount)]);
    }

    #[Route(
        '/account/{accountId}/balance',
        'get_account_balance',
        methods: ['GET'],
    )]
    public function getBalanceForAccount(string $accountId): Response
    {
        $accountProjection = $this->accountProjectionBuilder->rebuildProjectionForAccount($accountId);

        return $this->json(['balance' => $accountProjection->getBalance()]);
    }
}
