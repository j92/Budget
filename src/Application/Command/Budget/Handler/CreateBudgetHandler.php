<?php

namespace Application\Command\Budget\Handler;

use Application\Command\Budget\CreateBudgetCommand;
use Application\Command\Command;
use Application\Command\CommandHandler;
use Domain\Budget\Budget;
use Domain\Budget\BudgetRepository;

class CreateBudgetHandler implements CommandHandler
{
    /**
     * @var BudgetRepository
     */
    private $budgetRepository;

    /**
     * CreateBudgetHandler constructor.
     * @param BudgetRepository $budgetRepository
     */
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function handle(Command $command)
    {
        if (!$command instanceof CreateBudgetCommand) {
            throw new \Exception("CreateBudgetHandler can only handle CreateBudgetCommand");
        }

        $budget = new Budget();
        $budget->id = uniqid();
        $budget->title = $command->getTitle();
        $budget->period = $command->getPeriod();

        $this->budgetRepository->create($budget);
    }
}