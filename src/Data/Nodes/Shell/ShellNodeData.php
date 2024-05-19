<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Shell;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

/**
 * @property ShellNodeContentData $content
 */
class ShellNodeData extends NodeData implements Executable
{
    public function execute(&$data): void
    {
        $descriptorSpec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $proc = proc_open($this->content->script, $descriptorSpec, $pipes, null, $data);

        if (is_resource($proc)) {
            echo stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($proc);
        }
    }
}
