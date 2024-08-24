<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function forgotpassword()
    {
        return view('auth.forgot-password');
    }
    public function confirmpassword()
    {
        return view('auth.confirm-password');
    }
}
