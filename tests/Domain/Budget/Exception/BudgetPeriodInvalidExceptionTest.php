<?php

namespace Tests\Domain\Budget;

use Domain\Budget\Exception\BudgetPeriodInvalidException;
use PHPUnit\Framework\TestCase;

class BudgetPeriodInvalidExceptionTest extends TestCase
{
    public function testStartBeforeEnd()
    {
        $exception = BudgetPeriodInvalidException::startBeforeEnd();

        $this->assertEquals('The start date must appear before the end date', $exception->getMessage());
    }
}