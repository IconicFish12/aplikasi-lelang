<?php

namespace App\Http\Controllers;

use App\Models\Lelang;

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
        $mulai = Lelang::with(['petugas', 'user', 'barang'])
        ->where('tgl_mulai', '<=', now())
        ->where('tgl_selesai', '>=', now())
        ->paginate(9);

        // dd($mulai);

        return view('web.home', [
            "dataArr" => $mulai,
        ]);
    }
}
