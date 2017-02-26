<?php

namespace Infrastructure\Persistence;

use Domain\Budget\Transaction;
use Domain\Budget\TransactionRepository;

class MemoryTransactionRepository implements TransactionRepository
{
    public $transactions = [];

    public function save(Transaction $transaction)
    {
        $this->transactions[] = $transaction;
    }
}