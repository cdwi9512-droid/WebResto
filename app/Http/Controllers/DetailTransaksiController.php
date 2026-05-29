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

    // Proses Simpan ke Database ✅ (SUDAH DIPERBAIKI + TAMBAH HITUNG TOTAL OTOMATIS)
    public function store(Request $request)
    {
        // ✅ RUMUS HITUNG OTOMATIS: Ambil harga menu dikali jumlah pesanan
        $harga_menu = Menu::find($request->menu_id)->harga;
        $total_harga = $harga_menu * $request->jumlah;

        // ✅ Simpan data rincian pesanan
        DetailTransaksi::create([
            'transaksi_id' => $request->transaksi_id, // ✅ DIPERBAIKI
            'menu_id'      => $request->menu_id,
            'jumlah'       => $request->jumlah,       // ✅ SESUAI INPUTAN
            'sub_total'    => $total_harga            // ✅ SIMPAN HASIL HITUNGAN
        ]);

        // ⭐⭐ TAMBAHAN PENTING: HITUNG DAN SIMPAN TOTAL KE TABEL UTAMA TRANSAKSI ⭐⭐
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->total = $transaksi->detail_transaksi->sum('sub_total');
        $transaksi->save();

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

    // Proses Update Data ✅ (SUDAH BENER + TAMBAH HITUNG ULANG)
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

        // ⭐⭐ TAMBAHAN PENTING: HITUNG ULANG SETELAH ADA PERUBAHAN ⭐⭐
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->total = $transaksi->detail_transaksi->sum('sub_total');
        $transaksi->save();

        return redirect()->route('detail_transaksi.index')->with('sukses', 'Data Berhasil Diubah!');
    }

    // Proses Hapus ✅ (DIPERBAIKI BIAR PAS DIHAPUS TOTALNYA JUGA BERKURANG)
    public function destroy($id)
    {
        // ⭐⭐ CARANYA: Ambil dulu datanya sebelum dihapus, biar tau transaksi mana yg berkurang ⭐⭐
        $detail = DetailTransaksi::findOrFail($id);
        $id_transaksi = $detail->transaksi_id; // Simpan nomor transaksinya dulu
        $detail->delete(); // Baru dihapus

        // ⭐⭐ HITUNG ULANG TOTALNYA KARENA ADA BARANG YANG DIHAPUS ⭐⭐
        $transaksi = Transaksi::find($id_transaksi);
        $transaksi->total = $transaksi->detail_transaksi->sum('sub_total');
        $transaksi->save();

        return redirect()->route('detail_transaksi.index')->with('sukses', 'Data Berhasil Dihapus!');
    }
}