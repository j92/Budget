<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class TransactionId
{
    /** @var Uuid */
    private $uuid;

    public static function generate(): BudgetId
    {
        $transactionId = new self();
        $transactionId->uuid = Uuid::uuid4();

        return $transactionId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}