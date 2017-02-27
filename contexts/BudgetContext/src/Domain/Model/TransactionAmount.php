<?php

namespace BudgetTool\BudgetContext\Domain\Model;

class TransactionAmount
{
    /** @var double */
    private $amount;

    /**
     * TransactionAmount constructor.
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}