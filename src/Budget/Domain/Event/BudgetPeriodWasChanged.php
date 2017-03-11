<?php

namespace BudgetTool\Budget\Domain\Event;

use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;
use Prooph\EventSourcing\AggregateChanged;

class BudgetPeriodWasChanged extends AggregateChanged
{
    /** @var BudgetId */
    private $budgetId;

    /** @var BudgetPeriod */
    private $oldPeriod;

    /** @var BudgetPeriod */
    private $newPeriod;

    public static function fromPeriod(BudgetId $budgetId, BudgetPeriod $oldPeriod, BudgetPeriod $newPeriod)
    {
        $event = self::occur($budgetId->toString(), array(
            'old_period' => $oldPeriod->toString(),
            'new_period' => $newPeriod->toString(),
        ));

        $event->budgetId = $budgetId;
        $event->oldPeriod = $oldPeriod;
        $event->newPeriod = $newPeriod;

        return $event;
    }

    public function budgetId(): BudgetId
    {
        if (null === $this->budgetId) {
            $this->budgetId = BudgetId::fromString($this->aggregateId());
        }

        return $this->budgetId;
    }

    public function oldPeriod(): BudgetPeriod
    {
        if (null === $this->oldPeriod) {
            $this->oldPeriod = BudgetPeriod::fromString($this->payload['old_period']);
        }

        return $this->oldPeriod;
    }

    public function newPeriod(): BudgetPeriod
    {
        if (null === $this->newPeriod) {
            $this->newPeriod = BudgetPeriod::fromString($this->payload['new_period']);
        }

        return $this->newPeriod;
    }
}