<?php

namespace BudgetTool\Infrastructure\Console\Command;

use BudgetTool\Infrastructure\Repository\File\XmlBudgetRepository;
use BudgetTool\Infrastructure\Repository\Memory\BudgetRepository;
use BudgetTool\Model\Budget\Command\CreateBudget;
use BudgetTool\Model\Budget\Event\BudgetCreated;
use BudgetTool\Model\Budget\Handler\CreateBudgetHandler;
use BudgetTool\Model\Budget\Listener\BudgetCreatedConsoleLogger;
use BudgetTool\Model\Budget\Listener\BudgetCreatedFileWriter;
use BudgetTool\Model\User\Entity\UserId;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\Plugin\Router\CommandRouter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class BudgetCreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('budget:create')
            ->setDescription('Creates a new budget.')
            ->addArgument('title', InputArgument::REQUIRED)
            ->addArgument('start', InputArgument::REQUIRED)
            ->addArgument('end', InputArgument::REQUIRED)
            ->addArgument('user_id', InputArgument::OPTIONAL)
            ->setHelp('This command allows you to create a budget...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $budgetRepository = new XmlBudgetRepository();
        $budgetCreatedListener = new BudgetCreatedConsoleLogger($output);
        $budgetCreatedWriter = new BudgetCreatedFileWriter();
        $eventBus = new EventDispatcher();
        $eventBus->addListener(BudgetCreated::class, array($budgetCreatedListener, 'onBudgetCreated'));
        $eventBus->addListener(BudgetCreated::class, array($budgetCreatedWriter, 'onBudgetCreated'));

        $handler = new CreateBudgetHandler($budgetRepository, $eventBus);

        $commandBus = new CommandBus();
        $commandRouter = new CommandRouter();

        $commandRouter->route(CreateBudget::class)
            ->to($handler);

        $commandRouter->attachToMessageBus($commandBus);

        $command = new CreateBudget(
            $input->getArgument('title'),
            $input->getArgument('start'),
            $input->getArgument('end'),
            UserId::generate()->toString()
        );

        $commandBus->dispatch($command);
    }
}