<?php

namespace PromptifyIt\PromptifyIt\Data;

use PromptifyIt\PromptifyIt\Data\Nodes\RootNodeData;
use Spatie\LaravelData\Data;

class CommandData extends Data
{
    public function __construct(
        public string $signature,
        public string $description,
        public RootNodeData $root,
    ) {
        //
    }
}
