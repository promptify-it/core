<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Assign;

use Spatie\LaravelData\Data;

class AssignNodeContentData extends Data
{
    public function __construct(
        public string $key,
        public mixed $value,
    ) {
        //
    }
}
