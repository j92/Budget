<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\Model;

use BudgetTool\Budget\Domain\Event\BudgetPeriodWasChanged;
use BudgetTool\Budget\Domain\Event\NewBudgetWasCreated;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;
use Prooph\EventSourcing\AggregateRoot;

class Budget extends AggregateRoot
{
    /** @var string */
    private $userId;

    /** @var BudgetPeriod */
    private $budgetPeriod;

    /** @var BudgetId */
    private $budgetId;

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

    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
    {
        return $this->budgetId->toString();
    }
}