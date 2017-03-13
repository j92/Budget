<?php

namespace BudgetTool\Budget\Infrastructure\Projection;

use BudgetTool\Budget\Domain\Event\BudgetPeriodWasChanged;
use BudgetTool\Budget\Domain\Event\NewBudgetWasCreated;
use BudgetTool\Budget\Domain\Event\TransactionWasAddedToBudget;
use Doctrine\DBAL\Connection;

final class BudgetProjector
{
    /** @var Connection */
    private $connection;

    /**
     * BudgetProjector constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function onNewBudgetWasCreated(NewBudgetWasCreated $event)
    {
        $this->connection->insert(Table::BUDGET, array(
            'id' => $event->budgetId()->toString(),
            'start' => $event->budgetPeriod()->getStart()->format('Y-m-d H:i:s'),
            'end' => $event->budgetPeriod()->getEnd()->format('Y-m-d H:i:s'),
            'user_id' => $event->userId()
        ));
    }

    public function onBudgetPeriodWasChanged(BudgetPeriodWasChanged $event)
    {
        $this->connection->update(Table::BUDGET, array (
                'start' => $event->newPeriod()->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->newPeriod()->getEnd()->format('Y-m-d H:i:s')
            ), array(
                'id' => $event->budgetId()->toString(),
            )
        );
    }

    public function onTransactionWasAddedToBudget(TransactionWasAddedToBudget $event)
    {
        $sql = "SELECT expense_count, expense_total FROM read_budget WHERE id = ?";
        $budget = $this->connection->fetchAssoc($sql, array($event->budgetId()->toString()));

        $expenseCount = $budget['expense_count'];
        $expenseTotal = $budget['expense_total'];

        $this->connection->update(Table::BUDGET, array (
            'expense_count' => $expenseCount + 1,
            'expense_total' => $expenseTotal + (int) $event->amount()->amount(),
        ), array(
                'id' => $event->budgetId()->toString(),
            )
        );
    }
}