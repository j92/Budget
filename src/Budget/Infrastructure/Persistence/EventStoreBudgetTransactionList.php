<?php

namespace BudgetTool\Budget\Infrastructure\Persistence;

use BudgetTool\Budget\Domain\Model\BudgetTransactionList;
use BudgetTool\Budget\Domain\Model\Transaction;
use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use Prooph\EventStore\Aggregate\AggregateRepository;

class EventStoreBudgetTransactionList extends AggregateRepository implements BudgetTransactionList
{
    public function add(Transaction $transaction)
    {
        $this->addAggregateRoot($transaction);
    }

    public function get(TransactionId $transactionId)
    {
        return $this->getAggregateRoot($transactionId->toString());
    }
}