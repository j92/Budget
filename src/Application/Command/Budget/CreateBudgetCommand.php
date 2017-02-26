<?php

namespace Application\Command\Budget;

use Application\Command\Command;
use Domain\Budget\BudgetPeriod;

class CreateBudgetCommand implements Command
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var BudgetPeriod
     */
    private $period;

    /**
     * CreateBudgetCommand constructor.
     * @param string $title
     * @param BudgetPeriod $period
     */
    public function __construct($title, BudgetPeriod $period)
    {
        $this->title = $title;
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return BudgetPeriod
     */
    public function getPeriod(): BudgetPeriod
    {
        return $this->period;
    }

}