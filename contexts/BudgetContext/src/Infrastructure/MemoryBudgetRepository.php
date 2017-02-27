<?php

namespace BudgetTool\BudgetContext\Infrastructure;

use BudgetTool\BudgetContext\Domain\Model\Budget;
use BudgetTool\BudgetContext\Domain\Repositories\BudgetRepository;

class MemoryBudgetRepository implements BudgetRepository
{
    /**
     * @var Budget[]
     */
    public $items = [];

    public function save(Budget $budget)
    {
        $this->items[] = $budget;
    }
}