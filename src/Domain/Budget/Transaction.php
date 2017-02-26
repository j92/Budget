<?php

namespace Domain\Budget;

class Transaction
{
    /** @var string */
    public $id;

    /** @var TransactionAmount */
    public $amount;

    /** @var TransactionDate */
    public $transactionDate;

    /**
     * Transaction constructor.
     * @param string $id
     * @param TransactionAmount $amount
     * @param TransactionDate $transactionDate
     */
    public function __construct(string $id, TransactionAmount $amount, TransactionDate $transactionDate)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->transactionDate = $transactionDate;
    }

}