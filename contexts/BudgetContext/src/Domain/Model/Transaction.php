<?php

namespace BudgetTool\BudgetContext\Domain\Model;

abstract class Transaction
{
    /** @var TransactionAmount */
    protected $amount;

    /** @var TransactionDate */
    protected $date;

    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return TransactionDate
     */
    public function getDate(): TransactionDate
    {
        return $this->date;
    }

}