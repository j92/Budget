<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\Event;

use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\TransactionAmount;
use BudgetTool\Budget\Domain\ValueObject\TransactionDate;
use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use BudgetTool\Budget\Domain\ValueObject\TransactionType;
use Prooph\EventSourcing\AggregateChanged;

final class TransactionWasAddedToBudget extends AggregateChanged
{
    /** @var BudgetId */
    private $budgetId;

    /** @var TransactionAmount */
    private $amount;

    /** @var TransactionDate */
    private $date;

    /** @var TransactionId */
    private $transactionId;

    /** @var TransactionType */
    private $transactionType;

    public static function fromTransaction(BudgetId $budgetId,
                                           TransactionAmount $transactionAmount,
                                           TransactionDate $transactionDate,
                                           TransactionId $transactionId,
                                           TransactionType $transactionType)
    {
        $event = self::occur($budgetId->toString(), array(
            'amount' => $transactionAmount->toString(),
            'date' => $transactionDate->toString(),
            'id' => $transactionId->toString(),
            'type' => $transactionType->getValue()
        ));

        $event->budgetId = $budgetId;
        $event->amount = $transactionAmount;
        $event->date = $transactionDate;
        $event->transactionId = $transactionId;
        $event->transactionType = $transactionType;

        return $event;
    }

    /**
     * @return BudgetId
     */
    public function budgetId(): BudgetId
    {
        if (null === $this->budgetId) {
            $this->budgetId = BudgetId::fromString($this->aggregateId());
        }

        return $this->budgetId;
    }

    /**
     * @return TransactionAmount
     */
    public function amount(): TransactionAmount
    {
        if (null === $this->amount) {
            $this->amount = TransactionAmount::fromJson($this->payload['amount']);
        }

        return $this->amount;
    }

    /**
     * @return TransactionDate
     */
    public function date(): TransactionDate
    {
        if (null === $this->date) {
            $this->date = TransactionDate::fromString($this->payload['date']);
        }

        return $this->date;
    }

    /**
     * @return TransactionId
     */
    public function transactionId(): TransactionId
    {
        if (null === $this->transactionId) {
            $this->transactionId = TransactionId::fromString($this->payload['id']);
        }

        return $this->transactionId;
    }

    /**
     * @return TransactionType
     */
    public function transactionType(): TransactionType
    {
        if (null === $this->transactionType) {
            $this->transactionType = TransactionType::byValue($this->payload['type']);
        }

        return $this->transactionType;
    }
}