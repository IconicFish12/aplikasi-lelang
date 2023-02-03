<?php

namespace App\Http\Controllers;

use App\Models\Level;
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
        return view('auth.petugasRegister', [
            'dataLevel' => Level::all()
        ]);
    }

    public function loginAction(Request $request, FlasherInterface $flasher)
    {
        $validate = $request->validate([
            'email' => ['required', 'max:25', 'min:4', 'email'],
            'password' => ['required', Password::min(4)->mixedCase(), 'max:20'],
        ]);

        $user = User::where('email', $request->email)->first();
        $petugas = Petugas::where('email', $request->email)->first();

        if (Auth::guard('petugas')->attempt($validate, $request->remember)) {

            $request->session()->regenerate();

            $flasher->addSuccess("Selamat Datang $petugas->nama_petugas");

            return redirect()->to("/admin");
        } elseif (Auth::guard('web')->attempt($validate, $request->remember)) {

            $request->session()->regenerate();

            $flasher->addSuccess("Selamat Datang $user->nama_petugas");

            return redirect()->to('/');
        }

        $flasher->addError("Email Atau Password Tidak Ditemukan");

        return back();
    }

    public function registerAction(Request $request, FlasherInterface $flasher)
    {
        $validate = Validator::make($request->all(), [
            'nama' => ['required'],
            'username' => ['required', 'max:25', 'min:4'],
            'email' => ['required', 'email:dns', 'min:4'],
            'password' => ['required', Password::min(4)->mixedCase(), 'max:20'],
            'telp' => ['required', 'max:15', 'min:4']
        ], [
            'nama.required' => "Input ini harus diisi",
            'username.required' => "Input ini harus diisi",
            'password.required' => "Input ini harus diisi",
            'telp.required' => "Input ini harus diisi",
            'email.required' => "Input ini harus diisi",
        ]);

        if (!$validate->fails()) {
            if ($request->has('level_id')) {
                Petugas::create([
                    'nama_petugas' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'telp' => $request->telp,
                    'level_id' => $request->level_id
                ]);

                $flasher->addSuccess("Registrasi Berhasil");
                return redirect()->to('login');
            } else {
                User::create([
                    'nama_lengkap' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'telp' => $request->telp,
                ]);

                $flasher->addSuccess("Registrasi Berhasil");
                return redirect()->to('auth');
            }
        }else{
            return back()
            ->withErrors($validate->errors())
            ->withInput($request->all());
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
