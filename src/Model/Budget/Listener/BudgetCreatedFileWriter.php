<?php

namespace BudgetTool\Model\Budget\Listener;

use BudgetTool\Model\Budget\Event\BudgetCreated;

class BudgetCreatedFileWriter
{
    public function onBudgetCreated(BudgetCreated $event)
    {
        $budgetId = $event->getBudget()->getBudgetId()->toString();
        file_put_contents(getcwd() . '/var/budgets/json/'. $budgetId.'.json', json_encode($event->getBudget()));
    }
}