@extends('layout')
@section('title', 'Reservasi & Pesan Makanan')
@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-success">Reservasi Meja 📝</h1>
    <p class="text-secondary">Silahkan lakukan reservasi untuk menikmati makanan terbaik kami</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                {{-- ⚠️ ACTION MENGARAH KE ROUTE "reservasi.proses" DAN PAKE METHOD POST --}}
                <form action="{{ route('reservasi.proses') }}" method="POST">
                    @csrf

                    {{-- Data Menu yang dipilih (Disembunyikan, tapi terbawa datanya) --}}
                    <input type="hidden" name="menu_id" value="{{ request('menu_id') }}">
                    <input type="hidden" name="harga" value="{{ request('harga') }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="08xxxxxxxxx" required>
                    </div>

                    {{-- 🔴 KOLOM INI: JUMLAH ORANG (Buat catat tamu) --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Orang</label>
                        <input type="number" name="jumlah_orang" class="form-control" min="1" placeholder="Jumlah orang" required>
                        <small class="text-muted">*Jumlah orang yang akan makan</small>
                    </div>

                    {{-- 🔴🔴🔴 KOLOM BARU INI YANG PALING PENTING! JUMLAH MAKANAN 🔴🔴🔴 --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold text-danger">Jumlah Pesanan Makanan 🥘</label>
                        <input type="number" name="jumlah_pesanan" class="form-control border-danger" min="1" value="1" placeholder="Isi jumlah porsi, misal: 5" required>
                        <small class="text-danger">*ISI DI SINI JUMLAH MAKANANNYA! (Contoh: 5, 10, dll)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Reservasi</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Reservasi</label>
                        <input type="time" name="jam" class="form-control" required>
                    </div>

                    {{-- Info Menu yang dipilih --}}
                    <div class="alert alert-info text-center">
                        <strong>Menu Dipilih:</strong>
                        <br>
                        {{-- Di sini bisa kamu panggil nama menunya kalau mau, tapi ini opsional --}}
                        Rp {{ number_format(request('harga'), 0, ',', '.') }} / Porsi
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">Booking Sekarang</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection