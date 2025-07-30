<?php
// app/Services/AzamPayAuthService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AzamPayAuthService
{
    protected $environment;
    protected $appName;
    protected $clientId;
    protected $clientSecret;
    protected $authToken;

    public function __construct()
    {
        $this->environment = config('services.environment');
        $this->appName = config('services.app_name');
        $this->clientId = config('services.client_id');
        $this->clientSecret = config('services.client_secret');
    }

    protected function getBaseUrls()
    {
        if ($this->environment === "production") {
            return [
                'auth_url' => 'https://authenticator.azampay.co.tz',
                'checkout_url' => 'https://checkout.azampay.co.tz'
            ];
        }

        return [
            'auth_url' => 'https://authenticator-sandbox.azampay.co.tz',
            'checkout_url' => 'https://sandbox.azampay.co.tz'
        ];
    }

    public function generateAuthToken()
    {
        try {
            $urls = $this->getBaseUrls();
            $response = Http::withHeaders([
                'Content-Type' => 'Application/json',
            ])->post($urls['auth_url'] . '/AppRegistration/GenerateToken', [
                'appName' => $this->appName,
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret
            ]);

            if ($response->successful()) {
                $this->authToken = $response->json()['data']['accessToken'];
                return $this->authToken;
            }

            Log::error('AzamPay Auth Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('AzamPay Auth Exception: ' . $e->getMessage());
            return null;
        }
    }

    public function mnoCheckout($accountNumber, $amount, $currency, $provider, $externalId, $additionalProperties = [])
    {
        try {
            if (!$this->authToken) {
                $this->generateAuthToken();
            }
            $urls = $this->getBaseUrls();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
                'Content-Type' => 'application/json',
            ])->post($urls['checkout_url'] . '/azampay/mno/checkout', [

                'accountNumber'        => $accountNumber,
                'amount'               => $amount,
                'currency'             => $currency,
                'externalId'           => $externalId,
                'provider'             => $provider,
                'additionalProperties' => $additionalProperties
            ]);

            if ($response->successful()) {
                return [
                    'data' => $response->json(),
                    'externalId' => $externalId
                ];
            }

            Log::error('AzamPay MNO Checkout Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('AzamPay MNO Checkout Exception: ' . $e->getMessage());
            return null;
        }
    }
    public function disburse($source, $accountNumber, $amount, $currency, $provider, $externalId, $additionalProperties = [])
    {
        try {
            if (!$this->authToken) {
                $this->generateAuthToken();
            }

            $urls = $this->getBaseUrls();
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
                'Content-Type' => 'application/json',
            ])->post($urls['disburse_url'], [
                //'source' => $source,
                'accountNumber' => $accountNumber,
                'amount' => $amount,
                'currency' => $currency,
                'provider' => $provider,
                'externalId' => $externalId,
                'callbackUrl' => config('azampay.callback_url'),
                'additionalProperties' => $additionalProperties
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data'    => $response->json(),
                    'externalId' => $externalId
                ];
            }

            Log::error('AzamPay Disbursement Failed: ' . $response->body());
            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'Disbursement failed',
                'status' => $response->status()
            ];
        } catch (\Exception $e) {
            Log::error('AzamPay Disbursement Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
