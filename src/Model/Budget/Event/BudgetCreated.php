<?php

namespace BudgetTool\Model\Budget\Event;

use BudgetTool\Event;
use BudgetTool\Model\Budget\Entity\Budget;

class BudgetCreated extends Event
{
    /**
     * @var Budget
     */
    private $budget;

    /**
     * BudgetCreated constructor.
     * @param Budget $budget
     */
    public function __construct(Budget $budget)
    {
        $this->budget = $budget;
    }

    /**
     * @return Budget
     */
    public function getBudget(): Budget
    {
        return $this->budget;
    }
}