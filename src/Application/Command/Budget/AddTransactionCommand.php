<?php

namespace Application\Command\Budget;

use Application\Command\Command;
use Domain\Budget\TransactionAmount;
use Domain\Budget\TransactionDate;

class AddTransactionCommand implements Command
{
    /** @var TransactionAmount */
    private $amount;

    /** @var TransactionDate */
    private $transactionDate;

    /**
     * CreateTransactionCommand constructor.
     * @param TransactionAmount $amount
     * @param TransactionDate $transactionDate
     */
    public function __construct(TransactionAmount $amount, TransactionDate $transactionDate)
    {
        $this->amount = $amount;
        $this->transactionDate = $transactionDate;
    }

    /**
     * @return TransactionAmount
     */
    public function getAmount(): TransactionAmount
    {
        return $this->amount;
    }

    /**
     * @return TransactionDate
     */
    public function getTransactionDate(): TransactionDate
    {
        return $this->transactionDate;
    }
}