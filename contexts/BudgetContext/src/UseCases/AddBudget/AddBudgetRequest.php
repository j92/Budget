<?php

namespace BudgetTool\BudgetContext\UseCases\AddBudget;

use BudgetTool\BudgetContext\Domain\Model\BudgetPeriod;

class AddBudgetRequest
{
    /** @var string */
    private $title;

    /** @var \DateTime */
    private $start;

    /** @var \DateTime */
    private $end;

    /**
     * AddBudgetRequest constructor.
     * @param string $title
     * @param \DateTime $start
     * @param \DateTime $end
     */
    public function __construct($title, \DateTime $start, \DateTime $end)
    {
        $this->title = $title;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

}