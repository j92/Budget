<?php

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\ValueObject\TransactionAmount;
use BudgetTool\Budget\Domain\ValueObject\TransactionDate;
use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use BudgetTool\Budget\Domain\ValueObject\TransactionType;
use Prooph\EventSourcing\AggregateRoot;

final class Transaction extends AggregateRoot
{
    /** @var TransactionId */
    private $transactionId;

    /** @var TransactionAmount */
    private $amount;

    /** @var TransactionDate */
    private $date;

    /** @var TransactionType */
    private $type;

    public static function create(TransactionId $transactionId,
                                  TransactionAmount $transactionAmount,
                                  TransactionDate $transactionDate,
                                  TransactionType $transactionType)
    {
        $self = new self();
        $self->transactionId = $transactionId;
        $self->amount = $transactionAmount;
        $self->date = $transactionDate;
        $self->type = $transactionType;

        return $self;
    }


    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
    {
        return $this->transactionId;
    }
}