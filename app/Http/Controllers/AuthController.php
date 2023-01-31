<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function userRegisterview()
    {
        return view('auth.userRegister');
    }

    public function petugasRegisterview()
    {
        return view('auth.petugasRegister');
    }
}
