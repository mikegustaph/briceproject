<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function appreport()
    {
        return view('pages.app_report');
    }

    public function systemreport()
    {
        return view('pages.system_report');
    }

    public function viewappreport()
    {
        return view('pages.report');
    }
}
