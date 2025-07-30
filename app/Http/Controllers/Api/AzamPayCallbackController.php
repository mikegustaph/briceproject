<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AzamPayCallbackController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Verify the request is POST
        if (!$request->isMethod('POST')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        // Get the payload data
        $payload = $request->all();

        // Validate required fields
        if (!isset($payload['utilityref']) || !isset($payload['transactionstatus'])) {
            return response()->json(['error' => 'Invalid callback data'], 400);
        }

        // Find the transaction
        $transaction = Transaction::where('reference', $payload['utilityref'])
            ->where('status', 'pending')
            ->first();

        if (!$transaction) {
            Log::error('Transaction not found or not pending', ['reference' => $payload['utilityref']]);
            return response()->json(['error' => 'Transaction not found or not pending'], 404);
        }

        // Update transaction status
        $status = ($payload['transactionstatus'] == "success") ? "success" : "rejected";
        $transaction->status = $status;
        $transaction->save();

        // Send SMS notification
        try {
            $this->sendPaymentStatusSms(
                $transaction->phone_number,
                $transaction->first_name,
                $status,
                $transaction->reference
            );
        } catch (\Exception $e) {
            Log::error('Failed to send payment status SMS', [
                'reference' => $payload['utilityref'],
                'error' => $e->getMessage()
            ]);
        }

        return response()->json(['message' => 'Updated successfully']);
    }

    protected function sendPaymentStatusSms($phoneNumber, $firstName, $status, $reference)
    {
        // Implement your SMS gateway integration here
        $message = "Hello $firstName, your payment (Ref: $reference) was $status. " .
            ($status == 'success' ? "Thank you!" : "Please try again.");

        // Example using a hypothetical SMS service
        // $smsService = app()->make(SmsService::class);
        // $smsService->send($phoneNumber, $message);

        // For now, just log the SMS that would be sent
        Log::info("SMS would be sent to $phoneNumber: $message");

        return true;
    }
}
