<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function index()
    {
        $resto = Resto::all();
        return view('resto.index', compact('resto'));
    }

    public function create()
    {
        return view('resto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_resto' => 'required',
            'alamat'     => 'required',
            'telepon'    => 'required'
        ]);

        Resto::create($request->all());
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $resto = Resto::findOrFail($id);
        return view('resto.edit', compact('resto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_resto' => 'required',
            'alamat'     => 'required',
            'telepon'    => 'required'
        ]);

        $resto = Resto::findOrFail($id);
        $resto->update($request->all());
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil diubah!');
    }

    public function destroy($id)
    {
        Resto::findOrFail($id)->delete();
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil dihapus!');
    }
}