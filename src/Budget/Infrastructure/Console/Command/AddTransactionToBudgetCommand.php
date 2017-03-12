<?php

namespace BudgetTool\Budget\Infrastructure\Console\Command;

use BudgetTool\Budget\Application\Command\AddTransactionToBudget;
use Prooph\ServiceBus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddTransactionToBudgetCommand extends Command
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
        $this->setName('budget:add-transaction');
        $this->addArgument('budget_id', InputArgument::REQUIRED);
        $this->addArgument('date', InputArgument::REQUIRED);
        $this->addArgument('amount', InputArgument::REQUIRED);
        $this->addArgument('type', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $transactionAdd = new AddTransactionToBudget();
        $transactionAdd->budgetId = $input->getArgument('budget_id');
        $transactionAdd->date = $input->getArgument('date');
        $transactionAdd->type = $input->getArgument('type');
        $transactionAdd->amount = $input->getArgument('amount');

        $this->commandBus->dispatch($transactionAdd);
    }
}