<?php

namespace BudgetTool\BudgetContext\Tests\Unit\UseCases\AddBudget;

use BudgetTool\BudgetContext\Infrastructure\MemoryBudgetRepository;
use BudgetTool\BudgetContext\UseCases\AddBudget\AddBudgetRequest;
use BudgetTool\BudgetContext\UseCases\AddBudget\AddBudgetUseCase;
use PHPUnit\Framework\TestCase;

class AddBudgetUseCaseTest extends TestCase
{
    public function testAddBudget()
    {
        $budgetRepo = $this->createMock(MemoryBudgetRepository::class);
        $budgetRepo->expects($this->once())
            ->method('save');

        $useCase = new AddBudgetUseCase($budgetRepo);
        $useCase->addBudget(new AddBudgetRequest('Budget for january 2017', new \DateTime('now'), new \DateTime('tomorrow')));
    }
}