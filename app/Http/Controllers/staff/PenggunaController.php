<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('staff.data_pengguna.index', compact('users'));


    }


public function Edit($id)
{
    $user = User::findOrFail($id);
    return view('staff.data_pengguna.edit', compact('user'));
}

public function Update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());
    return redirect()->route('staff.data_pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
}

public function Destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('staff.data_pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
}

public function countOperatorUsers()
{
    $operatorCount = User::where('role', 'operator_sekolah')->count();
    return view('staff.dashboard', compact('operatorCount'));
}
}

