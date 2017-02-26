<?php

namespace Tests\Domain\Budget;

use Domain\Budget\TransactionDate;
use PHPUnit\Framework\TestCase;

class TransactionDateTest extends TestCase
{
    public function testDate()
    {
        $date = new \DateTime();
        $transactionDate = new TransactionDate($date);

        $this->assertEquals($date, $transactionDate->getDate());
    }
}
