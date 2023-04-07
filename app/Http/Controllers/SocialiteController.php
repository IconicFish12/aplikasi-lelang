<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandler(FlasherInterface $flasher)
    {
        try {
            $user = Socialite::driver('google')->user();

            $login_user = User::where('google_id', $user->id)->first();

            // dd($login_user->nama_lengkap);

            if ($login_user != null) {
                Auth::login($login_user, true);

                $flasher->addSuccess("Selamat Datang $login_user->nama_lengkap");

                return redirect()->to('/');
            }

            $newUser = User::create([
                'nama_lengkap' => $user->name,
                'email' =>  $user->email,
                'google_id' => $user->id,
                'password' => Hash::make('password'),
                'telp' => "082162941198",
            ]);

            Auth::login($newUser, true);

            $flasher->addSuccess("Selamat Datang $newUser->nama_lengkap");

            return redirect()->to('/');
        } catch (Exception $e) {

            $flasher->addError("Login Tidak Valid");

            return redirect()->to('auth');
        }
    }
}
