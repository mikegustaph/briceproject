<?php

return [
    'base_url'   => env('AZAMPAY_BASE_URL', 'https://sandbox.azampay.co.tz/'),
    'app_name'   => env('AZAMPAY_APP_NAME', ''),
    'client_id'   => env('AZAMPAY_CLIENT_ID'),
    'client_secret' => env('AZAMPAY_CLIENT_SECRET'),
    'auth_url'       => env('AZAMPAY_AUTH_URL'),
    'checkout_url'   => env('AZAMPAY_CHECKOUT_URL'),
    'disburse_url'   => env('AZAMPAY_DISBURSE_URL'),
    'callback_url'   => env('AZAMPAY_CALLBACK_URL'),
    //'environment'   => env('SANDBOX'),
    //'subscription_key' => env('AZAMPAY_SUBSCRIPTION_KEY'),
    //'merchant_account_number' => env('AZAMPAY_MERCHANT_ACCOUNT'),
];
