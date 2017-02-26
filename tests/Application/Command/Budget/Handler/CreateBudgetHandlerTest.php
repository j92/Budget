<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\CreateBudgetCommand;
use Application\Command\Budget\Handler\CreateBudgetHandler;
use Domain\Budget\BudgetPeriod;
use Infrastructure\Persistence\MemoryBudgetRepository;
use PHPUnit\Framework\TestCase;

class CreateBudgetHandlerTest extends TestCase
{
    public function testHandle()
    {
        $budgetRepository = new MemoryBudgetRepository();

        $handler = new CreateBudgetHandler($budgetRepository);
        $period = new BudgetPeriod(new \DateTime('now'), new \DateTime('tomorrow'));
        $command = new CreateBudgetCommand('title', $period);
        $handler->handle($command);

        $this->assertCount(1, $budgetRepository->items);
    }

}
