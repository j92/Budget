<?php

namespace Domain\Budget\Exception;

class BudgetPeriodInvalidException extends \InvalidArgumentException
{
    public static function startBeforeEnd()
    {
        $errorMessage = 'The start date must appear before the end date';

        return new static($errorMessage);
    }
}