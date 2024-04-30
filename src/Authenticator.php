<?php

namespace PromptifyIt\PromptifyIt;

use Exception;
use Illuminate\Support\Facades\Http;
use PromptifyIt\PromptifyIt\Contracts\Authenticator as AuthenticatorContract;
use PromptifyIt\PromptifyIt\Data\UserData;
use PromptifyIt\PromptifyIt\Facades\PersistentStorage;

class Authenticator implements AuthenticatorContract
{
    private function getUser(string $token)
    {
        return Http::withToken($token)->get(config('promptify-it.client.url').'/api/v1/user');
    }

    public function authenticate(string $token): bool
    {
        $response = $this->getUser($token);

        if ($response->status() !== 200) {
            return false;
        }

        PersistentStorage::set('token', $token);

        return true;
    }

    public function user(): UserData
    {
        $token = PersistentStorage::get('token');

        throw_if($token == null, Exception::class, 'User is not authenticated.');

        $user = $this->getUser($token);

        return new UserData(
            name: $user['name'],
            email: $user['email'],
        );
    }

    public function logout(): void
    {
        PersistentStorage::forget('token');
    }

    public function check(): bool
    {
        if (PersistentStorage::get('token') == null) {
            return false;
        }

        return true;
    }
}
