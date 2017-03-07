<?php

namespace BudgetTool\Model\Budget\Entity;

final class BudgetPeriod
{
    /** @var \DateTime */
    private $start;

    /** @var \DateTime */
    private $end;

    /**
     * @param string $start
     * @param string $end
     * @return BudgetPeriod
     */
    public static function fromString(string $start, string $end): BudgetPeriod
    {
        $start = new \DateTime($start, new \DateTimeZone('UTC'));
        $end = new \DateTime($end, new \DateTimeZone('UTC'));

        return new self($start, $end);
    }

    /**
     * Period constructor.
     * @param \DateTime $start
     * @param \DateTime $end
     */
    private function __construct(\DateTime $start, \DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->start->format(\DateTime::ATOM) . '|' . $this->end->format(\DateTime::ATOM);
    }
}