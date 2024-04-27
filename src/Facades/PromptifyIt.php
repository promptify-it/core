<?php

namespace PromptifyIt\PromptifyIt\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PromptifyIt\PromptifyIt\PromptifyIt
 */
class PromptifyIt extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PromptifyIt\PromptifyIt\PromptifyIt::class;
    }
}
