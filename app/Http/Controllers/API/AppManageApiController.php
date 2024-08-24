<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppManageApiController extends Controller
{
    public function privacyPolicy()
    {
        $policydata = [3, 2, 1, 5, 6];
        return response()->json(['policydata' => $policydata],);
    }
    public function Disclosure()
    {
        return true;
    }
    public function whyChooseus()
    {
        return true;
    }
    public function Faq()
    {
        return true;
    }
    public function AboutUs()
    {
        return true;
    }
    public function Support()
    {
        return true;
    }
}
