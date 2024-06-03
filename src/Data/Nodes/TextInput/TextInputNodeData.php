<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\TextInput;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

use function Laravel\Prompts\text;

/**
 * @property TextInputNodeContentData $content
 */
class TextInputNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $value = text(
            $this->content->label,
            $this->content->placeholder,
            $this->resolveDefault($dataPiper),
            $this->content->required,
            $this->content->validate,
            $this->content->hint
        );

        $dataPiper->set($this->content->key, $value);

        if (is_string($value)) {
            $this->provideReplacersFor($this->content->key, $value, $dataPiper);
        }
    }

    private function resolveDefault(DataPiper $dataPiper): string
    {
        return $this->replaceWithVariables($this->content->default, $dataPiper->all());
    }
}
