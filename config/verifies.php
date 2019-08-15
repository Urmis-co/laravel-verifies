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

    'sms' => [
        'provider' => 'kavenegar',
    ],

    'providers' => [

        'kavenegar' => [
            'class' => Urmis\Verifies\SmsProviders\Kavenegar::class,
            'key' => 'key',
            'sender' => '100065995',
        ],
    ],

];
