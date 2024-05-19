<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Assign;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

/**
 * @property AssignNodeContentData $content
 */
class AssignNodeData extends NodeData implements Executable
{
    public function execute(&$data): void
    {
        $data[$this->content->key] = $this->content->value;

        if (is_string($this->content->value)) {
            $this->provideReplacersFor($this->content->key, $this->content->value, $data);
        }
    }
}
