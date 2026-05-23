<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Menu;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    // Tampilkan Semua Data
    public function index()
    {
        // with() = ambil data terhubung biar tampil namanya bukan cuma id-nya
        $detail = DetailTransaksi::with('transaksi', 'menu')->get();
        return view('detail_transaksi.index', compact('detail'));
    }

    // Halaman Tambah
    public function create()
    {
        $transaksi = Transaksi::all(); // Ambil semua data transaksi
        $menu = Menu::all();           // Ambil semua data menu
        return view('detail_transaksi.create', compact('transaksi', 'menu'));
    }

    // Proses Simpan ke Database ✅ (SUDAH DIPERBAIKI TOTAL)
    public function store(Request $request)
    {
        // ✅ RUMUS HITUNG OTOMATIS: Ambil harga menu dikali jumlah pesanan
        $harga_menu = Menu::find($request->menu_id)->harga;
        $total_harga = $harga_menu * $request->jumlah;

        // ✅ BAGIAN DULU SALAH: $transaksi->id itu gak ada, harusnya $request->transaksi_id
        DetailTransaksi::create([
            'transaksi_id' => $request->transaksi_id, // ✅ DIPERBAIKI
            'menu_id'      => $request->menu_id,
            'jumlah'       => $request->jumlah,       // ✅ DULU ISINYA ANGKA 1, DIUBAH JADI SESUAI INPUTAN
            'sub_total'    => $total_harga            // ✅ DULU KURANG BARIS INI (PENYEBAB ERROR SUB_TOTAL)
        ]);

        return redirect()->route('detail_transaksi.index')->with('sukses', 'Data Berhasil Ditambahkan!');
    }

    // Halaman Ubah
    public function edit($id)
    {
        $detail = DetailTransaksi::find($id);
        $transaksi = Transaksi::all();
        $menu = Menu::all();
        return view('detail_transaksi.edit', compact('detail', 'transaksi', 'menu'));
    }

    // Proses Update Data ✅ (INI UDAH BENER KOK, TAPI TETAP KU MASUKIN BIAR LENGKAP)
    public function update(Request $request, $id)
    {
        // ✅ Hitung ulang kalau ada perubahan jumlah pesanan
        $harga_menu = Menu::find($request->menu_id)->harga;
        $total_harga = $harga_menu * $request->jumlah;

        $detail = DetailTransaksi::find($id);
        $detail->update([
            'transaksi_id' => $request->transaksi_id,
            'menu_id'      => $request->menu_id,
            'jumlah'       => $request->jumlah,
            'sub_total'    => $total_harga 
        ]);

        return redirect()->route('detail_transaksi.index')->with('sukses', 'Data Berhasil Diubah!');
    }

    // Proses Hapus
    public function destroy($id)
    {
        DetailTransaksi::destroy($id);
        return redirect()->route('detail_transaksi.index')->with('sukses', 'Data Berhasil Dihapus!');
    }
}