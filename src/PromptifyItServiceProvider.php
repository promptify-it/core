<?php

namespace PromptifyIt\PromptifyIt;

use PromptifyIt\PromptifyIt\PersistentStorage\JsonPersistentStorage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PromptifyItServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('promptify-it')
            ->hasConfigFile();
    }

    /**
     * Register the package services.
     */
    public function registeringPackage()
    {
        $this
            ->bindLoader()
            ->bindPersistentStorage()
            ->bindNodesUsingType();
    }

    /**
     * Bind the loader.
     */
    public function bindLoader(): self
    {
        $this->app->bind(Contracts\Loader::class, Loaders\RemoteLoader::class);

        return $this;
    }

    /**
     * Bind the persistent storage.
     */
    public function bindPersistentStorage(): self
    {
        $this->app->singleton(Contracts\PersistentStorage::class, JsonPersistentStorage::class);

        return $this;
    }

    public function bindNodesUsingType(): self
    {
        $nodeClasses = $this->autoloadNodes();

        $this->app->bind('promptify-it.nodes', fn () => $nodeClasses);

        return $this;
    }

    /**
     * Autoload the nodes scanning recursively the nodes directory.
     */
    private function autoloadNodes(): array
    {
        $nodes = [];

        $directory = __DIR__ . '/Data/Nodes';

        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (is_file($directory . '/' . $file)) {
                continue;
            }

            $nodes[str($file)->camel()->toString()] = [
                'nodeData' => 'PromptifyIt\\PromptifyIt\\Data\\Nodes\\' . $file . '\\' . $file . 'NodeData',
                'nodeContentData' => 'PromptifyIt\\PromptifyIt\\Data\\Nodes\\' . $file . '\\' . $file . 'NodeContentData',
            ];
        }

        return $nodes;
    }
}
