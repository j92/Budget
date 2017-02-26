<?php

namespace Domain\Budget;
use Domain\Budget\Exception\BudgetPeriodInvalidException;

/**
 * Class BudgetPeriod
 * @package Domain\Budget
 */
class BudgetPeriod
{
    /** @var \DateTime */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * BudgetPeriod constructor.
     * @param \DateTime $start
     * @param \DateTime $end
     *
     * @throws BudgetPeriodInvalidException
     */
    public function __construct(\DateTime $start, \DateTime $end)
    {
        $this->ensureValidPeriod($start, $end);

        $this->start = $start;
        $this->end = $end;
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

    /**
     * Validates the BudgetPeriod
     *
     * @param \DateTime $start
     * @param \DateTime $end
     */
    private function ensureValidPeriod(\DateTime $start, \DateTime $end)
    {
        if ($start > $end) {
            throw BudgetPeriodInvalidException::startBeforeEnd();
        }
    }
}