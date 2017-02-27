<?php

namespace BudgetTool\BudgetContext\Domain\Repositories;

use BudgetTool\BudgetContext\Domain\Model\Budget;

interface BudgetRepository
{
    public function save(Budget $budget);
}