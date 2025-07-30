<?php

return
    [
        'beem' => [
            'api_key'         => env('BEEM_API_KEY'),
            'secret'          => env('BEEM_SECRET'),
            'sender_id'        => env('BEEM_SENDER_ID'),
            'sms_endpoint'     => env('BEEM_SMS_ENDPOINT'),
            'balance_endpoint' => env('BALANCE_ENDPOINT')
        ],
    ];
