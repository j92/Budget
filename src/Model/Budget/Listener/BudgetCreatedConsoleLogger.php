<?php

namespace BudgetTool\Model\Budget\Listener;

use BudgetTool\Model\Budget\Event\BudgetCreated;
use Symfony\Component\Console\Output\OutputInterface;

class BudgetCreatedConsoleLogger
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * BudgetCreatedConsoleLogger constructor.
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function onBudgetCreated(BudgetCreated $event)
    {
        $this->output->writeln("<info>Created Budget with id " . $event->getBudget()->getBudgetId()->toString());
    }
}