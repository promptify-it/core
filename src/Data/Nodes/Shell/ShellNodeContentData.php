<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Shell;

use Spatie\LaravelData\Data;

class ShellNodeContentData extends Data
{
    public function __construct(
        public string $script,
    ) {
        //
    }
}
