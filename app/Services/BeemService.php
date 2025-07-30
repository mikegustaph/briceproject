<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class BeemService
{
    protected $username = '472cc68d4fbc36f4';
    protected $password = 'ZjhiYzE5OGZiODJhNDJlYjhiZmVmMWQ4YzBlYTYxMjAyODIzY2JlYWU2MmY0ZTYzMjBlYjliNzQxY2NlZjMwMw==';
    protected $url = 'https://apisms.beem.africa/public/v1/vendors/balance';

    public function checkBalance()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$this->username:$this->password"),
            'Content-Type' => 'application/json'
        ])->get($this->url);

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
    public function sendSms($message, $dest_addr)
    {
        $url = 'https://apisms.beem.africa/v1/send';

        /*$postData = [
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
        }*/
        $postData = [
            'source_addr'   => 'FastPesa',
            'schedule_time' => '',
            'encoding'      => '0',
            'message'       => $message,
            'recipients'    => [
                [
                    'recipient_id' => 1,
                    'dest_addr' => $dest_addr
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode("$this->username:$this->password"),
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
