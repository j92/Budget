<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Application\Handler;

use BudgetTool\Budget\Application\Command\AddBudget;
use BudgetTool\Budget\Domain\Model\Budget;
use BudgetTool\Budget\Domain\Model\BudgetRepository;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;

final class AddBudgetHandler
{
    /** @var BudgetRepository */
    private $budgetRepository;

    /**
     * AddBudgetHandler constructor.
     * @param BudgetRepository $budgetRepository
     */
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function __invoke(AddBudget $command)
    {
        $budget = Budget::createForUser(
            'unknown',
            BudgetId::generate(),
            BudgetPeriod::fromStartEndString($command->start, $command->end)
        );

        $this->budgetRepository->add($budget);
    }
}