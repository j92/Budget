<?php

namespace BudgetTool\BudgetContext\Tests\Unit\Infrastructure;

use BudgetTool\BudgetContext\Domain\Model\Budget;
use BudgetTool\BudgetContext\Domain\Model\BudgetPeriod;
use BudgetTool\BudgetContext\Infrastructure\MemoryBudgetRepository;
use PHPUnit\Framework\TestCase;

class MemoryBudgetRepositoryTest extends TestCase
{
    public function testSave()
    {
        $budget = new Budget('title', new BudgetPeriod(new \DateTime('now'), new \DateTime('tomorrow')));
        $repository = new MemoryBudgetRepository();
        $repository->save($budget);

        $this->assertCount(1, $repository->items);
    }
}