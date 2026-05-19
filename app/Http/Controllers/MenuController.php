<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Resto;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::with('resto')->get();
        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        $resto = Resto::all();
        return view('menu.create', compact('resto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga'     => 'required|numeric',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menu'), $nama_file);
            $data['gambar'] = 'images/menu/' . $nama_file;
        }

        Menu::create($data);
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $resto = Resto::all();
        return view('menu.edit', compact('menu', 'resto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga'     => 'required|numeric',
            'gambar'    => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->all();

        // Ubah Gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if (file_exists(public_path($menu->gambar))) {
                unlink(public_path($menu->gambar));
            }
            // Upload gambar baru
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menu'), $nama_file);
            $data['gambar'] = 'images/menu/' . $nama_file;
        }

        $menu->update($data);
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil diubah!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        // Hapus gambar
        if (file_exists(public_path($menu->gambar))) {
            unlink(public_path($menu->gambar));
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil dihapus!');
    }
}