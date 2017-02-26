<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\CreateBudgetCommand;
use Application\Command\Budget\Handler\CreateBudgetHandler;
use Infrastructure\Persistence\MemoryBudgetRepository;
use PHPUnit\Framework\TestCase;

class CreateBudgetHandlerTest extends TestCase
{
    public function testHandle()
    {
        $budgetRepository = new MemoryBudgetRepository();

        $handler = new CreateBudgetHandler($budgetRepository);
        $command = new CreateBudgetCommand('title', new \DatePeriod(new \DateTime(), new \DateInterval('P1D'), new \DateTime()));
        $handler->handle($command);

        $this->assertCount(1, $budgetRepository->items);
    }
}
