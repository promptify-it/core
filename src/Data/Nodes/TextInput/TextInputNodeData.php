<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\TextInput;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Contracts\Optionable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

use function Laravel\Prompts\text;

/**
 * @property TextInputNodeContentData $content
 */
class TextInputNodeData extends NodeData implements Executable, Optionable
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

        $data[$this->content->key] = $value;

        if (is_string($value)) {
            $this->provideReplacersFor($this->content->key, $value, $dataPiper->get());
        }
    }

    private function resolveDefault(DataPiper $dataPiper): string
    {
        return $this->replaceWithVariables($this->content->default, $dataPiper->get());
    }

    public function asOptions(): array
    {
        return [
            [
                'default' => $this->content->default,
                'required' => $this->content->required,
                'name' => str($this->content->key)->kebab()->toString(),
                'description' => $this->content->hint,
            ],
        ];
    }
}
