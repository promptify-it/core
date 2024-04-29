<?php

namespace PromptifyIt\PromptifyIt\Contracts;

use Illuminate\Support\Collection;

interface Loader
{
    /**
     * Load the commands.
     */
    public function loadCommands(): Collection;
}
