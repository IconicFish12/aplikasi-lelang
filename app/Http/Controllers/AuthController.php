<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function userLoginView()
    {
        return view('auth.userLogin');
    }

    public function petugasLoginView()
    {
        return view('auth.petugasLogin');
    }

    public function userRegisterview()
    {
        return view('auth.userRegister');
    }

    public function petugasRegisterview()
    {
        return view('auth.petugasRegister');
    }

    public function loginAction(Request $request, FlasherInterface $flasher)
    {
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'min:4', 'email'],
            'password' => ['required', Password::min(4)->mixedCase(), 'max:20'],
        ], [
            'email.required' => "Input ini harus diisi",
            'password.required' => "Input ini harus diisi",
            'email.min' => "Panjang Minimal 4 karakter",
            'email.email' => "Email Harus Valid",
            "password.max" => "Panjang Maksimal 20 Karakter"
        ]);

        if (!$validate->fails()) {
            $user = User::where('email', $request->email)->first();
            $petugas = Petugas::where('email', $request->email)->first();

            if (Auth::guard('petugas')->attempt($request->only(['email', 'password']), $request->remember)) {

                $request->session()->regenerate();

                $flasher->addSuccess("Selamat Datang $petugas->nama_petugas");

                return redirect()->to("/admin");
            } elseif (Auth::guard('web')->attempt($request->only(['email', 'password']), $request->remember)) {

                $request->session()->regenerate();

                $flasher->addSuccess("Selamat Datang $user->nama_lengkap");

                return redirect()->to('/');
            }

            $flasher->addError("Email Atau Password Tidak Ditemukan");

            return back();
        }

        return back()->withErrors($validate->errors())->withInput();
    }

    public function registerAction(Request $request, FlasherInterface $flasher)
    {
        $data =  $request->all();

        if ($request->nama_petugas) {

            $validate = Validator::make($data, [
                'nama_petugas' => ['required'],
                'email' => ['required', 'email', 'min:4', 'unique:tb_petugas,email'],
                'password' => ['required', Password::min(4)->mixedCase(), 'max:20'],
                'telp' => ['required', 'max:15', 'min:4']
            ], [
                'nama_petugas.required' => "Input ini harus diisi",
                'email.unique' => 'Nilai Dari Input ini harus unik',
                'password.required' => "Input ini harus diisi",
                'telp.required' => "Input ini harus diisi",
                'email.required' => "Input ini harus diisi",
                'password.max' => "Panjang Maksimal 20 Karakter",
                'email.min' => "Panjang Maksimal 4 Karakter",
                'telp.min' => "Panjang Maksimal 4 Karakter",
            ]);

            if (!$validate->fails()) {
                if ($request->nama_petugas == Petugas::where('nama_petugas', $data['nama_petugas'])->first()->nama_petugas) {
                    $flasher->addError('Petugas Sudah Terdaftar');

                    return back();
                }

                Petugas::create([
                    'nama_petugas' => $data['nama_petugas'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'telp' => $data['telp'],
                ]);

                $flasher->addSuccess("Registrasi Berhasil");
                return redirect()->to('login');
            } else {

                return back()->withErrors($validate->errors())->withInput();
            }
        } else {

            $validate = Validator::make($data, [
                'nama' => ['required'],
                'email' => ['required', 'email', 'min:4'],
                'password' => ['required', Password::min(4)->mixedCase(), 'max:20'],
                'telp' => ['required', 'max:15', 'min:4']
            ], [
                'nama.required' => "Input ini harus diisi",
                'password.required' => "Input ini harus diisi",
                'telp.required' => "Input ini harus diisi",
                'email.required' => "Input ini harus diisi",
                'password.max' => "Panjang Maksimal 20 Karakter",
                'email.min' => "Panjang Maksimal 4 Karakter",
                'telp.min' => "Panjang Maksimal 4 Karakter",
            ]);

            if (!$validate->fails()) {
                User::create([
                    'nama_lengkap' => $data['nama'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'telp' => $data['telp'],
                ]);

                $flasher->addSuccess("Registrasi Berhasil");
                return redirect()->to('auth');
            } else {

                return back()->withErrors($validate->errors())->withInput();
            }
        }
    }

    public function logout(FlasherInterface $flasher, Request $request)
    {
        if (Auth::guard('petugas')->check()) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $flasher->addSuccess("Berhasil Logout");

            return redirect()->to('/login');
        } else {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $flasher->addSuccess("Berhasil Logout");

            return redirect()->to('/');
        }

        $flasher->addError("Gagal Logout");

        return back();
    }
}
