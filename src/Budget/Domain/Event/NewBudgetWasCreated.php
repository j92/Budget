<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\Event;

use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;
use Prooph\EventSourcing\AggregateChanged;

class NewBudgetWasCreated extends AggregateChanged
{
    /** @var BudgetPeriod */
    private $budgetPeriod;

    /** @var string */
    private $userId;

    /** @var BudgetId */
    private $budgetId;

    public static function byUser(BudgetId $budgetId, string $userId, BudgetPeriod $budgetPeriod)
    {
        $newBudgetEvent = self::occur($budgetId->toString(), array(
            'budget_period' => $budgetPeriod->toString(),
            'user_id' => $userId,
        ));

        return $newBudgetEvent;
    }

    public function budgetPeriod(): BudgetPeriod
    {
        if (null === $this->budgetPeriod) {
            $this->budgetPeriod = BudgetPeriod::fromString($this->payload['budget_period']);
        }

        return $this->budgetPeriod;
    }

    public function userId(): string
    {
        return $this->payload['user_id'];
    }

    public function budgetId(): BudgetId
    {
        if (null === $this->budgetId) {
            $this->budgetId = BudgetId::fromString($this->aggregateId());
        }

        return $this->budgetId;
    }
}