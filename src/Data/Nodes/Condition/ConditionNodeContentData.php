<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Condition;

use Spatie\LaravelData\Data;

class ConditionNodeContentData extends Data
{
    public function __construct(
        public string $left,
        public string $operator,
        public string $right,
    ) {
        //
    }
}

