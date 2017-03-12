<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\Event\BudgetPeriodWasChanged;
use BudgetTool\Budget\Domain\Event\NewBudgetWasCreated;
use BudgetTool\Budget\Domain\Event\TransactionWasAddedToBudget;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;
use BudgetTool\Budget\Domain\ValueObject\TransactionAmount;
use BudgetTool\Budget\Domain\ValueObject\TransactionDate;
use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use BudgetTool\Budget\Domain\ValueObject\TransactionType;
use Prooph\EventSourcing\AggregateRoot;

final class Budget extends AggregateRoot
{
    /** @var string */
    private $userId;

    /** @var BudgetPeriod */
    private $budgetPeriod;

    /** @var BudgetId */
    private $budgetId;

    /** @var Transaction[] */
    private $transactions;

    /**
     * @param string $userId
     * @param BudgetId $budgetId
     * @param BudgetPeriod $budgetPeriod
     * @return Budget
     */
    public static function createForUser(string $userId, BudgetId $budgetId, BudgetPeriod $budgetPeriod): Budget
    {
        $budget = new self();
        $budget->recordThat(NewBudgetWasCreated::byUser($budgetId, $userId, $budgetPeriod));

        return $budget;
    }

    public function changePeriod(BudgetPeriod $newPeriod)
    {
        $this->recordThat(BudgetPeriodWasChanged::fromPeriod(
            $this->budgetId, $this->budgetPeriod, $newPeriod
        ));
    }

    /**
     * @param TransactionId $transactionId
     * @param TransactionAmount $transactionAmount
     * @param TransactionDate $transactionDate
     * @param TransactionType $transactionType
     */
    public function addTransaction(TransactionId $transactionId,
                                   TransactionAmount $transactionAmount,
                                   TransactionDate $transactionDate,
                                   TransactionType $transactionType)
    {
        $this->recordThat(TransactionWasAddedToBudget::fromTransaction(
            $this->budgetId,
            $transactionAmount,
            $transactionDate,
            $transactionId,
            $transactionType
        ));
    }

    protected function whenNewBudgetWasCreated(NewBudgetWasCreated $event)
    {
        $this->budgetPeriod = $event->budgetPeriod();
        $this->userId = $event->userId();
        $this->budgetId = $event->budgetId();
    }

    protected function whenBudgetPeriodWasChanged(BudgetPeriodWasChanged $event)
    {
        $this->budgetPeriod = $event->newPeriod();
    }

    protected function whenTransactionWasAddedToBudget(TransactionWasAddedToBudget $event)
    {
        $this->transactions[] = Transaction::create(
            $event->transactionId(),
            $event->amount(),
            $event->date(),
            $event->transactionType()
        );
    }

    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
    {
        return $this->budgetId->toString();
    }
}