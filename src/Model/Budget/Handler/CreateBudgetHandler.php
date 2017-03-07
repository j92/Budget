<?php

namespace BudgetTool\Model\Budget\Handler;

use BudgetTool\Model\Budget\Command\CreateBudget;
use BudgetTool\Model\Budget\Entity\Budget;
use BudgetTool\Model\Budget\Entity\BudgetPeriod;
use BudgetTool\Model\Budget\Event\BudgetCreated;
use BudgetTool\Model\Budget\Repository\BudgetRepository;
use BudgetTool\Model\User\Entity\UserId;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class CreateBudgetHandler
{
    /** @var BudgetRepository */
    private $budgetRepository;

    /** @var EventDispatcher */
    private $eventDispatcher;

    /**
     * CreateBudgetHandler constructor.
     * @param BudgetRepository $budgets
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(BudgetRepository $budgets, EventDispatcher $eventDispatcher)
    {
        $this->budgetRepository = $budgets;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateBudget $command)
    {
        $budget = Budget::fromUser(
            UserId::fromString($command->getUserId()),
            $command->getTitle(),
            BudgetPeriod::fromString($command->getStart(), $command->getEnd())
        );

        $this->budgetRepository->save($budget);
        $this->eventDispatcher->dispatch(BudgetCreated::class, new BudgetCreated($budget));
    }
}