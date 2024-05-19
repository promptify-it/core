<?php

namespace PromptifyIt\PromptifyIt\Contracts;

interface Executable
{
    /**
     * Execute the command.
     */
    public function execute(array &$data): void;
}
