<?php

namespace PromptifyIt\PromptifyIt;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\CommandData;

class Transverser
{
    public function __construct(
        private CommandData $commandData,
    ) {
        //
    }

    public function transverse(DataPiper $dataPiper): void
    {
        collect($this->commandData->root->nodes)->each(function (Executable $node) use (&$dataPiper) {
            $node->execute($dataPiper);
        });
    }
}
