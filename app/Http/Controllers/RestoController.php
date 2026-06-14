<?php

namespace App\Http\Controllers;

use App\Models\Resto;

use Illuminate\Http\Request;

class RestoController extends Controller

{

    public function index()
    {
        // ➡️ Ambil SEMUA data resto dari database
        $resto = Resto::all();
        // ➡️ Tampilin halaman daftar, bawa data resto tadi masuk ke tampilan
        return view('resto.index', compact('resto')); 
    }

    public function create()
    {
        // ➡️ Cuma tampilin halaman formulir tambah data aja
        return view('resto.create');
    }

    public function store(Request $request)
    {
        // ➡️ Aturan: Semua kolom ini WAJIB diisi, gak boleh kosong
        $request->validate([
            'nama_resto' => 'required', // Nama resto harus ada isinya
            'deskripsi'  => 'required', // Penjelasan resto harus ada
            'alamat'     => 'required', // Alamat harus diisi
            'no'         => 'required'  // Nomor telepon harus diisi
        ]);

        // ➡️ Simpan SEMUA data yang diketik ke database
        Resto::create($request->all());
        // ➡️ Kalau udah simpan, balik lagi ke halaman daftar + kasih pesan sukses
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // ➡️ Cari data berdasarkan ID-nya. Kalau gak ketemu, langsung eror/404
        $resto = Resto::findOrFail($id);
        // ➡️ Tampilin halaman ubah data, bawa data lama buat ditampilin di kolom
        return view('resto.edit', compact('resto'));
    }

    public function update(Request $request, $id)
    {
        // ➡️ Sama kayak tambah data: Semua kolom WAJIB diisi lagi
        $request->validate([
            'nama_resto' => 'required',
            'deskripsi'  => 'required',
            'alamat'     => 'required',
            'no'         => 'required'
        ]);

        // ➡️ Cari data yang mau diubah pake ID
        $resto = Resto::findOrFail($id);
        // ➡️ Perbarui isinya dengan data baru yang diketik
        $resto->update($request->all());
        // ➡️ Balik ke daftar + kasih tau kalau udah berubah
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil diubah!');
    }

    public function destroy($id)
    {
        // ➡️ Cari datanya pake ID, langsung HAPUS sekalian
        Resto::findOrFail($id)->delete();
        // ➡️ Balik ke daftar + pesan kalau udah hilang
        return redirect()->route('resto.index')->with('sukses', 'Data Resto berhasil dihapus!');
    }
}