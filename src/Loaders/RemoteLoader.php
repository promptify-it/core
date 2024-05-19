<?php

namespace PromptifyIt\PromptifyIt\Loaders;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PromptifyIt\PromptifyIt\Contracts\Loader;
use PromptifyIt\PromptifyIt\Data\CommandData;
use PromptifyIt\PromptifyIt\Facades\PersistentStorage;

class RemoteLoader implements Loader
{
    public function loadCommands(): Collection
    {
        $token = PersistentStorage::get('token');

        if (! $token) {
            return collect([]);
        }

        $response = Http::withToken($token)
            ->acceptJson()
            ->get('http://dcli-web.test/api/v1/commands');

        if ($response->json() == null) {
            return collect([]);
        }

        return collect($response->json())->map(function ($command) {
            return CommandData::from($command);
        });
    }
}
