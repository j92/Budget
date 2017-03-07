<?php

namespace BudgetTool\Model\Budget\Command;

use BudgetTool\Command;

final class CreateBudget implements Command
{
    /** @var string */
    private $title;

    /** @var string */
    private $start;

    /** @var string */
    private $end;

    /** @var string */
    private $userId;

    /**
     * CreateBudget constructor.
     * @param string $title
     * @param string $start
     * @param string $end
     * @param string $userId
     */
    public function __construct(string $title, string $start, string $end, string $userId)
    {
        $this->title = $title;
        $this->start = $start;
        $this->end = $end;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @return string
     */
    public function getEnd(): string
    {
        return $this->end;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}