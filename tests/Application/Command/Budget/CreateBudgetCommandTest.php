<?php

namespace Tests\Application\Command\Budget;

use Application\Command\Budget\CreateBudgetCommand;
use PHPUnit\Framework\TestCase;

class CreateBudgetCommandTest extends TestCase
{
    public function testGetters()
    {
        $title = 'title';
        $period = new \DatePeriod(new \DateTime(), new \DateInterval('P1D'), new \DateTime());

        $command = new CreateBudgetCommand($title, $period);

        $this->assertEquals($title, $command->getTitle());
        $this->assertEquals($period, $command->getPeriod());
    }
}
