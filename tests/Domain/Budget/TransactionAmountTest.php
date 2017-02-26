<?php

namespace Tests\Domain\Budget;

use Domain\Budget\TransactionAmount;
use PHPUnit\Framework\TestCase;

class TransactionAmountTest extends TestCase
{
    public function testAmount()
    {
        $amount = new TransactionAmount(12.95);
        $this->assertEquals(12.95, $amount->getAmount());
    }

}