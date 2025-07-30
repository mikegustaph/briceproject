<?php

namespace App\Http\Controllers;

use App\Models\CompanyExpenses;
use App\Models\CompanyTarget;
use App\Models\Loan;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function indexIncome()
    {
        $income = Loan::all();
        return view('pages.comp_income', compact('income'));
    }

    public function indexExpenses()
    {
        $expenses = CompanyExpenses::all();
        return view('pages.comp_expenses', compact('expenses'));
    }

    public function indexExpensesStore(Request $request)
    {
        $expense = new CompanyExpenses();
        $expense->user_id           = auth()->user()->id;
        $expense->date              = $request->expense_date;
        $expense->account           = $request->account_type;
        $expense->description       = $request->description;
        $expense->method_of_payment = $request->payment_option;
        $expense->paid_to           = $request->paid_to;
        $expense->amount            = $request->amount;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            //$path = $file->storeAs('attachments', $filename, 'public/assets/media/attachment');
            $path = $file->storeAs('assets/media/attachment', $filename, 'public');
            $expense->attachment  = $filename;
        }
        $expense->save();
        return view('pages.create_expense');
    }

    public function createExpense()
    {
        return view('pages.create_expense');
    }

    public function indexTarget()
    {
        $target = CompanyTarget::all();
        return view('pages.comp_target', compact('target'));
    }

    public function createTarget()
    {
        return view('pages.create_target');
    }

    public function createTargetStore(Request $request)
    {
        $user = auth()->user()->id;
        $newTarget = new CompanyTarget(); // Call model
        $newTarget->user_id      = $user;
        $newTarget->amount       = $request->target_amount;
        $newTarget->target_month = $request->target_month;
        $newTarget->target_year  = $request->target_year;
        $newTarget->description  = $request->description;
        $newTarget->save();
        //return response()->json($newTarget);
        return view('pages.create_target');
    }
}
