<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function adminView()
    {
        return view('admin.home');
    }
}
