<?php

namespace App\Http\Controllers;

use App\Models\CollectTransactions;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanCollectionGroup;
use App\Models\LoanSetting;
use App\Models\ModuleSettings;
use App\Models\Repay_Loan;
use App\Models\Transaction;
use App\Models\TransferTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanMangementController extends Controller
{
    public function customerList()
    {
        $customers = Customer::all();
        return view('pages.customer_list', compact('customers'));
    }
    public function customerCreate(Request $request)
    {
        $newcust = new Customer();
        $newcust->first_name  =  $request->customer_fname;
        $newcust->last_name   =  $request->customer_lname;
        $newcust->sex         =  $request->customer_gender;
        $newcust->email       =  $request->customer_email;
        $newcust->phone       =  $request->customer_tel;
        $newcust->nida_number =  $request->customer_nida;
        $newcust->Address     =  $request->customer_address;
        $newcust->district    =  $request->customer_distr;
        $newcust->region      =  $request->customer_region;
        $newcust->save();
        return redirect()->back()->with('message', 'Customer Created Successfully!');
    }
    ///Customer Profile
    /*public function customerProfile($id)
    {
        $customer = Customer::find($id);
        $totalPrincipal  = Loan::where('customer_id', $customer->id)->sum('principal');
        $totalRepayment = Repay_Loan::where('customer_id', $customer->id)->sum('repay_amount');

        return view('pages.customer_profile', compact('customer', 'totalPrincipal', 'totalRepayment'));
    }*/
    public function customerProfile($id)
    {
        $customer = Customer::find($id);

        $totalPrincipal  = Loan::where('customer_id', $customer->id)->sum('principal');
        $totalRepayment = Repay_Loan::where('customer_id', $customer->id)->sum('repay_amount');

        // Define which fields determine profile completeness
        $requiredFields = ['first_name', 'email', 'phone', 'nida_number', 'Address', 'District', 'Region', 'Occupation', 'referee_one_name', 'referee_one_phone', 'referee_two_name', 'referee_two_phone'];
        $filled = 0;

        foreach ($requiredFields as $field) {
            if (!empty($customer->$field)) {
                $filled++;
            }
        }

        $completionPercent = $filled > 0 ? round(($filled / count($requiredFields)) * 100) : 0;

        return view('pages.customer_profile', compact(
            'customer',
            'totalPrincipal',
            'totalRepayment',
            'completionPercent'
        ));
    }


    /// fetch the customer data
    public function loanList()
    {
        //$setting    = ModuleSettings::firstOrFail();
        $customers  = Customer::all();
        $loans      = Loan::with('customers')->get();
        $periods    = LoanSetting::first();
        $peridres   = explode(',', $periods->periods);
        //return response()->json($loans);
        return view('pages.loan_list', compact('customers', 'loans', 'peridres'));
    }

    public function loanCreate(Request $request) {}

    public function LoanCollectionGroup()
    {
        $collection = LoanCollectionGroup::all();
        return view('pages.loan_collection_group', compact('collection'));
    }

    public function AddCollectionGroupIndex()
    {
        //$collection = LoanCollectionGroup::all();
        return view('pages.create_loan_collection_group');
    }
    public function AddCollectionGroup(Request $request)
    {
        $newgroup = new LoanCollectionGroup();
        $newgroup->days_overdue   =  $request->number_days;
        $newgroup->classification =  $request->classification;
        $newgroup->provision      =  $request->provision;
        $newgroup->save();
        return redirect()->back()->with('message', 'New group added successfuly!');
    }

    public function loanView($id)
    {
        $loan = Loan::find($id);
        return view('pages.loan_view', compact('loan'));
    }

    public function loanCreateStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'customer'     => 'required', // Ensures customer exists in database
                'principal'    => 'required|numeric|min:1',       // Minimum of 1 for principal
                'period'       => 'required|integer|min:1',       // Minimum of 1 day
            ]);
            $customer      = $validatedData['customer'];
            $principal     = $validatedData['principal'];
            $numberOfDays  = $validatedData['period'];
            // Step 1: Calculate the service charge (18% of principal)
            $serviceCharge = $principal * 0.18;
            // Step 2: Calculate interest based on daily interest rate and period
            $annualInterestRate = 10; // 10% annual interest rate
            $dailyInterestRate  = $annualInterestRate / 365 / 100;
            $interestAmount     = $principal * $dailyInterestRate * $numberOfDays;
            $totalPayment = $principal + $serviceCharge + $interestAmount;
            // Step 4: Calculate daily payment amount
            $dailyPayment = $totalPayment / $numberOfDays;
            // Create a new loan record
            $newLoan = Loan::create([
                'customer_id'    => $customer,
                'principal'      => $principal,
                'interest_rate'  => $annualInterestRate,
                'number_of_days' => $numberOfDays,
                'service_charge' => round($serviceCharge, 2),
                'total_repay'    => round($totalPayment, 2),
                'daily_payment'  => round($dailyPayment, 2),
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Loan was created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'There was an error processing your request: ' . $e->getMessage());
        }
    }
    /// Check user registration
    /*public function checkUser(Request $request)
    {
        $phone = $request->input('phone');
        $user =  Customer::where('phone', $phone)->first();
        return response()->json($user->status);
    }*/
    /*public function checkUser(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);
        $user = Customer::where('phone', $request->input('phone'))->first();
        if ($user) {
            return response()->json([
                'status' => $user->status,
                'message' => 'User found',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Not Registered',
                'message' => 'User not found',
            ], 404);
        }
    }*/

    public function  borrowHistory()
    {
        return view('pages.borrow_history');
    }
    public function transactions()
    {
        $data = TransferTransaction::all();
        return view('pages.transactions', compact('data'));
    }

    public function collectTransactions()
    {
        $data = CollectTransactions::all();
        return view('pages.collect_transactions', compact('data'));
    }
    public function appLoginByPhone(Request $request)
    {
        // Validate phone number
        $request->validate([
            'phoneNumber' => 'required', // Ensure numeric and within valid range
        ]);
        $phone = trim($request->input('phoneNumber'));
        $customer = Customer::where('phone', $phone)->first();
        if ($customer) {
            return response()->json([
                'message' => 'exists',
                'phone' => $customer->phone,
            ], 200);
        }
        try {
            $newCustomer = Customer::create(['phone' => $phone]);
            return response()->json([
                'message' => 'success',
                'phone' => $newCustomer->phone,
            ], 201);
        } catch (\Exception $e) {
            // Handle database or other errors
            return response()->json([
                'message' => 'Error creating customer: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function Repayments()
    {
        $loanrepay = Repay_Loan::with('customers', 'loantaken')->get();
        $customers = Customer::all();
        $periods    = LoanSetting::first();
        $peridres   = explode(',', $periods->periods);
        return view('pages.loan_repayments', compact('loanrepay', 'customers', 'peridres'));
    }

    public function LoanPenalty(Request $request)
    {
        $overdueLoans = Loan::where('status', 'pending')->get();
        foreach ($overdueLoans as $loan) {
            $overdueDays = now()->diffInDays($loan->created_at);
            // Calculate the daily penalty as 3% of the principal amount
            $dailyPenalty = 0.03 * $loan->principal_amount;
            // Calculate the total penalty based on the number of overdue days
            $totalPenalty = $dailyPenalty * $overdueDays;
            // Update the amount required to repay
            $loan->amount_due = $loan->principal_amount + $totalPenalty;
            // Save the updated loan record
            //$loan->save();
        }

        return response()->json([
            'message' => 'Penalties updated successfully.',
            'days'    => $overdueDays
        ]);
    }
    public function UpdateLoanStatus()
    {
        $loans = Loan::where('status', '!=', 'overdue')->get();
        foreach ($loans as $loan) {
            $dueDate = $loan->created_at->addDays($loan->days);
            if (now()->greaterThan($dueDate)) {
                $loan->status = 'overdue';
                $loan->save();
            }
        }
        return response()->json(['message' => 'Loan statuses updated successfully.']);
    }

    /*public function appLoginByPhone(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|numeric', // Adjust digits based on your needs
        ]);
        $phone = $request->input('phoneNumber');
        $customer = Customer::where('phone', $phone)->first();
        if ($customer) {
            return response()->json([
                'message' => 'exists',
                'phone' => $customer->phone
            ], 200);
        }
        $newCustomer = Customer::create([
            'phone' => $phone,
        ]);
        return response()->json([
            'message' => 'successfully',
            'phone' => $newCustomer->phone
        ], 201);
    }*/
}
