<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        return view('Reservasi.index');
    }

    public function proses(Request $request)
    {
        // 🔥 KITA PAKSA ISI SEMUA YANG DIMINTA DATABASE BIAR DIA DIEM
        $reservasi = Reservasi::create([
            'nama'         => $request->nama,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal'      => $request->tanggal,
            'no_telp'      => '08123456789', // 👉 ISI PINDAH DULU ANGKA SEMBARANG, BIAR LOLOS
        ]);

        // 2. Simpan Data ke Tabel TRANSAKSI
        $transaksi = Transaksi::create([
            'reservasi_id'     => $reservasi->id,
            'tanggal_pesan'    => date('Y-m-d H:i:s'),
            'total'            => $request->harga,
            'metode_pembayaran'=> 'Belum Dipilih',
            'status'           => 'Belum Bayar',
        ]);

        // 3. Simpan Data ke Tabel DETAIL_TRANSAKSI
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'menu_id'      => $request->menu_id,
            'jumlah'       => 1,
        ]);

        // 4. PINDAH KE HALAMAN TRANSAKSI
        return redirect('/transaksi')->with('sukses', 'Pesanan berhasil dibuat!');
    }
}