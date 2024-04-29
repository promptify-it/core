<?php

namespace PromptifyIt\PromptifyIt\Castables;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ArrayToString implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        if (is_array($value)) {
            return $this->castLines($value);
        }

        if (is_string($value)) {
            return $value;
        }

        return '';
    }

    private function castLines(array $lines): string
    {
        return implode("\n", $lines);
    }
}
