<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function adminView()
    {
        
        return view('admin.home');
    }

    public function webView()
    {
        // dd(auth('petugas')->check());
        return view('web.main');
    }
}
