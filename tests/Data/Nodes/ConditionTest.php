<?php

it('can instanciate', function () {
    $commandOptionsData = PromptifyIt\PromptifyIt\Data\Nodes\Condition\ConditionNodeData::from([
        'content' => [
            'left' => 'value',
            'operator' => '==',
            'right' => 'false',
        ]
    ]);

    expect($commandOptionsData)->toBeInstanceOf(PromptifyIt\PromptifyIt\Data\Nodes\Condition\ConditionNodeData::class);

    expect($commandOptionsData->content->left)->toBe('value');
    expect($commandOptionsData->content->operator)->toBe('==');
    expect($commandOptionsData->content->right)->toBe('false');
});
