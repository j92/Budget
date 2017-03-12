<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Application\Command;

final class AddTransactionToBudget
{
    /** @var string */
    public $budgetId;

    /** @var string */
    public $amount;

    /** @var string */
    public $date;

    /** @var string */
    public $type;
}