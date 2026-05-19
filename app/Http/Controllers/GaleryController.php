<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use App\Models\Resto;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        // Ubah dari data array ke data Database
        $galery = Galery::with('resto')->get();
        return view('galery.index', compact('galery'));
    }

    public function create()
    {
        $resto = Resto::all();
        return view('galery.create', compact('resto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/galery'), $nama_file);
            $data['gambar'] = 'images/galery/' . $nama_file;
        }

        Galery::create($data);
        return redirect()->route('galery.index')->with('sukses', 'Foto berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galery = Galery::findOrFail($id);
        $resto = Resto::all();
        return view('galery.edit', compact('galery', 'resto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'gambar'     => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $galery = Galery::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if (file_exists(public_path($galery->gambar))) {
                unlink(public_path($galery->gambar));
            }
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/galery'), $nama_file);
            $data['gambar'] = 'images/galery/' . $nama_file;
        }

        $galery->update($data);
        return redirect()->route('galery.index')->with('sukses', 'Foto berhasil diubah!');
    }

    public function destroy($id)
    {
        $galery = Galery::findOrFail($id);
        if (file_exists(public_path($galery->gambar))) {
            unlink(public_path($galery->gambar));
        }
        $galery->delete();
        return redirect()->route('galery.index')->with('sukses', 'Foto berhasil dihapus!');
    }
}