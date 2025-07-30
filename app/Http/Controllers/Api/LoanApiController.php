<?php

namespace App\Http\Controllers\Api;

use Alphaolomi\Azampay\AzampayService;
use App\Helpers\DetermineProviderHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PayController;
use App\Models\AppSettings;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanSetting;
use App\Models\Repay_Loan;
use App\Models\Transaction;
use App\Models\TransferTransaction;
use Exception;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class LoanApiController extends Controller
{
    ///Fetch loan Setting
    public function settheLoan()
    {
        try {
            $settings = LoanSetting::first();
            return response()->json([
                'status' => 'success',
                'interest'  => $settings->interest_rate,
                'service_charge' => $settings->service_charge,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    ///Check user credit score
    ///public function checkCreditScore(Request $request) {}
    /*public function checkCreditScore(Request $request)
    {
        // Validate the phone number format
        $request->validate([
            'phone' => 'required|string', // Validate phone number format
        ]);
        // Retrieve and normalize the phone number
        $phone = $request->input('phone');
        // Ensure the phone number starts with +255
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0'); // Remove leading zero if present
        }
        // Find the customer by phone number
        $customer = Customer::where('phone', $phone)->first();
        // Check if customer exists and return appropriate response
        if ($customer) {
            return response()->json([
                'status'        => 'success',
                'message'       => 'Credit score retrieved successfully.',
                'credit_score'  => $customer->credit_score,
            ], 200);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }
    }*/
    ///Fetch the customer to server
    public function fetchCustomer(Request $request)
    {
        try {
            $phone = $request->input('phone');
            if (!str_starts_with($phone, '+255')) {
                $phone = '+255' . ltrim($phone, '0'); // Normalize phone format
            }
            $customer = Customer::where('phone', $phone)->first();


            if (!$customer) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Customer not found',
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'data' => [
                    'name'  => $customer->first_name . ' ' . $customer->last_name,
                    'phone' => $customer->phone,
                    'customer_image' => $customer->image,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    ///Fetch the customer person information
    public function checkCustomerInfo(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $phone = $request->input('phone');
            if (!str_starts_with($phone, '+255')) {
                $phone = '+255' . ltrim($phone, '0'); // Normalize phone format
            }

            $customer = Customer::where('phone', $phone)->first();

            if (!$customer) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Customer not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'fname'           => $customer->first_name,
                    'lname'           => $customer->last_name,
                    'nida'            => $customer->nida_number,
                    'email'           => $customer->email,
                    'phone'           => $customer->phone,
                    'gender'          => $customer->sex,
                    'occupation'      => $customer->Occupation,
                    'address'         => $customer->Address, // Updated to match conventions
                    'customer_image'  => url($customer->image), // Full URL
                ],
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error fetching customer: ', ['exception' => $e]);
            return response()->json([
                'status'  => 'error',
                'message' => 'An internal server error occurred.',
            ], 500);
        }
    }

    public function checkCreditScore(Request $request)
    {
        // Validate the phone number format
        $request->validate([
            'phone' => 'required|string',
        ]);
        // Retrieve and normalize the phone number
        $phone = $request->input('phone');
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0'); // Normalize phone format
        }
        // Find the customer by phone number
        $customer = Customer::where('phone', $phone)->first();
        // Check if customer exists
        if (!$customer) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }
        // Get the customer's credit score
        $creditScore = $customer->credit_score;
        $loanDetails = $this->calculateLoanDetails($creditScore);
        return response()->json([
            'status'       => 'success',
            'message'      => 'Credit score and loan details retrieved successfully.',
            'credit_score' => $creditScore,
            'loan_amount'  => $loanDetails['loanAmount'],
            'loan_terms'   => $loanDetails['loanTerms'],
        ], 200);
    }
    private function calculateLoanDetails(float $creditScore): array
    {
        // Define credit score ranges and loan details
        $loanData = [
            ['minScore' => 0.0, 'maxScore' => 0.99, 'loanAmount' => '20,000', 'loanTerms' => '7'],
            ['minScore' => 1.0, 'maxScore' => 1.99, 'loanAmount' => '49,000', 'loanTerms' => '7'],
            ['minScore' => 2.0, 'maxScore' => 2.99, 'loanAmount' => '69,000', 'loanTerms' => '7'],
        ];

        // Find the matching loan details
        foreach ($loanData as $data) {
            if ($creditScore >= $data['minScore'] && $creditScore <= $data['maxScore']) {
                return [
                    'loanAmount' => $data['loanAmount'],
                    'loanTerms'  => $data['loanTerms'],
                ];
            }
        }

        // Return default response if no match is found
        return [
            'loanAmount' => '0',
            'loanTerms'  => 0,
        ];
    }
    /// Add Customer Personal Information
    /*public function AddUserCustomerInfo(Request $request)
    {
        $phone = $request->input('phone');
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0'); // Normalize phone format
        }
        try {
            $customer = Customer::where('phone', $phone)->first();
            if (!$customer) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Customer not found',
                ], 404);
            }
            $customer->update([
                'first_name'        => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'email'             => $request->input('email'),
                'nida_number'       => $request->input('nida'),
                'sex'               => $request->input('gender'),
                'occupation'        => $request->input('occupation'),
                'referee_one_name'  => $request->input('referee_one_name'),
                'referee_one_phone' => $request->input('referee_one_phone'),
                'referee_two_name'  => $request->input('referee_two_name'),
                'referee_two_phone' => $request->input('referee_two_phone'),
                'status'            => 'Registered',
            ]);
            return response()->json([
                'status'  => 'success',
                'message' => 'Personal information added successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }*/
    public function AddUserCustomerInfo(Request $request)
    {
        $phone = $request->input('phone');
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0');
        }

        try {
            $customer = Customer::where('phone', $phone)->first();
            if (!$customer) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Customer not found',
                ], 404);
            }

            // Handle profile image if uploaded
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('public/profile_images', $fileName); // stored in storage/app/public/profile_images

                // Save relative path (remove "public/")
                $profileImagePath = str_replace('public/', 'storage/', $filePath);
            } else {
                $profileImagePath = $customer->profile_image; // retain old image if not uploaded
            }

            $customer->update([
                'first_name'        => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'email'             => $request->input('email'),
                'nida_number'       => $request->input('nida'),
                'sex'               => $request->input('gender'),
                'occupation'        => $request->input('occupation'),
                'referee_one_name'  => $request->input('referee_one_name'),
                'referee_one_phone' => $request->input('referee_one_phone'),
                'referee_two_name'  => $request->input('referee_two_name'),
                'referee_two_phone' => $request->input('referee_two_phone'),
                'status'            => 'Registered',
                'profile_image'     => $profileImagePath,
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Personal information added successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /// Check Customer
    public function checkUser(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);
        $phone = $request->input('phone');
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0'); // Replace leading 0 with +255
        }
        $user = Customer::where('phone', $phone)->first();
        if ($user) {
            return response()->json([
                'status'  => $user->status,
                'message' => 'User found',
            ], 200);
        } else {
            return response()->json([
                'status'  => 'Not Registered',
                'message' => 'User not found',
            ], 404);
        }
    }
    ///Login Customer
    public function appLoginByPhone(Request $request)
    {
        // Validate phone number
        $request->validate([
            'phoneNumber' => 'required', // Ensure numeric and within valid range
        ]);
        $phone = $request->input('phoneNumber');

        $customer = Customer::where('phone', $phone)->first();
        if ($customer) {
            return response()->json([
                'message' => 'exists',
                'phone'   => $customer->phone,
            ], 200);
        }
        try {
            $newCustomer = Customer::create(['phone' => $phone]);
            return response()->json([
                'message' => 'success',
                'phone'   => $newCustomer->phone,
            ], 200);
        } catch (\Exception $e) {
            // Handle database or other errors
            return response()->json([
                'message' => 'Error creating customer: ' . $e->getMessage(),
            ], 500);
        }
    }
    ///Store Loan
    public function storeNewLoan(Request $request)
    {
        $validated = $request->validate([
            'phone'           => 'required',
            'principal'       => 'required|numeric',
            'total_repay'     => 'required|numeric',
            'interest_rate'   => 'required|numeric',
            'number_of_days'  => 'required|integer',
            'service_charge'  => 'required|numeric',
            'wallet_type'     => 'required',
            'provider'        => 'required'
        ]);
        try {
            $serviceChargeSetting = LoanSetting::firstOrFail();

            // Normalize phone number
            $rawPhone = $validated['phone'];
            $phone = str_starts_with($rawPhone, '+255') ? $rawPhone : '+255' . ltrim($rawPhone, '0');
            $accountNumber = $phone;

            // Check if customer exists
            $customer = Customer::where('phone', $phone)->first();
            if (!$customer) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Customer with the given phone number does not exist.'
                ], 404);
            }

            // Calculate disbursable amount
            $principal = $validated['principal'];
            $serviceChargePercent = $serviceChargeSetting->service_charge;
            $receiveAmount = $principal * (1 - ($serviceChargePercent / 100));
            $externalId = 'TZX-' . strtoupper(Str::random(10));

            DB::beginTransaction();

            // Store loan
            $newLoan = Loan::create([
                'customer_id'     => $customer->id,
                'principal'       => $principal,
                'total_repay'     => $validated['total_repay'],
                'interest_rate'   => $validated['interest_rate'],
                'number_of_days'  => $validated['number_of_days'],
                'service_charge'  => $validated['service_charge'],
                'wallet_type'     => $validated['wallet_type'],
                'status'          => 'pending',
            ]);

            // Create transaction record
            $transaction = TransferTransaction::create([
                'loan_id'               => $newLoan->id,
                'accountNumber'         => $accountNumber,
                'amount'                => $receiveAmount,
                'currency'              => 'TZS',
                'externalId'            => $externalId,
                'provider'              => $validated['provider'],
                'additional_properties' => null,
                'status'                => 'initiated',
            ]);
            $fullName = $customer->first_name . ' ' . $customer->last_name;
            // Disburse payment
            $payload = [
                "source" => [
                    "countryCode"    => "TZ",
                    "fullName"       => "Michael Gustaph",
                    "bankName"       => "Tigo",
                    "accountNumber"  => "065122491",
                    "currency"       => "TZS"
                ],
                "destination" => [
                    "countryCode"    => "TZ",
                    "fullName"       => $fullName,
                    "bankName"       => "Tigo",
                    "accountNumber"  => $accountNumber,
                    "currency"       => "TZS"
                ],
                "transferDetails" => [
                    "type"           => "wallet_transfer",
                    "amount"         => $receiveAmount,
                    "date"           => now()->toDateString()
                ],
                "externalReferenceId" => $externalId,
                "remarks"             => "Loan disbursement"
            ];

            $disbursementResponse = app(PayController::class)->disbursePayment(new Request($payload));
            if ($disbursementResponse->getStatusCode() !== 200) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Loan created but disbursement failed.',
                    'details' => $disbursementResponse->getData(true)
                ], 500);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Loan created and disbursed successfully.',
                'loan_id' => $newLoan->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing loan: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'An error occurred while processing the loan. ' . $e->getMessage()
            ], 500);
        }
    }

    public function approveLoan() {}

    // routes/api.php or relevant controller file

    public function checkLoanStatusByPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->input('phone');

        // Normalize phone number to +255 format
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0');
        }

        $user = Customer::where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'status'  => 'New',
                'message' => 'User is not Registered!',
            ], 404);
        }

        $loan = Loan::where('customer_id', $user->id)->latest()->first();

        if (!$loan) {
            return response()->json([
                'status'  => 'Inactive',
                'message' => 'The client does not have any active loan.',
            ], 200);
        }

        $today = now();
        $repayDate = $loan->created_at->copy()->addDays($loan->number_of_days);
        $amount = $loan->total_repay;
        $principal = $loan->principal;

        // Credit Score
        $creditScore = $user->credit_score ?? 0.0;

        $scoreRange = '';
        $eligibleAmount = null;
        $loanTerms = '';

        if ($creditScore >= 0.0 && $creditScore < 0.5) {
            $scoreRange = '0.0 - 0.49';
            $eligibleAmount = 20000;
            $loanTerms = 7;
        } elseif ($creditScore >= 0.5 && $creditScore < 1.0) {
            $scoreRange = '0.5 - 0.99';
            $eligibleAmount = 30000;
            $loanTerms = 7;
        } elseif ($creditScore >= 1.0 && $creditScore < 1.5) {
            $scoreRange = '1.0 - 1.49';
            $eligibleAmount = 40000;
            $loanTerms = 7;
        } elseif ($creditScore >= 1.5 && $creditScore < 2.0) {
            $scoreRange = '1.5 - 1.99';
            $eligibleAmount = 60000;
            $loanTerms = 14;
        } elseif ($creditScore >= 2.0 && $creditScore < 2.5) {
            $scoreRange = '2.0 - 2.49';
            $eligibleAmount = 80000;
        } else {
            $scoreRange = '2.5+';
            $eligibleAmount = 100000;
        }

        // Loan already paid
        if ($loan->status === 'paid') {
            return response()->json([
                'status'         => 'Paid',
                'message'        => 'The loan has been paid.',
                'repay_date'     => $repayDate->format('d/m/Y'),
                'amount'         => $amount,
                'credit_score'   => $creditScore,
                'score_range'    => $scoreRange,
                'eligible_amounts' => $eligibleAmount,
            ], 200);
        }

        // Check if overdue
        if ($today->gt($repayDate)) {
            $overdueDays = $today->diffInDays($repayDate);
            $penaltyRate = 0.02; // 2% per day
            $penalty = $principal * $penaltyRate * $overdueDays;

            // Save penalty
            $loan->penalty_amount = $penalty;
            $loan->save();

            return response()->json([
                'status'           => 'Overdue',
                'message'          => "The loan is overdue by {$overdueDays} days.",
                'repay_date'       => $repayDate->format('d/m/Y'),
                'principal'        => $amount,
                'penalty'          => number_format($penalty, 2),
                'amount'           => number_format($amount + $penalty, 2),
                'overdue_days'     => $overdueDays,
                'credit_score'     => $creditScore,
                //'score_range'      => $scoreRange,
                //'eligible_amounts' => $eligibleAmounts,
            ], 200);
        }

        // Loan still pending
        return response()->json([
            'status'          => 'Pending',
            'message'         => 'The loan is still within the repayment period.',
            'repay_date'      => $repayDate->format('d/m/Y'),
            'amount'          => $amount,
            'credit_score'    => $creditScore,
            'score_range'     => $scoreRange,
            'eligible_amounts' => $eligibleAmount,
        ], 200);
    }

    ///Loan History
    public function loanHistory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $phone = $request->input('phone');
            if (!str_starts_with($phone, '+255')) {
                $phone = '+255' . ltrim($phone, '0');
            }

            $customer = Customer::where('phone', $phone)->first();

            if (!$customer) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customer not found.',
                ], 404);
            }

            $loans = Loan::with('repayments')->where('customer_id', $customer->id)->get();

            if ($loans->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No loan history found for this customer.',
                ], 404);
            }

            $loanHistoryList = $loans->map(function ($loan) {
                $totalRepaid = $loan->repayments->sum('repay_amount');

                if ($totalRepaid >= $loan->principal) {
                    $status = 'paid';
                } elseif ($totalRepaid > 0) {
                    $status = 'partial';
                } else {
                    $status = 'pending';
                }

                return [
                    'loan_id'    => $loan->id,
                    'amount'     => $loan->principal,
                    'created_at' => $loan->created_at->format('d M Y, h:i A'),
                    'status'     => $status,
                    'repaid'     => $totalRepaid,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data'   => $loanHistoryList,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching loan history: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'status'  => 'error',
                'message' => 'An internal server error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    ///Repay Loan
    public function repayLoan(Request $request)
    {
        $phone            = $request->input('phone');
        $repaymentAmount  = $request->input('repayment_amount');
        $availableAmount  = $request->input('available_amount');
        $walletType       = $request->input('wallet_type');
        $provider         = $request->input('provider');

        // Normalize phone to E.164
        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0');
        }
        // Find customer
        $user = Customer::where('phone', $phone)->first();
        if (!$user) {
            return response()->json([
                'status'  => 'Not Registered',
                'message' => 'User not found',
            ], 404);
        }
        // Find active loan
        $loan = Loan::where('customer_id', $user->id)->first();
        if (!$loan) {
            return response()->json([
                'status'  => 'Inactive',
                'message' => 'The client does not have any active loan.',
            ], 200);
        }
        // Validate repayment amount
        if ($repaymentAmount <= 0) {
            return response()->json([
                'status'  => 'Error',
                'message' => 'Repayment amount must be greater than zero.',
            ], 400);
        }
        if ($repaymentAmount > $loan->total_repay) {
            return response()->json([
                'status'  => 'Error',
                'message' => 'Repayment amount exceeds the remaining loan balance.',
            ], 400);
        }
        // Prepare mobile checkout payload
        $externalId = 'TZSREP' . strtoupper(Str::random(8));
        //$accountNumber = '0' . ltrim($phone, '0'); // e.g., 0767XXXXXX

        $payload = [
            'amount'        => $repaymentAmount,
            'currency'      => 'TZS',
            'accountNumber' => $phone,
            'externalId'    => $externalId,
            'provider'      => $provider,
        ];
        $checkoutResponse = app(PayController::class)->mnoCheckout(new Request($payload));
        if ($checkoutResponse->getStatusCode() !== 200) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Mobile payment failed.',
                'details' => $checkoutResponse->getData(true)
            ], 500);
        }
        // Save repayment
        $repayment = new Repay_Loan([
            'customer_id'      => $user->id,
            'loan_id'          => $loan->id,
            'repay_amount'     => $repaymentAmount,
            'available_amount' => $availableAmount,
            'wallet_type'      => $walletType,
        ]);
        $repayment->save();
        // Update loan balance
        $loan->total_repay -= $repaymentAmount;
        if ($loan->total_repay <= 0) {
            $loan->total_repay = 0;
            $loan->status = 'paid';
            $loan->user->increment('credit_score', 0.25);
        }
        $loan->save();
        return response()->json([
            'status'  => 'Success',
            'message' => 'The loan has been repaid successfully.',
            'data'    => $checkoutResponse,
        ], 200);
    }

    public function settingFrmApp(Request $request)
    {
        $phone = $request->input('phone');

        if (!str_starts_with($phone, '+255')) {
            $phone = '+255' . ltrim($phone, '0');
        }

        $user = Customer::where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'status'  => 'Not Registered',
                'message' => 'User not found',
            ], 404);
        }

        // Optional: Check if record already exists to update instead of creating new
        $setting = AppSettings::updateOrCreate(
            ['customer_id' => $user->id],
            [
                'notif_update' => $request->input('switch0'),
                'notif_promo'  => $request->input('switch1'),
            ]
        );

        return response()->json([
            'status'  => 'Success',
            'message' => 'Settings saved successfully',
            'data'    => $setting,
        ]);
    }
}
