<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use App\Models\Penawaran;
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

    public function updateProfile(Request $request)
    {
        dd($request->all());
    }

    //Web logic
    public function webView()
    {
        $mulai = Lelang::with(['petugas', 'user', 'barang'])
        ->where('tgl_mulai', '<=', now())
        ->where('tgl_selesai', '>=', now())
        ->paginate(9);

        return view('web.home', [
            "dataArr" => $mulai,
        ]);
    }
}
