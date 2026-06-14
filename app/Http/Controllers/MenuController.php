<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Resto;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // ➡️ Tampilkan semua data menu
    public function index()
    {
        $menu = Menu::with('resto')->get(); // ambil data menu beserta resto-nya
        return view('menu.index', compact('menu'));
    }

    // ➡️ Buka halaman tambah menu
    public function create()
    {
        // Cuma ambil data RESTO aja, KATEGORI UDAH DIHAPUS JADI GAK PERLU
        $resto = Resto::all();
        return view('menu.create', compact('resto')); // kirim cuma data resto
    }

    // ➡️ Proses simpan data ke database
    public function store(Request $request)
    {
        // Aturan isian, BAGIAN KATEGORI UDAH KUBUANG
        $request->validate([
            'nama_menu'  => 'required',  // nama menu wajib diisi
            'harga'      => 'required|numeric', // harga wajib & harus angka
            'gambar'     => 'required|image|mimes:jpeg,png,jpg|max:2048', // gambar wajib & jenisnya
            'resto_id'   => 'required', // pilih resto wajib
        ]);

        $data = $request->all(); // ambil semua isian dari form

        // PROSES UPLOAD GAMBAR
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // kasih nama file pakai waktu biar gak sama namanya
            $nama_file = time() . "_" . $file->getClientOriginalName();
            // simpan ke folder public/images/menu
            $file->move(public_path('images/menu'), $nama_file);
            // simpan alamat file-nya aja ke database
            $data['gambar'] = 'images/menu/' . $nama_file;
        }

        Menu::create($data); // simpan semua data ke tabel menu
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil ditambahkan!');
    }

    // ➡️ Buka halaman ubah data
    public function edit($id)
    {
        $menu = Menu::findOrFail($id); // cari data yang mau diubah
        $resto = Resto::all(); // ambil daftar resto buat pilihan
        return view('menu.edit', compact('menu', 'resto')); // kirim data ke halaman
    }

    // ➡️ Proses ubah data
    public function update(Request $request, $id)
    {
        // Aturan ubah, KATEGORI UDAH KUBUANG
        $request->validate([
            'nama_menu'  => 'required',
            'harga'      => 'required|numeric',
            'gambar'     => 'image|mimes:jpeg,png,jpg|max:2048', // gambar boleh ganti atau enggak
            'resto_id'   => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->all();

        // Kalau ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari folder
            if (file_exists(public_path($menu->gambar))) {
                unlink(public_path($menu->gambar));
            }
            // Upload gambar baru
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menu'), $nama_file);
            $data['gambar'] = 'images/menu/' . $nama_file;
        }

        $menu->update($data); // simpan perubahan
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil diubah!');
    }

    // ➡️ Proses hapus data
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        // Hapus gambarnya dulu dari folder
        if (file_exists(public_path($menu->gambar))) {
            unlink(public_path($menu->gambar));
        }
        $menu->delete(); // hapus data dari database
        return redirect()->route('menu.index')->with('sukses', 'Menu berhasil dihapus!');
    }
}