<?php

it('can instanciate', function () {
    $commandOptionsData = PromptifyIt\PromptifyIt\Data\Nodes\Assign\AssignNodeData::from([
        'content' => [
            'key' => 'key',
            'value' => 'value',
        ]
    ]);

    expect($commandOptionsData)->toBeInstanceOf(PromptifyIt\PromptifyIt\Data\Nodes\Assign\AssignNodeData::class);

    expect($commandOptionsData->content->key)->toBe('key');
    expect($commandOptionsData->content->value)->toBe('value');
});
