<?php

namespace BudgetTool\BudgetContext\Domain\Model;

class Budget
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var BudgetPeriod */
    private $period;

    /**
     * Budget constructor.
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
    public function getId(): string
    {
        return $this->id;
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