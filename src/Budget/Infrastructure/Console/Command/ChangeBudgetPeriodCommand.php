<?php

namespace BudgetTool\Budget\Infrastructure\Console\Command;

use BudgetTool\Budget\Application\Command\ChangeBudgetPeriod;
use Prooph\ServiceBus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangeBudgetPeriodCommand extends Command
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
        $this->setName('budget:change-period');
        $this->addArgument('budget_id', InputArgument::REQUIRED);
        $this->addArgument('start', InputArgument::REQUIRED);
        $this->addArgument('end', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new ChangeBudgetPeriod();
        $command->budgetId = $input->getArgument('budget_id');
        $command->start = $input->getArgument('start');
        $command->end = $input->getArgument('end');

        $this->commandBus->dispatch($command);
    }
}