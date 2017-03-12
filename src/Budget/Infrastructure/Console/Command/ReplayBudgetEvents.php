<?php

namespace BudgetTool\Budget\Infrastructure\Console\Command;

use BudgetTool\Budget\Application\Command\ChangeBudgetPeriod;
use Guzzle\Common\Event;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Stream\StreamName;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\EventBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReplayBudgetEvents extends Command
{
    /** @var CommandBus */
    private $commandBus;

    /** @var EventStore */
    private $eventStore;
    /**
     * @var EventBus
     */
    private $eventBus;

    /**
     * AddBudgetCommand constructor.
     * @param CommandBus $commandBus
     * @param EventStore $eventStore
     * @param EventBus $eventBus
     */
    public function __construct(CommandBus $commandBus, EventStore $eventStore, EventBus $eventBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
        $this->eventStore = $eventStore;
        $this->eventBus = $eventBus;
    }

    protected function configure()
    {
        $this->setName('budget:replay-budget-events');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $replayStream = $this->eventStore->replay(array(new StreamName('budget_events_stream')));

        foreach ($replayStream as $recordedEvent) {
            $this->eventBus->dispatch($recordedEvent);
        }
    }
}