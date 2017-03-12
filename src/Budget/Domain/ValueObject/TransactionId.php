<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\ValueObject;

use Rhumsaa\Uuid\Uuid;

final class TransactionId
{
    /** @var Uuid */
    private $uuid;

    public static function generate(): TransactionId
    {
        $transactionId = new self();
        $transactionId->uuid = Uuid::uuid4();

        return $transactionId;
    }

    public static function fromString(string $id)
    {
        $transactionId = new self();
        $transactionId->uuid = Uuid::fromString($id);

        return $transactionId;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}