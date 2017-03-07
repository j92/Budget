<?php

require __DIR__.'/vendor/autoload.php';

$app = new \Symfony\Component\Console\Application();
$app->add(new \BudgetTool\Infrastructure\Console\Command\BudgetCreateCommand());
$app->run();

