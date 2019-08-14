<?php

return [

    'code' => [

        'generator' => 'numeric',

        'generators' => [

            'numeric' => [
                'class' => Urmis\Verifies\Generators\NumericCodeGenerator::class,
                'length' => 5,
            ],

        ],
    ],

];
