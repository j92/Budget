<?php

namespace Domain\Budget;

class Budget
{
    /** @var string */
    public $id;

    /** @var string */
    public $title;

    /** @var BudgetPeriod */
    public $period;
}