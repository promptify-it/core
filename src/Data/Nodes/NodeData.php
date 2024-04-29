<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes;

use PromptifyIt\PromptifyIt\Castables\Node;
use PromptifyIt\PromptifyIt\Castables\NodeContent;
use PromptifyIt\PromptifyIt\Concerns\Nodes\ProvidesReplacers;
use PromptifyIt\PromptifyIt\Concerns\Nodes\ReplacesWithVariables;
use PromptifyIt\PromptifyIt\Concerns\Nodes\ResolvesNodesRules;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @property NodeData[] $nodes
 */
abstract class NodeData extends Data implements Executable
{
    use ProvidesReplacers;
    use ReplacesWithVariables;
    use ResolvesNodesRules;

    #[Computed]
    public string $type;

    public function __construct(
        #[WithCast(NodeContent::class)]
        public $content,
        #[WithCast(Node::class)]
        public array $nodes = [],
    ) {
        $this->type = $this->guessType();
    }

    public function guessType(): string
    {
        return str(static::class)
            ->afterLast('\\')
            ->replace('NodeData', '')
            ->kebab()
            ->toString();
    }

    protected function executeNodes(&$data): void
    {
        collect($this->nodes)->each(function (Executable $node) use (&$data) {
            $node->execute($data);
        });
    }
}
