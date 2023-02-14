<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use Illuminate\Http\Request;

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
        return view('web.home', [
            "dataArr" => Lelang::with(['petugas', 'user', 'barang'])->paginate(12),
        ]);
    }

}
