<?php

require_once 'vendor/autoload.php';

use Application\Command\Budget\CreateBudgetCommand;
use Application\Command\Budget\Handler\CreateBudgetHandler;
use Infrastructure\CommandBus\SynchronousCommandBus;
use Infrastructure\Persistence\MemoryBudgetRepository;

$budgetRepository = new MemoryBudgetRepository();
$commandHandler = new CreateBudgetHandler($budgetRepository);

$commandBus = new SynchronousCommandBus();
$commandBus->register(CreateBudgetCommand::class, $commandHandler);

$command = new CreateBudgetCommand(
    'Budget voor januari',
    new DatePeriod(new DateTime(), new DateInterval('P1D'), new DateTime())
);
$commandBus->execute($command);