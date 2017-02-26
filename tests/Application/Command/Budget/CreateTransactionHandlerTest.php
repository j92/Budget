<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\AddTransactionCommand;
use Application\Command\Budget\Handler\CreateTransactionHandler;
use Domain\Budget\TransactionAmount;
use Domain\Budget\TransactionDate;
use Infrastructure\Persistence\MemoryTransactionRepository;
use PHPUnit\Framework\TestCase;

class CreateTransactionHandlerTest extends TestCase
{
    public function testHandle()
    {
        $command = new AddTransactionCommand(new TransactionAmount(12.95), new TransactionDate(new \DateTime()));
        $transactionRepository = new MemoryTransactionRepository();
        $commandHandler = new CreateTransactionHandler($transactionRepository);

        $commandHandler->handle($command);

        $this->assertCount(1, $transactionRepository->transactions);
    }
}
