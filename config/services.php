<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'azampay' => [
        'app_name'       => env('AZAMPAY_APP_NAME'),
        'client_id'      => env('AZAMPAY_CLIENT_ID'),
        'client_secret'  => env('AZAMPAY_CLIENT_SECRET'),
        'auth_url'       => env('AZAMPAY_AUTH_URL'),
        'checkout_url'   => env('AZAMPAY_CHECKOUT_URL'),
        'disburse_url'   => env('AZAMPAY_DISBURSE_URL'),
        'callback_url'   => env('AZAMPAY_CALLBACK_URL'),
        'environment'    => env('AZAMPAY_ENVIRONMENT')
    ],
    'beem' => [
        'api_key'          => env('BEEM_API_KEY'),
        'secret'           => env('BEEM_SECRET'),
        'sender_id'        => env('BEEM_SENDER_ID'),
        'sms_endpoint'     => env('BEEM_SMS_ENDPOINT'),
        'balance_endpoint' => env('BALANCE_ENDPOINT')
    ],
];
