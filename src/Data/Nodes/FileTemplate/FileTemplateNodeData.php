<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\FileTemplate;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

/**
 * @property FileTemplateNodeContentData $content
 */
class FileTemplateNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $content = $this->replaceWithVariables($this->content->template, $dataPiper->all());
        $path = $this->replaceWithVariables($this->content->output, $dataPiper->all());

        $this->createDirectory($path);
        $this->createFile($path, $content);
    }

    private function createFile(string $path, string $content)
    {
        $file = fopen($path, 'w');
        fwrite($file, $content);
        fclose($file);
    }

    private function createDirectory(string $path)
    {
        $directory = dirname($path);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
