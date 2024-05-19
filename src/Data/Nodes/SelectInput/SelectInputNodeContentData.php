<?php

namespace PromptifyIt\PromptifyIt\Data\Nodes\SelectInput;

use Spatie\LaravelData\Data;

class SelectInputNodeContentData extends Data
{
    public function __construct(
        public string $key,
        public string $label,
        public array $options,
        public null|int|string $default = null,
        public int $scroll = 5,
        public mixed $validate = null,
        public string $hint = '',
        public bool|string $required = true
    ) {
        //
    }
}
