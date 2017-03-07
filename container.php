<?php

use BudgetTool\Model\Budget\Command\AddBudgetCommand;
use BudgetTool\Model\Budget\Command\AddBudgetHandler;
use League\Container\Container;
use League\Tactician\Setup\QuickStart;

$container = new Container();
$container->add('Prooph\EventStore\EventStore')
    ->withArgument();

$container->add('BudgetTool\Budget\Infrastructure\Persistence\EventSourced\PlanRepository')
    ->withArgument('');

$commandBus = QuickStart::create([
    AddBudgetCommand::class => new AddBudgetHandler($planRepository, $consoleLogger)
]);

$container->add('command_bus', $commandBus);