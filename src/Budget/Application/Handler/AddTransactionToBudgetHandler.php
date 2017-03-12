<?php

declare(strict_types=1);

namespace BudgetTool\Budget\Application\Handler;

use BudgetTool\Budget\Application\Command\AddTransactionToBudget;
use BudgetTool\Budget\Domain\Model\BudgetRepository;
use BudgetTool\Budget\Domain\Model\Transaction;
use BudgetTool\Budget\Domain\ValueObject\BudgetId;
use BudgetTool\Budget\Domain\ValueObject\TransactionAmount;
use BudgetTool\Budget\Domain\ValueObject\TransactionDate;
use BudgetTool\Budget\Domain\ValueObject\TransactionId;
use BudgetTool\Budget\Domain\ValueObject\TransactionType;

final class AddTransactionToBudgetHandler
{
    /** @var BudgetRepository */
    private $budgetRepository;

    /**
     * AddTransactionToBudgetHandler constructor.
     * @param BudgetRepository $budgetRepository
     */
    public function __construct(BudgetRepository $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function __invoke(AddTransactionToBudget $command)
    {
        $budget = $this->budgetRepository->get(BudgetId::fromString($command->budgetId));

        $budget->addTransaction(
            TransactionId::generate(),
            TransactionAmount::fromAmount($command->amount),
            TransactionDate::fromString($command->date),
            TransactionType::byName($command->type)
        );

        $this->budgetRepository->add($budget);
    }
}