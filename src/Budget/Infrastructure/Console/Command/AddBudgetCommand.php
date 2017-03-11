<?php

namespace BudgetTool\Budget\Infrastructure\Console\Command;

use BudgetTool\Budget\Application\Command\AddBudget;
use Prooph\ServiceBus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddBudgetCommand extends Command
{
    /** @var CommandBus */
    private $commandBus;

    /**
     * AddBudgetCommand constructor.
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    protected function configure()
    {
        $this->setName('budget:add');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $addBudget = new AddBudget();
        $addBudget->start = '1-01-2017';
        $addBudget->end = '1-02-2017';

        $this->commandBus->dispatch($addBudget);
    }
}