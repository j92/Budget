<?php

namespace Application\Command\Budget\Handler;

use Application\Command\Budget\AddTransactionCommand;
use Application\Command\Command;
use Application\Command\CommandHandler;
use Domain\Budget\Transaction;
use Domain\Budget\TransactionRepository;

class AddTransactionHandler implements CommandHandler
{
    /** @var TransactionRepository */
    private $transactionRepository;

    /**
     * CreateTransactionHandler constructor.
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function handle(Command $command)
    {
        if (!$command instanceof AddTransactionCommand) {
            throw new \InvalidArgumentException('CreateTransactionHandler can only handle AddTransactionCommand');
        }

        $transaction = new Transaction(uniqid(), $command->getAmount(), $command->getTransactionDate());

        $this->transactionRepository->save($transaction);
    }

}