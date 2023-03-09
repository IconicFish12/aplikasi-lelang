<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\History_lelang;
use App\Models\Lelang;
use App\Models\Penawaran;
use App\Models\Petugas;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    // Admin Logic
    public function adminView()
    {
        return view('admin.home', [
            'costumer' => User::all()->count(),
            'barang' => Barang::all()->count(),
            'lelang' => Lelang::all()->count(),
            'hasil' => History_lelang::all()->sum('harga_lelang') ?? 0,
        ]);
    }

    public function pegawaiProfile()
    {
        return view('admin.profile_pegawai');
    }

    public function updateProfile(Request $request, FlasherInterface $flasher)
    {
        $data = $request->all();
        // dd($data);

        $validData = Validator::make($data, [
            'nama_petugas' => ['required'],
            'alamat' => ['max:100'],
            'tgl_lahir' => ['date'],
            'telp' => ['required','min:4', 'max:15'],
            'email' => ['required','email'],
        ], [
            'nama_petugas.required' => "Input ini harus diisi",
            'telp.required' => "Input ini harus diisi",
            'email.required' => "Input ini harus diisi",
            'telp.max' => "Panjang Maksimal 15 Karakter",
            'alamat.max' => "Panjang Maksimal 100 Karakter",
            'email.min' => "Panjang Maksimal 4 Karakter",
            'telp.min' => "Panjang Maksimal 4 Karakter",
        ]);

        if(!$validData->fails()){
            $petugas = Petugas::find($data['id']);

            if ($request->has('foto') && $request->hasFile('foto')) {
                if (!is_null($petugas->foto) && Storage::disk("public_path")->exists($petugas->foto)) {
                    Storage::disk("public_path")->delete($petugas->foto);
                }

                $valid = Validator::make($request->all(), [
                    'foto' => ['image', 'mimes:png,jpg,jpeg', 'max:5000'],

                ], [
                    'foto.image' => "file harus berupa foto",
                    'foto.mimes' => "format yang diperbolehkan adalah png,jpg,jpeg",
                    'foto.max' => "Ukuran Maksimal 5 MB",
                ]);

                if(!$valid->fails()){
                    $data['foto'] = $request->file('foto')->store('/profile', "public_path");

                    $petugas->update([
                        'foto' => $data['foto']
                    ]);
                }
                $flasher->addError("Gagal Merubah Data");

                return back()->withErrors($valid->errors());
            }

            Petugas::where('id', $data['id'])->update([
                'nama_petugas' => $data['nama_petugas'],
                'tgl_lahir' => $data['tgl_lahir'],
                'email' => $data['email'],
                'telp' => $data['telp'],
                'alamat' => $data['alamat'],
            ]);

            $flasher->addSuccess("Berhasil Merubah Data $request->nama_petugas");

            return back();
        }

        $flasher->addError("Gagal Merubah Data");

        return back()->withErrors($validData->errors())->withInput();

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
            'header' => 'Barang Lelang',
        ]);
    }
}
