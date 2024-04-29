<?php

namespace PromptifyIt\PromptifyIt\Concerns\Nodes;

trait ProvidesReplacers
{
    public $transformerGlue = '_';

    /**
     * Provide replacers for the given key and value.
     */
    public function provideReplacersFor(string $key, string $value, array &$data)
    {
        $data[$this->composeKey($key, 'upper')] = str($value)->upper()->toString();
        $data[$this->composeKey($key, 'lower')] = str($value)->lower()->toString();
        $data[$this->composeKey($key, 'camel')] = str($value)->camel()->toString();
        $data[$this->composeKey($key, 'snake')] = str($value)->snake()->toString();
        $data[$this->composeKey($key, 'kebab')] = str($value)->kebab()->toString();
        $data[$this->composeKey($key, 'studly')] = str($value)->studly()->toString();
    }

    private function composeKey(string $key, string $transformer): string
    {
        return $key.$this->transformerGlue.$transformer;
    }
}
