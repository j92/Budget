<?php

namespace Application\Command;

interface CommandHandler
{
    public function handle(Command $command);
}