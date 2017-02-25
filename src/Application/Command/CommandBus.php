<?php

namespace Application\Command;

interface CommandBus
{
    public function execute(Command $command);
}