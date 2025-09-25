<?php

return [
    'environment' => env('PAGSEGURO_ENVIRONMENT', 'sandbox'),
    'email' => env('PAGSEGURO_EMAIL'),
    'token' => env('PAGSEGURO_TOKEN'),
    'sandbox' => [
        'email' => env('PAGSEGURO_SANDBOX_EMAIL'),
        'token' => env('PAGSEGURO_SANDBOX_TOKEN'),
    ],
    'currency' => 'BRL',
    'reference' => null,
];
