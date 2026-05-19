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

    // Fungsi asli kamu tetap ada di sini (Proses Pesan dari Menu)
    public function proses(Request $request)
    {
        $reservasi = Reservasi::create([
            'nama'         => $request->nama,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal'      => $request->tanggal,
            'jam'          => $request->jam,
            'no_telp'      => $request->no_telp,
        ]);

        $transaksi = Transaksi::create([
            'reservasi_id'     => $reservasi->id,
            'tanggal_pesan'    => date('Y-m-d H:i:s'),
            'total'            => $request->harga,
            'metode_pembayaran'=> 'Belum Dipilih',
            'status'           => 'Belum Bayar',
        ]);

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'menu_id'      => $request->menu_id,
            'jumlah'       => 1,
        ]);

        return redirect('/transaksi')->with('sukses', 'Pesanan berhasil dibuat!');
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