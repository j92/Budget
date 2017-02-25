<?php

namespace Infrastructure\CommandBus;

use Application\Command\Command;
use Application\Command\CommandBus;
use Application\Command\CommandHandler;

class SynchronousCommandBus implements CommandBus
{
    /**
     * @var CommandHandler[]
     */
    private $handlers;
    
    public function execute(Command $command)
    {
        $commandName = get_class($command);

        if (!array_key_exists($commandName, $this->handlers)) {
            throw new \Exception("{$commandName} is not supported by the SynchronousCommandBus.");
        }

        return $this->handlers[$commandName]->handle($command);
    }

    /**
     * @param $commandName
     * @param CommandHandler $commandHandler
     * @return $this
     */
    public function register($commandName, CommandHandler $commandHandler)
    {
        $this->handlers[$commandName] = $commandHandler;

        return $this;
    }
}