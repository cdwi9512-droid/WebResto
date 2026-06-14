<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class LoginController extends Controller
{
    // Tampilkan Halaman Login
    public function index()
    {
        return view('login');
    }

    // Proses Cek Login
    public function masuk(Request $request)
    {
        // Cari data user berdasarkan email
        $cek = User::where('email', $request->email)->first();

        // Cek kalau ada datanya DAN passwordnya cocok
        if ($cek && $cek->password == $request->password) {
            // Simpan data ke SESI (Tanda sudah masuk)
            session([
                'id' => $cek->id,
                'nama' => $cek->name,
                'email' => $cek->email
            ]);

            // Masuk ke dalam
            return redirect()->route('dashboard')->with('sukses', 'Selamat Datang, ' . $cek->name . '!');
        }

        // Kalau salah, balik lagi
        return redirect()->route('login')->with('pesan', 'Email atau Password salah!');
    }

    // Halaman Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Proses Logout (Keluar)
    public function keluar()
    {
        session()->flush(); // Hapus semua tanda masuk
        return redirect()->route('login')->with('pesan', 'Anda sudah keluar dari aplikasi!');
    }
}
