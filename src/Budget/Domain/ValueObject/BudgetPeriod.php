<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\ValueObject;

final class BudgetPeriod
{
    /** @var \DateTime */
    private $start;

    /** @var \DateTime */
    private $end;

    public static function fromStartEndString(string $start, string $end): BudgetPeriod
    {
        $instance = new self();
        $instance->start = new \DateTime($start);
        $instance->end = new \DateTime($end);

        return $instance;
    }

    public static function fromString(string $budgetPeriod)
    {
        $dates = explode('|', $budgetPeriod);

        $instance = new self();
        $instance->start = \DateTime::createFromFormat(\DateTime::ISO8601, $dates[0]);
        $instance->end = \DateTime::createFromFormat(\DateTime::ISO8601, $dates[1]);

        return $instance;
    }

    public static function fromDateTimes(\DateTime $start, \DateTime $end): BudgetPeriod
    {
        $period = new self();
        $period->start = $start;
        $period->end = $end;
    }

    public function getStart(): \DateTime
    {
        return $this->start;
    }

    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    public function toString(): string
    {
        return $this->start->format(\DateTime::ISO8601) .'|'. $this->end->format(\DateTime::ISO8601);
    }
}