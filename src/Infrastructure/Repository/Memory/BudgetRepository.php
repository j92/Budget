<?php

namespace BudgetTool\Infrastructure\Repository\Memory;

use BudgetTool\Model\Budget\Entity\Budget;

class BudgetRepository implements \BudgetTool\Model\Budget\Repository\BudgetRepository
{
    /**
     * @var Budget[]
     */
    private $items;

    /**
     * @param Budget $budget
     * @return mixed
     */
    public function save(Budget $budget)
    {
        $this->items[$budget->getBudgetId()->toString()] = $budget;
    }
}