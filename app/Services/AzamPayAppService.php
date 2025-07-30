<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AzamPayAppService
{
    /**
     * Obtain a new access token from AzamPay.
     */
    protected function getToken(): string
    {
        $authUrl = env('AZAMPAY_AUTH_URL');
        $response = Http::post($authUrl, [
            'appName'      => env('AZAMPAY_APP_NAME'),
            'clientId'     => env('AZAMPAY_CLIENT_ID'),
            'clientSecret' => env('AZAMPAY_CLIENT_SECRET'),
        ]);

        if ($response->successful()) {
            $data = $response->json('data');
            return $data['accessToken'];
        }
        throw new \Exception('AzamPay token request failed: ' . $response->body());
    }

    /**
     * Initiate a mobile money checkout (collection).
     * Example providers: "TIGO", "AIRTEL", etc. (Currency is TZS by default.)
     */
    public function initiateMNOCheckout(string $mobile, float $amount, string $externalId, string $provider)
    {
        $token = $this->getToken();
        $url = env('AZAMPAY_BASE_URL') . '/azampay/mno/checkout';
        $body = [
            'accountNumber'      => $mobile,
            'amount'             => $amount,
            'currency'           => 'TZS',
            'externalId'         => $externalId,
            'provider'           => $provider,
            'additionalProperties' => null,
        ];
        $headers = [
            'Authorization' => "Bearer {$token}",
            'X-API-KEY'     => env('AZAMPAY_CLIENT_ID'),
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ];
        return Http::withHeaders($headers)->post($url, $body)->json();
    }

    /**
     * Initiate a bank checkout (collection) with OTP.
     * Example providers: "CRDB", "NMB" (Currency is TZS by default.)
     */
    public function initiateBankCheckout(string $accountNumber, string $mobileNumber, float $amount, string $otp, string $provider)
    {
        $token = $this->getToken();
        $url = env('AZAMPAY_BASE_URL') . '/azampay/bank/checkout';
        $body = [
            'merchantAccountNumber' => $accountNumber,
            'merchantMobileNumber'  => $mobileNumber,
            'amount'                => number_format($amount, 2, '.', ''),
            'currencyCode'          => 'TZS',
            'otp'                   => $otp,
            'provider'              => $provider,
            'referenceId'           => substr(uniqid(), 0, 20),
            'additionalProperties'  => null,
        ];
        $headers = [
            'Authorization' => "Bearer {$token}",
            'X-API-KEY'     => env('AZAMPAY_CLIENT_ID'),
        ];
        return Http::withHeaders($headers)->post($url, $body)->json();
    }

    /**
     * Create a disbursement/payout (transfer).
     * $data should include 'source', 'destination', 'transferDetails', 'externalReferenceId', 'remarks'.
     */
    public function createTransfer(array $data)
    {
        $token = $this->getToken();
        $url = env('AZAMPAY_BASE_URL') . '/azampay/createtransfer';
        $headers = [
            'Authorization' => "Bearer {$token}",
            'X-API-KEY'     => env('AZAMPAY_CLIENT_ID'),
        ];
        return Http::withHeaders($headers)->post($url, $data)->json();
    }
}
