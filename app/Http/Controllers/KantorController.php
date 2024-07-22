<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kantor;

class KantorController extends Controller
{
    public function index()
    {
        $kantor = Kantor::all();
        return view('admin.kantor', compact('kantor'));
    }

    public function create()
    {
        return view('admin.kantor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kantor' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
        ]);

        Kantor::create($request->all());

        return redirect()->route('kantor.index')
                        ->with('success', 'Kantor created successfully.');
    }

    public function show(Kantor $kantor)
    {
        return view('admin.kantor.show', compact('kantor'));
    }

    public function edit(Kantor $kantor)
    {
        return view('admin.kantor.edit', compact('kantor'));
    }

    public function update(Request $request, Kantor $kantor)
    {
        $request->validate([
            'nama_kantor' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
        ]);

        $kantor->update($request->all());

        return redirect()->route('kantor.index')
                        ->with('success', 'Kantor updated successfully.');
    }

    public function destroy(Kantor $kantor)
    {
        $kantor->delete();

        return redirect()->route('kantor.index')
                        ->with('success', 'Kantor deleted successfully.');
    }
}

