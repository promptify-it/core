<?php

namespace PromptifyIt\PromptifyIt;

use PromptifyIt\PromptifyIt\Commands\PromptifyItCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PromptifyItServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('promptify-it')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_promptify-it_table')
            ->hasCommand(PromptifyItCommand::class);
    }
}
