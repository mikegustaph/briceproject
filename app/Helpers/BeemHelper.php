<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('checkBeemBalance')) {
    function checkBeemBalance()
    {
        //$username = '<api_key>';
        //$password = '<secret_key>';
        $username = '472cc68d4fbc36f4';
        $password = 'ZjhiYzE5OGZiODJhNDJlYjhiZmVmMWQ4YzBlYTYxMjAyODIzY2JlYWU2MmY0ZTYzMjBlYjliNzQxY2NlZjMwMw==';
        $url = 'https://apisms.beem.africa/public/v1/vendors/balance';

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$username:$password"),
            'Content-Type' => 'application/json'
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'error' => true,
                'status' => $response->status(),
                'message' => $response->body()
            ];
        }
    }


    if (!function_exists('sendBeemSms')) {
        function sendBeemSms($message, $recipients = [])
        {
            $username = '472cc68d4fbc36f4';
            $password = 'ZjhiYzE5OGZiODJhNDJlYjhiZmVmMWQ4YzBlYTYxMjAyODIzY2JlYWU2MmY0ZTYzMjBlYjliNzQxY2NlZjMwMw==';
            $url = 'https://apisms.beem.africa/v1/send';

            $postData = [
                'source_addr' => 'INFO',
                'encoding' => 0,
                'schedule_time' => '',
                'message' => $message,
                'recipients' => []
            ];

            foreach ($recipients as $index => $number) {
                $postData['recipients'][] = [
                    'recipient_id' => $index + 1,
                    'dest_addr' => $number
                ];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode("$username:$password"),
                'Content-Type' => 'application/json'
            ])->post($url, $postData);

            if ($response->successful()) {
                return $response->json();
            } else {
                return [
                    'error' => true,
                    'status' => $response->status(),
                    'message' => $response->body()
                ];
            }
        }
    }
}
