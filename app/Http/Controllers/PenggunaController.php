<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kantor; // Pastikan ini mengarah ke model yang benar
use App\Models\Sekolah; // Pastikan ini mengarah ke model yang benar

class PenggunaController extends Controller
{
    public function edit()
    {
        $kantors = Kantor::all();
        $sekolahs = Sekolah::all();

        return view('pengguna.form', [
            'kantors' => $kantors,
            'sekolahs' => $sekolahs,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'telepon' => 'required|string|max:15',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_kantor' => 'nullable|integer',
            'id_sekolah' => 'nullable|integer',
        ]);

        $user->telepon = $request->telepon;
        $user->id_kantor = $request->id_kantor;
        $user->id_sekolah = $request->id_sekolah;

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images/profile', $filename, 'public');
            $user->foto_profile = $filename;
        }

        $user->save();

        return redirect()->route('pengguna.hasil');
    }

    public function hasil()
    {
        $user = Auth::user();
        $kantor = $user->id_kantor ? Kantor::find($user->id_kantor) : null;
        $sekolah = $user->id_sekolah ? Sekolah::find($user->id_sekolah) : null;

        return view('pengguna.hasil', [
            'kantor' => $kantor,
            'sekolah' => $sekolah,
        ]);
    }
}
