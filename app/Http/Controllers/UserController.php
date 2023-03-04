<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequset;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdatePetugasRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manajemen.user', [
            'page_header' => "Manajemen Konsumen",
            'dataArr' => User::latest()->paginate(request('paginate') ?? 15)
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
     * @param  \App\Http\Requests\StoreUserRequset  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequset $request, FlasherInterface $flasher)
    {
        $data = $request->all();

        if($request->validated()){
            User::create([
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'telp' => $data['telp']
            ]);

            $flasher->addSuccess("Berhasil Menambah $request->nama_lengkap");

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if($request->has('getData') && $request->getData){
            $data = $user->find($request->data);

            return response()->json($data, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetugasRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user, FlasherInterface $flasher)
    {
        $data =  $request->all();

        if($request->validated()){
            $user->update([
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'telp' => $data['telp'],
            ]);

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

                $user->update([
                    'password' => Hash::make($data['password'])
                ]);
            }

            $flasher->addSuccess("Berhasil Merubah Data $request->nama_lengkap");

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, FlasherInterface $flasher)
    {
        if($user->destroy($user->id)){
            $flasher->addSuccess("Berhasil Menghapus Data Konsumen");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Konsumen");

        return back();
    }
}
