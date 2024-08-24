<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);
        //$this->sendSMS($phoneNumber, $otp);
        return response()->json([
            'message' => 'otp sent successfully',
            'otp' => $otp
        ]);
    }

    public function sendSMS(Request $request, $phoneNumber, $otp)
    {
        $apiKey    = env('BEEM_API_KEY');
        $secretKey = env('BEEM_SECRET_KEY');
        $phoneNumber = $request->input('phone_number');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);

        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => "Your OTP code is: $otp",
            'recipients' => [
                'recipient_id' => '1',
                'dest_addr' => $phoneNumber
            ]
        );
        $Url = 'https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$apiKey:$secretKey"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            echo $response;
            die(curl_error($ch));
        }
        var_dump($response);

        /*$response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode("$apiKey:$secretKey")
        ])->post(
            'https://apisms.beem.africa/v1/send',
            [
                'source_addr' => 'INFO',
                'schedule_time' => '',
                'encoding' => '0',
                'message' => "Your OTP code is: $otp",
                'recipients' => [
                    [
                        'recipient_id' => '1',
                        'dest_addr' => $phoneNumber,
                    ],
                ],
            ]
        );

        if ($response->failed()) {
            throw new \Exception('Failed to send OTP: ' . $response->body());
        }*/
        /*$apiKey    = env('BEEM_API_KEY');
        $secretKey = env('BEEM_SECRET_KEY');

        $response = Http::withHeader([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode("$apiKey:$secretKey")
        ])->post('https://apisms.beem.africa/v1/send', [
            'source_addr' => 'INFO',
            'schedule_time' => '',
            'encoding' => '0',
            'message' => "Your OTP code is: $otp",
            'recipients' => [
                [
                    'recipient_id' => '1',
                    'dest_addr' => $phoneNumber,
                ],
            ],
        ]);
        if ($response->failed()) {
            throw new \Exception('Failed to send OTP: ' . $response->body());
        }*/
    }
    public function testOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        return response()->json($phoneNumber);
    }
    public function sendOtpNow(Request $request)
    {
        $apiKey = env('BEEM_API_KEY');
        $secretKey = env('BEEM_SECRET_KEY');
        $phoneNumber = $request->input('phone_number');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);

        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => "Your OTP code is: $otp",
            'recipients' => [
                [
                    'recipient_id' => '1',
                    'dest_addr' => $phoneNumber
                ]
            ]
        );
        $url = 'https://apisms.beem.africa/v1/send';

        $ch = curl_init($url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode("$apiKey:$secretKey"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            die('cURL Error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP', 'response' => $response]);
        }
    }
}
