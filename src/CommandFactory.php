<?php

namespace PromptifyIt\PromptifyIt;

use Illuminate\Console\Command;
use PromptifyIt\PromptifyIt\Contracts\CommandFactory as CommandFactoryContract;
use PromptifyIt\PromptifyIt\Data\CommandData;

class CommandFactory implements CommandFactoryContract
{
    public function factory(CommandData $commandData): Command
    {
        return new class($commandData) extends Command
        {
            protected $signature;

            protected $description;

            public function __construct(protected CommandData $commandData)
            {
                parent::__construct();

                $this->signature = $commandData->signature;
                $this->description = $commandData->description;
            }

            public function handle(): void
            {
                (new Transverser($this->commandData))->transverse();
            }
        };
    }
}
