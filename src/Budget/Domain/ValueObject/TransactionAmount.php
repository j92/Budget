<?php

namespace BudgetTool\Budget\Domain\ValueObject;

use Money\Currency;
use Money\Money;

final class TransactionAmount
{
    const DEFAULT_CURRENCY = 'EUR';

    /** @var Money */
    private $amount;

    public static function fromAmount(string $amount)
    {
        $instance = new self();
        $instance->amount = new Money($amount, new Currency(self::DEFAULT_CURRENCY));

        return $instance;
    }

    public static function fromJson(string $money): TransactionAmount
    {
        $money = json_decode($money, true);

        $instance = new self();
        $instance->amount = new Money($money['amount'], new Currency($money['currency']));

        return $instance;
    }

    /**
     * @return string
     */
    public function amount(): string
    {
        return $this->amount->getAmount();
    }

    public function toString()
    {
        return json_encode($this->amount);
    }
}