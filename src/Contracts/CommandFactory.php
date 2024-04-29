<?php

namespace PromptifyIt\PromptifyIt\Contracts;

use Illuminate\Console\Command;
use PromptifyIt\PromptifyIt\Data\CommandData;

interface CommandFactory
{
    /**
     * Create a new command instance.
     */
    public function factory(CommandData $commandData): Command;
}
