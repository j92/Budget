<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\CreateTransactionCommand;
use Domain\Budget\TransactionAmount;
use Domain\Budget\TransactionDate;
use PHPUnit\Framework\TestCase;

class CreateTransactionCommandTest extends TestCase
{
    public function testCommand()
    {
        $amount = new TransactionAmount(12.95);
        $date = new TransactionDate(new \DateTime());

        $command = new CreateTransactionCommand($amount, $date);

        $this->assertEquals($amount, $command->getAmount());
        $this->assertEquals($date, $command->getTransactionDate());
    }
}
