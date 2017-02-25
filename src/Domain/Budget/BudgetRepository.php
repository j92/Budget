<?php

namespace Domain\Budget;

interface BudgetRepository
{
    public function create(Budget $budget);
}