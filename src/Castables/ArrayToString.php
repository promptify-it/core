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

        if (! is_string($value)) {
            return '';
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $this->downloadFileText($value);
        }

        return $value;
    }

    private function castLines(array $lines): string
    {
        return implode("\n", $lines);
    }

    private function downloadFileText(string $url): string
    {
        if (strpos($url, 'https') === 0) {
            return $this->getSSLPage($url);
        }

        return file_get_contents($url);
    }

    public function getSSLPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
