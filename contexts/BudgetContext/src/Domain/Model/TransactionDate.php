<?php

namespace BudgetTool\BudgetContext\Domain\Model;

class TransactionDate
{
    /** @var \DateTime */
    private $date;

    /**
     * TransactionDate constructor.
     * @param \DateTime $date
     */
    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

}