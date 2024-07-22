<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function index(){
        return view('login');
    }
    
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    // Google user object dari Google
    $userFromGoogle = Socialite::driver('google')->user();

    // Ambil user dari database berdasarkan Google user id
    $userFromDatabase = User::where('google_id', $userFromGoogle->getId())->first();

    // Jika tidak ada user, maka buat user baru
    if (!$userFromDatabase) {
        $newUser = new User([
            'google_id' => $userFromGoogle->getId(),
            'name' => $userFromGoogle->getName(),
            'email' => $userFromGoogle->getEmail(),
        ]);

        $newUser->save();

        // Login user yang baru dibuat
        auth('web')->login($newUser);
        session()->regenerate();

        return redirect('/');
    } else {
        // Jika ada user langsung login saja
        auth('web')->login($userFromDatabase);
        session()->regenerate();

        // Redirect user berdasarkan peran mereka
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role == 'pengguna_awal') {
            return redirect('/pengguna_awal');
        } elseif (Auth::user()->role == 'operator_sekolah') {
            return redirect('/operator_sekolah');
        } elseif (Auth::user()->role == 'staff_kantor') {
            return redirect('/staff_kantor');
        } elseif (Auth::user()->role == 'kadis') {
            return redirect('/kadis');
        } else {
            // Jika tidak ada peran yang cocok, arahkan ke halaman default
            return redirect('/');
        }
    }
}

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}