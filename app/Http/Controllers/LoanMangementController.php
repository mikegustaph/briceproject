<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class LoanMangementController extends Controller
{
    public function customerList()
    {
        return view('pages.customer_list');
    }
    public function loanList()
    {
        return view('pages.loan_list');
    }
    public function  borrowHistory()
    {
        return view('pages.borrow_history');
    }
    public function transactions()
    {
        return view('pages.transactions');
    }
    public function appLoginByPhone(Request $r)
    {
        $customer = new Customer();
        $customer->phone = $r->phoneNumber;
        //$customer->save();
        return response()->json(['message' => 'Customer created successfully', 'phone' => $customer]);
    }
}
