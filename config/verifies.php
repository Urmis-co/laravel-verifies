<?php

return [

    'secret' => [
        'generator' => 'simple',

        'generators' => [

            'simple' => [
                'class' => Urmis\Verifies\Generators\SimpleSecretGenerator::class,
                'length' => 36,
            ],
        ],
    ],

    'code' => [
        'generator' => 'numeric',

        'generators' => [

            'numeric' => [
                'class' => Urmis\Verifies\Generators\NumericCodeGenerator::class,
                'length' => 6,
            ],

        ],
    ],

];
