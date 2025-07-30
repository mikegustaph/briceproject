<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function CustomReport()
    {
        return view('pages.custom_report');
    }
    public function AppReport()
    {
        return view('pages.app_report');
    }
    public function UserReport()
    {
        return view('pages.user_report');
    }

    public function nplReport()
    {
        $loans = Loan::all();

        $nplData = $loans->map(function ($loan) {
            $loanDate = Carbon::parse($loan->created_at);
            $today = Carbon::today();

            $dueDays = $loanDate->diffInDays($today);
            $penaltyRatePerDay = 0.02; // 2%

            $penaltyAmount = $loan->principal * $penaltyRatePerDay * $dueDays;

            $loan->pastDue_days = $dueDays;
            $loan->penalty_amount = $penaltyAmount;

            return $loan;
        });

        //return response()->json($nplData);
        return view('pages.npl-report', compact('nplData'));
    }
}
