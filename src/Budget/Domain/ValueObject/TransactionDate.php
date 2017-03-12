<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Domain\ValueObject;

final class TransactionDate
{
    /**
     * @var \DateTime
     */
    private $date;

    public static function fromString(string $date)
    {
        $dateObj = \DateTime::createFromFormat(\DateTime::ATOM, $date);

        if (false === $dateObj) {
            throw new \InvalidArgumentException('Incorrect date format. Use '. \DateTime::ATOM);
        }

        $self = new self();
        $self->date = $dateObj;
        return $self;
    }

    public function toString(): string
    {
        return $this->date->format(\DateTime::ATOM);
    }
}