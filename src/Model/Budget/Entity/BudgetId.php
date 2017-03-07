<?php

namespace BudgetTool\Model\Budget\Entity;

use Ramsey\Uuid\Uuid;

final class BudgetId
{
    /** @var Uuid */
    private $budgetId;

    public static function generate()
    {
        $self = new self();
        $self->budgetId = Uuid::uuid4();

        return $self;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->budgetId->toString();
    }
}