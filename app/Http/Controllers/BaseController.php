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
        return view('web.main');
    }

    public function pegawaiProfile()
    {
        return view('admin.profile_pegawai');
    }
}
