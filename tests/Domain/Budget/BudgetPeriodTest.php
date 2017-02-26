<?php

namespace Tests\Domain\Budget;

use Domain\Budget\BudgetPeriod;
use Domain\Budget\Exception\BudgetPeriodInvalidException;
use PHPUnit\Framework\TestCase;

class BudgetPeriodTest extends TestCase
{
    public function testStartMustAppearBeforeEnd()
    {
        $this->expectException(BudgetPeriodInvalidException::class);

        new BudgetPeriod(new \DateTime('tomorrow'), new \DateTime('now'));
        $this->fail('Start must appear before the end');
    }
}