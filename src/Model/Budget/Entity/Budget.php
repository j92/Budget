<?php

namespace BudgetTool\Model\Budget\Entity;

use BudgetTool\Model\User\Entity\UserId;

final class Budget
{
    /** @var BudgetId */
    private $budgetId;

    /** @var string */
    private $title;

    /** @var BudgetPeriod */
    private $period;

    /** @var UserId */
    private $userId;

    public static function fromUser(UserId $userId, string $title, BudgetPeriod $period)
    {
        $self = new self($userId, $title, $period);
        $self->budgetId = BudgetId::generate();

        return $self;
    }

    /**
     * Budget constructor.
     * @param UserId $userId
     * @param $title
     * @param BudgetPeriod $period
     */
    private function __construct(UserId $userId, $title, BudgetPeriod $period)
    {
        $this->title = $title;
        $this->period = $period;
        $this->userId = $userId;
    }

    /**
     * @return BudgetId
     */
    public function getBudgetId(): BudgetId
    {
        return $this->budgetId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return BudgetPeriod
     */
    public function getPeriod(): BudgetPeriod
    {
        return $this->period;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }
}