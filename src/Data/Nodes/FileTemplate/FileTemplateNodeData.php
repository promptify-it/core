<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\FileTemplate;

use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

/**
 * @property FileTemplateNodeContentData $content
 */
class FileTemplateNodeData extends NodeData implements Executable
{
    public function execute(&$data): void
    {
        $content = $this->replaceWithVariables($this->content->template, $data);
        $path = $this->replaceWithVariables($this->content->output, $data);

        $this->createDirectory($path);
        $this->createFile($content);
    }

    private function createFile(string $content)
    {
        $file = fopen($content, 'w');

        if ($this->isCreatingJsonFile()) {
            fwrite($file, json_encode(json_decode($content), JSON_PRETTY_PRINT));
            fclose($file);

            return;
        }

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

    private function isCreatingJsonFile()
    {
        return pathinfo($this->content->output, PATHINFO_EXTENSION) === 'json';
    }
}
