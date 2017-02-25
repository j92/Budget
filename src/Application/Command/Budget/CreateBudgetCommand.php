<?php

namespace Application\Command\Budget;

use Application\Command\Command;

class CreateBudgetCommand implements Command
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var \DatePeriod
     */
    private $period;

    /**
     * CreateBudgetCommand constructor.
     * @param string $title
     * @param \DatePeriod $period
     */
    public function __construct($title, \DatePeriod $period)
    {
        $this->title = $title;
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \DatePeriod
     */
    public function getPeriod()
    {
        return $this->period;
    }

}