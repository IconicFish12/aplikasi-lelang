<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    // Admin Logic
    public function adminView()
    {
        return view('admin.home');
    }

    public function pegawaiProfile()
    {
        return view('admin.profile_pegawai');
    }

    //Web logic
    public function webView()
    {
        if (auth('web')->check()) {
            $data = Penawaran::where('user_id', Auth::guard('web')->user()->id)->first();
        }

        return view('web.home', [
            "dataArr" => Lelang::with(['petugas', 'user', 'barang'])->paginate(12),
        ]);
    }
}
