<?php

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use Prooph\EventSourcing\AggregateRoot;

class Transaction extends AggregateRoot
{
    /** @var TransactionId */
    private $transactionId;

    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
    {
        return $this->transactionId;
    }
}