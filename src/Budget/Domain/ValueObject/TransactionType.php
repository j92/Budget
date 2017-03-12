<?php

namespace BudgetTool\Budget\Domain\ValueObject;

use MabeEnum\Enum;

class TransactionType extends Enum
{
    const EXPENSE = 'expense';
    const INCOME = 'income';
}