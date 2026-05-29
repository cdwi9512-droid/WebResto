<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Menu; // ✅ UDAH ADA, BAGUS!
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::all();
        return view('reservasi.index', compact('reservasi'));
    }

    public function create()
    {
        return view('reservasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required',
            'jumlah_orang' => 'required',
            'tanggal'      => 'required',
            'jam'          => 'required',
            'no_telp'      => 'required'
        ]);

        Reservasi::create($request->all());
        return redirect()->route('reservasi.index')->with('sukses', 'Reservasi berhasil ditambahkan!');
    }

    // ✅ ✅ ✅ BAGIAN INI YANG PALING PENTING SUDAH DIPERBAIKI ✅ ✅ ✅
    public function proses(Request $request)
    {
        // 1. SIMPAN DATA RESERVASI (NAMA, TELP, JUMLAH ORANG)
        $reservasi = Reservasi::create([
            'nama'         => $request->nama,
            'jumlah_orang' => $request->jumlah_orang, // ⚠️ Ini jumlah orang makan, BUKAN jumlah makanan!
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'no_telp'      => $request->no_telp,
        ]);

        // 2. BUAT DATA TRANSAKSI UTAMA
        $transaksi = Transaksi::create([
            'reservasi_id'     => $reservasi->id,
            'tanggal_pesan'    => date('Y-m-d H:i:s'),
            'total'            => 0, // ⚠️ AWALNYA 0, NANTI DIHITUNG OTOMATIS
            'metode_pembayaran'=> 'Belum Dipilih',
            'status'           => 'Belum Bayar',
        ]);

        // ✅ BAGIAN YANG DIPERBAIKI: SEKARANG JUMLAHNYA BISA DIISI!
        // Kita ambil input jumlah pesanan dari form reservasi nanti
        $jumlah_pesanan = $request->jumlah_pesanan ?? 1; // Kalau kosong, otomatis 1

        // 3. SIMPAN KE DETAIL TRANSAKSI (RINCIAN MAKANANNYA)
        $harga_menu = Menu::find($request->menu_id)->harga;
        $sub_total  = $harga_menu * $jumlah_pesanan; // ✅ DIKALI SESUAI JUMLAH YANG KAMU ISI!

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'menu_id'      => $request->menu_id,
            'jumlah'       => $jumlah_pesanan, // ✅ BUKAN LAGI ANGKA 1 KERAS!
            'sub_total'    => $sub_total 
        ]);

        // ✅ HITUNG DAN SIMPAN TOTAL AKHIR KE TABEL TRANSAKSI
        $transaksi->total = $transaksi->detail_transaksi->sum('sub_total');
        $transaksi->save();

        // ✅ DIARAHKAN KE HALAMAN TAMBAH PESANAN, BIAR BISA NAMBAH MAKANAN LAIN KALO MAU
        return redirect()->route('detail_transaksi.create')
                         ->with('sukses', 'Pesanan Awal Berhasil! Silahkan Tambah Menu Lain atau Lanjut ke Pembayaran.');
    }

    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('reservasi.edit', compact('reservasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required',
            'jumlah_orang' => 'required',
            'tanggal'      => 'required',
            'jam'          => 'required',
            'no_telp'      => 'required'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update($request->all());
        return redirect()->route('reservasi.index')->with('sukses', 'Reservasi berhasil diubah!');
    }

    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();
        return redirect()->route('reservasi.index')->with('sukses', 'Reservasi berhasil dihapus!');
    }
}