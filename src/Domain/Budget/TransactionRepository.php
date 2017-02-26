<?php

namespace Domain\Budget;

interface TransactionRepository
{
    public function save(Transaction $transaction);
}