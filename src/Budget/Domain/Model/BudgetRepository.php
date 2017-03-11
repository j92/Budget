<?php

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\ValueObject\BudgetId;

interface BudgetRepository
{
    /**
     * @param Budget $budget
     * @return void
     */
    public function add(Budget $budget);

    /**
     * @param BudgetId $budgetId
     * @return Budget|null
     */
    public function get(BudgetId $budgetId);
}