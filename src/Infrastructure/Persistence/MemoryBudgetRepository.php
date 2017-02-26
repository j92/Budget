<?php

namespace Infrastructure\Persistence;

use Domain\Budget\Budget;
use Domain\Budget\BudgetRepository;

class MemoryBudgetRepository implements BudgetRepository
{
    /**
     * @var Budget[]
     */
    public $items = [];

    public function create(Budget $budget)
    {
        $this->items[] = $budget;
    }
}