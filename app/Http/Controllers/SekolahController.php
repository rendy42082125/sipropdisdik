<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jenis;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index(Request $request)
    {
        $query = Sekolah::with('jenis');
        $sekolah = $query->get();

        return view('admin.sekolah.index', compact('sekolah'));
    }

    public function create()
    {
        $jenis = Jenis::all();
        return view('admin.sekolah.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'jenis_id' => 'required',
        ]);

        Sekolah::create($request->all());

        return redirect()->route('sekolah.index')->with('success', 'Sekolah created successfully.');
    }

    public function edit($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $jenis = Jenis::all();
        return view('admin.sekolah.edit', compact('sekolah', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'jenis_id' => 'required',
        ]);

        $sekolah = Sekolah::findOrFail($id);
        $sekolah->update($request->all());

        return redirect()->route('sekolah.index')->with('success', 'Sekolah updated successfully.');
    }

    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();

        return redirect()->route('sekolah.index')->with('success', 'Sekolah deleted successfully.');
    }
}


