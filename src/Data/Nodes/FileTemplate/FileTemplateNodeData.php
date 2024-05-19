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
        if ($this->content->generateInputForMissingKeys) {

        }
        $this->content->template = $this->replaceWithVariables($this->content->template, $data);
        $this->content->output = $this->replaceWithVariables($this->content->output, $data);

        $this->createDirectory();
        $this->createFile();
    }

    private function createFile()
    {
        $file = fopen($this->content->output, 'w');

        if ($this->isCreatingJsonFile()) {
            fwrite($file, json_encode(json_decode($this->content->template), JSON_PRETTY_PRINT));
            fclose($file);

            return;
        }

        fwrite($file, $this->content->template);
        fclose($file);
    }

    private function createDirectory()
    {
        $directory = dirname($this->content->output);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function isCreatingJsonFile()
    {
        return pathinfo($this->content->output, PATHINFO_EXTENSION) === 'json';
    }
}
