<?php

namespace BudgetTool\Model\Budget\Repository;

use BudgetTool\Model\Budget\Entity\Budget;

interface BudgetRepository
{
    /**
     * @param Budget $budget
     * @return mixed
     */
    public function save(Budget $budget);
}