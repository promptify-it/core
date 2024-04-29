<?php

namespace PromptifyIt\PromptifyIt\PersistentStorage;

use Illuminate\Support\Arr;
use PromptifyIt\PromptifyIt\Contracts\PersistentStorage;

class JsonPersistentStorage implements PersistentStorage
{
    protected $data = [];

    protected $loaded = false;

    protected function data(): array
    {
        if (empty($this->data)) {
            $this->data = $this->load();
        }

        return $this->data;
    }

    protected function load(): array
    {
        $data = [];

        if (file_exists($this->path())) {
            $data = json_decode(file_get_contents($this->path()), true);
        }

        $this->loaded = true;

        return $data;
    }

    protected function save(): void
    {
        if (! file_exists(dirname($this->path()))) {
            mkdir(dirname($this->path()), 0777, true);
        }

        file_put_contents($this->path(), json_encode($this->data(), JSON_PRETTY_PRINT));
    }

    /**
     * Get the value from the storage.
     */
    public function get(string $key, $default = null): mixed
    {
        return Arr::get($this->data(), $key, $default);
    }

    /**
     * Set the value to the storage.
     */
    public function set(string $key, $value): void
    {
        $data = $this->data();

        Arr::set($data, $key, $value);

        $this->save();
    }

    /**
     * Check if the key exists in the storage.
     */
    public function has(string $key): bool
    {
        return Arr::has($this->data(), $key);
    }

    /**
     * Remove the key from the storage.
     */
    public function remove(string $key): void
    {
        Arr::forget($this->data(), $key);

        $this->save();
    }

    /**
     * Clear the storage.
     */
    public function clear(): void
    {
        $this->data = [];

        $this->save();
    }

    /**
     * Get all the values from the storage.
     */
    public function all(): array
    {
        return $this->data();
    }

    /**
     * Get the path to the storage.
     */
    public function path(): string
    {
        return getenv('HOME').'/.dcli/storage.json';
    }
}

