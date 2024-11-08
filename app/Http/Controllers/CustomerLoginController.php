<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/my-profile';

    public function showLoginForm()
    {
        return view('auth.sign-in');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }


}
