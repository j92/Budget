<?php

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\ValueObject\TransactionId;

interface BudgetTransactionList
{
    public function add(Transaction $transaction);

    public function get(TransactionId $transactionId);
}