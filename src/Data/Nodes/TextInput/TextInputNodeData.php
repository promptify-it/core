<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\TextInput;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

use function Laravel\Prompts\text;

/**
 * @property TextInputNodeContentData $content
 */
class TextInputNodeData extends NodeData implements Executable
{
    public function execute(&$data): void
    {
        $value = text(
            $this->content->label,
            $this->content->placeholder,
            $this->resolveDefault($data),
            $this->content->required,
            $this->content->validate,
            $this->content->hint
        );

        $data[$this->content->key] = $value;

        if (is_string($value)) {
            $this->provideReplacersFor($this->content->key, $value, $data);
        }
    }

    private function resolveDefault($data): string
    {
        return $this->replaceWithVariables($this->content->default, $data);
    }
}
