<?php

return [

    'max_tries' => 3,
    'expires_in' => 120,

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
            'key' => env('KAVENEGAR_KEY'),
            'sender' => env('KAVENEGAR_SENDER'),
            'verify_lookup' => [
                'enabled' => false,
                'template' => '',
            ],
        ],

        'farazsms' => [
            'class' => Urmis\Verifies\SmsProviders\FarazSms::class,
            'uname' => env('FARAZSMS_UNAME'),
            'pass' => env('FARAZSMS_PASS'),
            'from' => env('FARAZSMS_FROM'),
            // TODO: 'pattern_code'
        ],
    ],

];
