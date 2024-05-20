<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Shell;

use PromptifyIt\PromptifyIt\Castables\ArrayToString;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class ShellNodeContentData extends Data
{
    public function __construct(
        #[WithCast(ArrayToString::class)]
        public string $script,
    ) {
        //
    }
}
