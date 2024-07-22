<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.data_pengguna.index', compact('users'));


    }


public function Edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.data_pengguna.edit', compact('user'));
}

public function Update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    return redirect()->route('admin.data_pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
}

public function Destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.data_pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
}

public function countOperatorUsers()
{
    $operatorCount = User::where('role', 'operator_sekolah')->count();
    return view('admin.dashboard', compact('operatorCount'));
}

public function profile()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        
        // Kirim data ke view
        return view('profile', compact('user'));
    }
}
