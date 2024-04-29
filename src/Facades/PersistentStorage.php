<?php

namespace PromptifyIt\PromptifyIt\Facades;

use Illuminate\Support\Facades\Facade;
use PromptifyIt\PromptifyIt\Contracts\PersistentStorage as PersistentStorageContract;

/**
 * @see \PromptifyIt\PromptifyIt\PersistentStorage
 *
 * @method static void set(string $key, $value)
 * @method static mixed get(string $key, $default = null)
 * @method static bool has(string $key)
 * @method static void remove(string $key)
 * @method static void clear()
 * @method static array all()
 * @method static string path()
 */
class PersistentStorage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PersistentStorageContract::class;
    }
}
