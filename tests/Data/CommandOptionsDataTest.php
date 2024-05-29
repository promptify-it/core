<?php

it('can instanciate', function () {
    $commandOptionsData = PromptifyIt\PromptifyIt\Data\CommandOptionsData::from([]);

    expect($commandOptionsData)->toBeInstanceOf(PromptifyIt\PromptifyIt\Data\CommandOptionsData::class);
});

it('can instanciate with shouldLoadDotenv', function () {
    $commandOptionsData = PromptifyIt\PromptifyIt\Data\CommandOptionsData::from([
        'shouldLoadDotenv' => false
    ]);

    expect($commandOptionsData->shouldLoadDotenv)->toBeFalse();
});
