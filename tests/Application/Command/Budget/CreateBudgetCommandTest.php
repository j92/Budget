<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\CreateBudgetCommand;
use Domain\Budget\BudgetPeriod;
use PHPUnit\Framework\TestCase;

class CreateBudgetCommandTest extends TestCase
{
    public function testGetters()
    {
        $title = 'title';
        $period = new BudgetPeriod(new \DateTime('now'), new \DateTime('tomorrow'));

        $command = new CreateBudgetCommand($title, $period);

        $this->assertEquals($title, $command->getTitle());
        $this->assertEquals($period, $command->getPeriod());
    }
}
