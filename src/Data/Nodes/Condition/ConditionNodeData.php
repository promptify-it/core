<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\Condition;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;
use PromptifyIt\PromptifyIt\Contracts\Executable;
use PromptifyIt\PromptifyIt\Contracts\Optionable;
use PromptifyIt\PromptifyIt\Data\Nodes\NodeData;

/**
 * @property ConditionNodeContentData $content
 */
class ConditionNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $left = $this->replaceWithVariables($this->content->left, $dataPiper->get());
        $operator = $this->content->operator;
        $right = $this->replaceWithVariables($this->content->right, $dataPiper->get());

        if ($operator === '==') {
            $result = $left == $right;
        } elseif ($operator === '===') {
            $result = $left === $right;
        } elseif ($operator === '!=') {
            $result = $left != $right;
        } elseif ($operator === '!==') {
            $result = $left !== $right;
        } elseif ($operator === '>') {
            $result = $left > $right;
        } elseif ($operator === '>=') {
            $result = $left >= $right;
        } elseif ($operator === '<') {
            $result = $left < $right;
        } elseif ($operator === '<=') {
            $result = $left <= $right;
        } else {
            throw new \Exception('Invalid operator');
        }

        if ($result) {
            $this->executeNodes($dataPiper);
        }
    }
}
