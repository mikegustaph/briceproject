<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
