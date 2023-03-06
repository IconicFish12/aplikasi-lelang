<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manajemen.petugas', [
            'page_header' => "Manajemen Petugas Lelang",
            'dataArr' => Petugas::where('role', "=", "petugas")->paginate(request('paginate'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePetugasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetugasRequest $request, FlasherInterface $flasher)
    {
        if ($request->validated()) {
            $data = $request->all();
            $data['foto'] = $request->file('foto')->store('/profile', "public_path");

            Petugas::create([
                'nama_petugas' => $data['nama_petugas'],
                'tgl_lahir' => $data['tgl_lahir'],
                'email' => $data['email'],
                'foto' => $data['foto'],
                'password' => Hash::make($data['password']),
                'telp' => $data['telp'],
                'role' => $data['role'],
                'alamat' => $data['alamat'],
            ]);

            $flasher->addSuccess('Berhasil Menambah Petugas');

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas, Request $request)
    {
        if ($request->has('getData') && $request->getData) {
            $data = $petugas->find($request->data);

            return response()->json($data, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetugasRequest  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePetugasRequest $request, Petugas $petugas, FlasherInterface $flasher)
    {
        $data =  $request->all();

        if ($request->validated()) {

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

            if ($request->has('password') && $request->password != null) {
                $valid = Validator::make($request->all(), [
                    'password' => [Password::min(4)->mixedCase(), "max:20"]
                ], [
                    'password.max' => "Panjang Maksimal 20 Karakter"
                ]);

                if ($valid->fails()) {
                    $flasher->addError('Gagal Mengubah Data Petugas');

                    return back()->withErrors($valid->errors())->withInput();
                }

                $petugas->update([
                    'password' => Hash::make($data['password'])
                ]);
            }

            $petugas->update([
                'nama_petugas' => $data['nama_petugas'],
                'tgl_lahir' => $data['tgl_lahir'],
                'email' => $data['email'],
                'telp' => $data['telp'],
                'role' => $data['role'],
                'alamat' => $data['alamat'],
            ]);

            $flasher->addSuccess("Berhasil Merubah Data $request->nama_petugas");

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petugas, FlasherInterface $flasher)
    {
        if ($petugas->destroy($petugas->id)) {
            Storage::disk("public_path")->delete($petugas->foto);

            $flasher->addSuccess("Berhasil Menghapus Data Petugas Lelang");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Petugas Lelang");

        return back();
    }
}
