<?php

namespace Domain\Budget;

class Transaction
{
    /** @var string */
    public $id;

    /** @var double */
    public $amount;

    /** @var \DateTime */
    public $transactionDate;
}