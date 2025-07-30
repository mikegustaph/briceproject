<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\PayServices;
use App\Services\AzamPayAuthService;
use Illuminate\Support\Facades\Log;
use Alphaolomi\Azampay\AzampayService;
use App\Models\CollectTransactions;

class PayController extends Controller
{
    //protected PayServices $payService;
    //protected BeemController $beemController;
    protected $azampay;

    public function __construct(AzampayService $azampay)
    {
        $this->azampay = $azampay;
    }


    public function mnoCheckout(Request $request)
    {

        $data = $request->validate([
            'amount'        => 'required|numeric',
            'currency'      => 'required|string',
            'accountNumber' => 'required|string',
            'externalId'    => 'required|string',
            'provider'      => 'required|string',
            // add any other fields you require
        ]);
        try {
            $response = $this->azampay->mobileCheckout($data);

            return response()->json([
                'success' => true,
                'message' => 'Checkout initiated successfully.',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function disbursePayment(Request $request)
    {
        $validatedData = $request->validate([
            'source.countryCode' => 'required|string',
            'source.fullName'      => 'required|string',
            'source.bankName'      => 'required|string',
            'source.accountNumber' => 'required|string',
            'source.currency'      => 'required|string',

            'destination.countryCode'   => 'required|string',
            'destination.fullName'      => 'required|string',
            'destination.bankName'      => 'required|string',
            'destination.accountNumber' => 'required|string',
            'destination.currency'      => 'required|string',

            'transferDetails.type'    => 'required|string',
            'transferDetails.amount'  => 'required|numeric|min:1',
            'transferDetails.date'    => 'required|date',

            'externalReferenceId' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        try {
            $response = $this->azampay->createTransfer($validatedData);
            return response()->json([
                'status' => 'success',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function calculateChecksum(string $data, string $publicKeyPath): string
    {
        $publicKey = file_get_contents($publicKeyPath);
        $key = openssl_pkey_get_public($publicKey);

        if (!$key) {
            throw new \Exception('Invalid public key.');
        }

        $sha512 = hash('sha512', $data, true);

        $encrypted = '';
        if (!openssl_public_encrypt($sha512, $encrypted, $key, OPENSSL_PKCS1_PADDING)) {
            throw new \Exception('RSA Encryption failed.');
        }

        return base64_encode($encrypted);
    }

    // In your controller
    public function PayCallback(Request $request)
    {
        $validated = $request->validate([
            'msisdn'         => 'required|string',
            'amount'         => 'required|string',
            'message'        => 'sometimes|string',
            'utilityref'      => 'required|string',
            'operator'        => 'sometimes|string',
            'reference'        => 'required|string',
            'transactionstatus' => 'required|string',
            'submerchantAcc'   => 'required|string',
            'fspReferenceId'    => 'required| string',
            'additionalProperties' => 'sometimes|array'
        ]);

        // Process the callback - update your database, send notifications, etc.
        $transaction = CollectTransactions::where('external_id', $validated['externalId'])->first();

        if ($transaction) {
            $transaction->update([
                'status' => $validated['transactionstatus'],
                'transaction_id' => $validated['utilityref'],
                'provider_response' => json_encode($validated)
            ]);

            // Add any additional processing here
        }

        // Return success response to AzamPay
        return response()->json([
            'success' => true,
            'message' => 'Callback received successfully'
        ]);
    }
    protected function processSuccessfulPayment($transaction, $callbackData)
    {
        try {
            // Format the phone number (remove leading '+' if present)
            $phoneNumber = ltrim($callbackData['msisdn'], '+');

            // Create the SMS message
            $message = "Payment of {$callbackData['amount']} received via {$callbackData['operator']}. Ref: {$callbackData['fspReferenceId']}";

            // Create a mock request object with required parameters
            $request = new \Illuminate\Http\Request([
                'message' => $message,
                'dest_addr' => $phoneNumber
            ]);

            // Initialize BeemController
            //$beemController = new \App\Http\Controllers\BeemController();

            // Call the sendTestSms method
            //$smsResponse = $beemController->sendTestSms($request, $phoneNumber, $message);

            // If the response is a JsonResponse, get the original content
            //if ($smsResponse instanceof \Illuminate\Http\JsonResponse) {
            //    $smsResponse = $smsResponse->getData(true);
            //}

            // Log SMS sending result
            Log::info('SMS notification sent for successful payment', [
                'transaction_id' => $transaction->id,
                //'sms_response' => $smsResponse,
                'phone_number' => $phoneNumber,
                'message' => $message
            ]);

            // Update transaction with SMS notification details
            $transaction->update([
                'sms_sent' => true,
                //'sms_response' => json_encode($smsResponse),
                'sms_message' => $message,
                'sms_recipient' => $phoneNumber
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send SMS notification for successful payment', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function nameLookUp() {}
}
