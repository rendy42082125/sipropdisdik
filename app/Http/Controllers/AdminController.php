<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.data_pengguna.index', compact('users'));


    }


public function penggunaEdit($id)
{
    $user = User::findOrFail($id);
    return view('admin.data_pengguna.edit', compact('user'));
}

public function penggunaUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    return redirect()->route('admin.data_pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
}

public function penggunaDestroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.data_pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
}

}
