<?php

namespace PromptifyIt\PromptifyIt\Contracts;

interface DataPiper
{
    public function set(array $data): static;

    public function merge(array $data): static;

    /**
     * Get path of the pipe file.
     */
    public function pipePath(): string;

    /**
     * Merge data from pipe file and remove it.
     */
    public function mergeFromPipe(): static;

    /**
     * Get the data stored in the data piper.
     */
    public function get(): array;

    /**
     * Clear the data stored in the data piper.
     */
    public function clear(): void;
}
