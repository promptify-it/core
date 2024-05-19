<?php

namespace PromptifyIt\PromptifyIt;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\CommandData;

class Transverser
{
    public function __construct(
        private CommandData $commandData,
    ) {
        //
    }

    public function transverse(): void
    {
        $data = [
            'COMMAND_SIGNATURE' => $this->commandData->signature,
            'EXECUTION_TIME' => now()->format('Y-m-d H:i:s'),
            'PATH' => getcwd(),
        ];

        collect($this->commandData->root->nodes)->each(function (Executable $node) use (&$data) {
            $node->execute($data);
        });
    }
}
