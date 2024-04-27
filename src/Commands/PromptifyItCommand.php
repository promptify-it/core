<?php

namespace PromptifyIt\PromptifyIt\Commands;

use Illuminate\Console\Command;

class PromptifyItCommand extends Command
{
    public $signature = 'promptify-it';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
