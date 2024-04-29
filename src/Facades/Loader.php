<?php
namespace PromptifyIt\PromptifyIt\Facades;

use Illuminate\Support\Facades\Facade;
use PromptifyIt\PromptifyIt\Contracts\Loader as LoaderContract;

/**
 * @see \PromptifyIt\PromptifyIt\Contracts\Commands\Loader
 *
 * @method static \Illuminate\Support\Collection loadCommands()
 */
class Loader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LoaderContract::class;
    }
}
