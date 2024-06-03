<?php

namespace PromptifyIt\PromptifyIt\Concerns\Nodes;

use PromptifyIt\PromptifyIt\Contracts\DataPiper;

trait ProvidesReplacers
{
    public $transformerGlue = '_';

    /**
     * Provide replacers for the given key and value.
     */
    public function provideReplacersFor(string $key, string $value, DataPiper $data)
    {
        $data->set($this->composeKey($key, 'upper'), str($value)->upper()->toString());
        $data->set($this->composeKey($key, 'lower'), str($value)->lower()->toString());
        $data->set($this->composeKey($key, 'camel'), str($value)->camel()->toString());
        $data->set($this->composeKey($key, 'snake'), str($value)->snake()->toString());
        $data->set($this->composeKey($key, 'kebab'), str($value)->kebab()->toString());
        $data->set($this->composeKey($key, 'studly'), str($value)->studly()->toString());
    }

    private function composeKey(string $key, string $transformer): string
    {
        return $key.$this->transformerGlue.$transformer;
    }
}
