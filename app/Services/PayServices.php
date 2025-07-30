<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PayServices
{
    protected string $environment;
    protected string $appName;
    protected string $clientId;
    protected string $clientSecret;
    protected ?string $authToken = null;

    public function __construct()
    {
        $this->environment = config('services.azampay.environment', 'sandbox');
        $this->appName = config('services.azampay.app_name');
        $this->clientId = config('services.azampay.client_id');
        $this->clientSecret = config('services.azampay.client_secret');
    }

    protected function getAuthUrl(): string
    {
        return $this->environment === 'production'
            ? 'https://authenticator.azampay.co.tz'
            : 'https://authenticator-sandbox.azampay.co.tz';
    }

    protected function getBaseUrl(): string
    {
        return $this->environment === 'production'
            ? 'https://api.azampay.co.tz'
            : 'https://sandbox.azampay.co.tz';
    }

    public function generateToken(): ?string
    {
        try {
            $url = $this->getAuthUrl() . '/AppRegistration/GenerateToken';

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'appName' => $this->appName,
                'clientId' => $this->clientId,
                'clientSecret' => $this->clientSecret,
            ]);

            if ($response->successful() && isset($response['data']['accessToken'])) {
                $this->authToken = $response['data']['accessToken'];
                return $this->authToken;
            }

            Log::error('[AzamPay] Token generation failed', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error('[AzamPay] Exception during token generation', [
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }


    /*public function mnoPayCheckout($accountNumber, $amount, $currency, $provider, $externalId, array $additionalProperties = []): ?array
    {
        try {
            if (!$this->authToken) {
                $this->generateToken();
            }

            if (!$this->authToken) {
                Log::error('AzamPay MNO Checkout Aborted: Token generation failed.');
                return null;
            }

            //$url = $this->getBaseUrl() . '/azampay/mno/checkout';
            $mnoUrl = 'https://sandbox.azampay.co.tz/azampay/mno/checkout';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer Token' . $this->authToken,
                'Content-Type' => 'application/json',
            ])->post($mnoUrl, [
                'accountNumber'        => $accountNumber,
                'amount'               => $amount,
                'currency'             => $currency,
                'externalId'           => $externalId,
                'provider'             => $provider,
                'additionalProperties' => $additionalProperties
            ]);

            if ($response->successful() && isset($response['transactionId'])) {
                return $response->json();
            }

            Log::error('AzamPay MNO Checkout Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('AzamPay MNO Checkout Exception: ' . $e->getMessage());
            return null;
        }
    }*/
    public function mnoPayCheckout($accountNumber, $amount, $currency, $provider, $externalId, array $additionalProperties = []): ?array
    {
        try {
            if (!$this->authToken) {
                $this->generateToken();
            }

            if (!$this->authToken) {
                Log::error('AzamPay MNO Checkout Aborted: Token generation failed.');
                return null;
            }
            $url = $this->getBaseUrl() . '/azampay/mno/checkout';
            //$mnoUrl = 'https://sandbox.azampay.co.tz/azampay/mno/checkout';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken, // Fixed space after 'Bearer'
                'Content-Type' => 'application/json',
            ])->post($url, [
                'accountNumber'        => $accountNumber,
                'amount'               => $amount,
                'currency'             => $currency,
                'externalId'           => $externalId,
                'provider'             => $provider,
                'additionalProperties' => $additionalProperties
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                // Ensure we have the expected response format
                return [
                    'transactionId' => $responseData['transactionId'] ?? null,
                    'message' => $responseData['message'] ?? 'Transaction initiated',
                    'success' => isset($responseData['transactionId'])
                ];
            }

            Log::error('AzamPay MNO Checkout Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('AzamPay MNO Checkout Exception: ' . $e->getMessage());
            return null;
        }
    }


    public function disbursePayment(array $payload): ?array
    {
        try {
            if (!$this->authToken) {
                $this->generateToken();
            }

            if (!$this->authToken) {
                Log::error('AzamPay Disbursement Aborted: Token generation failed.');
                return null;
            }

            $url = $this->environment === 'production'
                ? 'https://api-disbursement.azampay.co.tz/api/v1/azampay/disburse'
                : 'https://api-disbursement-sandbox.azampay.co.tz/api/v1/azampay/disburse';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('AzamPay Disbursement Failed: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('AzamPay Disbursement Exception: ' . $e->getMessage());
            return null;
        }
    }
}
