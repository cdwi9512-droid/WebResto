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
        return view('reservasi.index');
    }

    public function proses(Request $request)
    {
        // 🔥 VALIDASI DULU BIAR AMAN
        $request->validate([
            'nama' => 'required',
            'jumlah_orang' => 'required',
            'tanggal' => 'required',
            'jam' => 'required', // ➕ Ditambahkan
            'no_telp' => 'required', // ➕ Nanti aku tambah input di view-nya
        ]);

        // 1. Simpan Data ke Tabel RESERVASI
        $reservasi = Reservasi::create([
            'nama'         => $request->nama,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,       // ✅ Ambil dari input
            'no_telp'      => $request->no_telp,   // ✅ Ambil dari input
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