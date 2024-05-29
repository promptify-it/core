<?php

namespace PromptifyIt\PromptifyIt\DataPipers;

use Dotenv\Dotenv;

use PromptifyIt\PromptifyIt\Contracts\PersistentStorage;

/**
 * The data piper is responsible for storing the data that is being passed
 * between the nodes of the command.
 */
class DataPiper implements \PromptifyIt\PromptifyIt\Contracts\DataPiper
{
    /**
     * Each data piper has a unique id.
     * This id is used to store the data for the entire command lifecycle.
     */
    private $id;

    public function __construct(
        private string $commandId,
    ) {
        $this->id = \Illuminate\Support\Str::uuid();
    }

    /**
     * Get the instance of the persistent storage.
     */
    private function persistenceStorage(): PersistentStorage
    {
        return app(PersistentStorage::class);
    }

    /**
     * Get the path to the data piper storage.
     */
    private function persistenceStoragePath(): string
    {
        return 'commands.' . $this->commandId . '.data_piper';
    }

    public function set(array $data): static
    {
        $this->persistenceStorage()->set($this->persistenceStoragePath(), $data);

        return $this;
    }

    public function pipePath(): string
    {
        return dirname($this->persistenceStorage()->path()) . '/.' . $this->id;
    }

    public function merge(array $data): static
    {
        $this->persistenceStorage()->set(
            $this->persistenceStoragePath(),
            array_merge($this->get(), $data)
        );

        return $this;
    }

    public function mergeFromPipe(): static
    {
        $dotenv = Dotenv::parse($this->qualifyEnvContent(file_get_contents($this->pipePath())));

        $this->set([
            ...$this->get(),
            ...$dotenv,
        ]);

        unlink($this->pipePath());

        return $this;
    }

    /**
     * Some variables in the .env file may be string that contain white spaces.
     * We need to qualify the content of the .env file to avoid issues with the parser
     * wrapping the content in double quotes.
     */
    private function qualifyEnvContent(string $content): string
    {
        $lines = explode("\n", $content);

        $qualifiedContent = '';

        foreach ($lines as $line) {
            $line = trim($line);

            if (!empty($line)) {
                $splitted = explode('=', $line);

                if (count($splitted) === 2 && !is_numeric($splitted[1]) && !in_array($splitted[1], ['true', 'false'])) {
                    $qualifiedContent .= $splitted[0] . '="' . $splitted[1] . '"' . "\n";
                } else {
                    $qualifiedContent .= $line . "\n";
                }
            }
        }

        return $qualifiedContent;
    }

    public function get(): array
    {
        return $this->persistenceStorage()->get($this->persistenceStoragePath(), []);
    }

    /**
     * Clear the data stored in the data piper.
     */
    public function clear(): void
    {
        $this->persistenceStorage()->remove('commands.' . $this->commandId);
    }
}
