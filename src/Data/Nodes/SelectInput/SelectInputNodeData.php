<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\SelectInput;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

use function Laravel\Prompts\select;

/**
 * @property SelectInputNodeContentData $content
 */
class SelectInputNodeData extends NodeData implements Executable
{
    public function execute(&$data): void
    {
        $value = select(
            $this->content->label,
            $this->content->options,
            $this->content->default,
            $this->content->scroll,
            $this->content->validate,
            $this->content->hint,
            $this->content->required,
        );

        $data[$this->content->key] = $value;
    }
}
