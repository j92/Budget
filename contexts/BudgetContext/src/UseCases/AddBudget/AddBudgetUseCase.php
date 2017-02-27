<?php

namespace BudgetTool\BudgetContext\UseCases\AddBudget;

use BudgetTool\BudgetContext\Domain\Model\Budget;
use BudgetTool\BudgetContext\Domain\Model\BudgetPeriod;
use BudgetTool\BudgetContext\Domain\Repositories\BudgetRepository;

class AddBudgetUseCase
{
    /** @var BudgetRepository */
    private $budgetRepository;

    /**
     * AddBudgetUseCase constructor.
     * @param BudgetRepository $budgetRepository
     */
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function addBudget(AddBudgetRequest $request)
    {
        $budget = new Budget($request->getTitle(), new BudgetPeriod($request->getStart(), $request->getEnd()));

        $this->budgetRepository->save($budget);
    }
}