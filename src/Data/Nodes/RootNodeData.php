<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes;

use PromptifyIt\PromptifyIt\Castables\Node;
use PromptifyIt\PromptifyIt\Concerns\Nodes\ResolvesNodesRules;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class RootNodeData extends Data
{
    use ResolvesNodesRules;

    public function __construct(
        #[WithCast(Node::class)]
        public array $nodes,
    ) {
        //
    }
}
