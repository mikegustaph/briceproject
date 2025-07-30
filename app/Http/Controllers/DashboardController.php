<?php

namespace App\Http\Controllers;

use App\Models\CollectTransactions;
use App\Models\CompanyTarget;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\Repay_Loan;
use App\Models\TransferTransaction;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customer =  Customer::where('status', 'Registered')->get();
        $allcustomer = Customer::all();
        $customerpercent = count($customer) / count($allcustomer) * 100;
        $transfer = TransferTransaction::all();
        $transSuccess = TransferTransaction::where('status', 'Success')->get();
        $collect  = CollectTransactions::all();
        $transaction = count($transfer) + count($collect);

        $transPercent = count($transSuccess) / count($transfer) * 100;
        $interest = Loan::where('status', 'paid')->sum('interest_rate');

        $repay    = Repay_Loan::all()->sum('repay_amount');
        $loan     = Loan::all();
        //$target = CompanyTarget::latest()->first();
        $target = CompanyTarget::whereYear('created_at', now()->year)     // same year as today
            ->whereMonth('created_at', now()->month)   // same month as today
            ->latest()                                // newest first
            ->first();
        $start  = now()->startOfMonth();
        $end    = now()->endOfMonth();
        $rows   =  Loan::selectRaw('DATE(created_at) as day, SUM(interest_rate) as total')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy('day');
        $period = CarbonPeriod::create($start, $end);
        $categories = [];
        $seriesData = [];
        foreach ($period as $date) {
            $key = $date->toDateString();
            $categories[] = $date->format('M, d');
            $seriesData[]   =  $rows[$key]->total ?? 0;
        }

        return view('dashboard.index', compact('customer', 'transaction', 'interest', 'repay', 'target', 'categories', 'seriesData', 'transPercent', 'customerpercent'));
        //return response()->json($categories);
    }
}
