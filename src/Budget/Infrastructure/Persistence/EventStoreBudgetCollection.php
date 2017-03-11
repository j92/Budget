<?php

namespace BudgetTool\Budget\Infrastructure\Persistence;

use BudgetTool\Budget\Domain\Model\Budget;
use BudgetTool\Budget\Domain\Model\BudgetRepository;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use Prooph\EventStore\Aggregate\AggregateRepository;

class EventStoreBudgetCollection extends AggregateRepository implements BudgetRepository
{
    /**
     * @param Budget $budget
     * @return void
     */
    public function add(Budget $budget)
    {
        $this->eventStore->beginTransaction();
        $this->addAggregateRoot($budget);
        $this->eventStore->commit();
    }

    /**
     * @param BudgetId $budgetId
     * @return Budget|null
     */
    public function get(BudgetId $budgetId)
    {
        return $this->getAggregateRoot($budgetId->toString());
    }
}