<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class BudgetId
{
    /** @var Uuid */
    private $uuid;

    public static function generate(): BudgetId
    {
        $budgetId = new self();
        $budgetId->uuid = Uuid::uuid4();

        return $budgetId;
    }

    public static function fromString(string $id)
    {
        $budgetId = new self();
        $budgetId->uuid = Uuid::fromString($id);

        return $budgetId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}