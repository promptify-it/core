<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\PasswordInput;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Contracts\Optionable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

use function Laravel\Prompts\password;

/**
 * @property PasswordInputNodeContentData $content
 */
class PasswordInputNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $value = password(
            $this->content->label,
            $this->content->placeholder,
            $this->content->required,
            $this->content->validate,
            $this->content->hint
        );

        $data[$this->content->key] = $value;
    }
}
