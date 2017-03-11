<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Application\Handler;

use BudgetTool\Budget\Application\Command\ChangeBudgetPeriod;
use BudgetTool\Budget\Domain\Model\BudgetRepository;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\BudgetPeriod;
use Prooph\EventStore\EventStore;

final class ChangeBudgetPeriodHandler
{
    /** @var BudgetRepository */
    private $budgetRepository;

    /** @var EventStore */
    private $eventStore;

    /**
     * ChangeBudgetPeriodHandler constructor.
     * @param BudgetRepository $budgetRepository
     * @param EventStore $eventStore
     */
    public function __construct(BudgetRepository $budgetRepository, EventStore $eventStore)
    {
        $this->budgetRepository = $budgetRepository;
        $this->eventStore = $eventStore;
    }

    public function __invoke(ChangeBudgetPeriod $command)
    {
        $budget = $this->budgetRepository->get(BudgetId::fromString($command->budgetId));

        if (null === $budget) {
            throw new \Exception(sprintf('Budget with id %s not found', $command->budgetId));
        }

        $this->eventStore->beginTransaction();

        $budget->changePeriod(BudgetPeriod::fromStartEndString($command->start, $command->end));

        $this->eventStore->commit();
    }
}