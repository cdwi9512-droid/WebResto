@extends('layout')

@section('title', 'Reservasi')

@section('content')

<div class="text-center mb-5">

    <h1 class="fw-bold text-danger">
        Reservasi Meja 🍽️
    </h1>

    <p class="text-secondary">
        Silahkan lakukan reservasi untuk menikmati makanan terbaik kami
    </p>

</div>

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow border-0">

            <div class="card-body p-4">

                {{-- TAMBAHKAN ini biar ada notif sukses --}}
                @if(session('sukses'))
                <div class="alert alert-success text-center">
                    {{ session('sukses') }}
                </div>
                @endif

                {{-- ✅ UBAH <form> JADI BEGINI, BIAR KIRIM DATA --}}
                <form action="/reservasi/proses" method="POST">
                    @csrf

                    {{-- ✅ TAMBAHKAN INI: Data menu yang dipilih (dari halaman Menu) --}}
                    <input type="hidden" name="menu_id" value="{{ request('menu_id') }}">
                    <input type="hidden" name="harga" value="{{ request('harga') }}">

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Nama Pelanggan
                        </label>
                        {{-- ✅ TAMBAHKAN name="nama" & required --}}
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Masukkan nama"
                               required>
                    </div>

                    {{-- Jumlah Orang --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Jumlah Orang
                        </label>
                        {{-- ✅ TAMBAHKAN name="jumlah_orang" & required --}}
                        <input type="number"
                               name="jumlah_orang"
                               class="form-control"
                               placeholder="Jumlah orang"
                               required>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Tanggal Reservasi
                        </label>
                        {{-- ✅ TAMBAHKAN name="tanggal" & required --}}
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               required>
                    </div>

                    {{-- Jam --}}
                    <div class="mb-4">
                        <label class="form-label">
                            Jam Reservasi
                        </label>
                        {{-- ✅ TAMBAHKAN name="jam" & required --}}
                        <input type="time"
                                class="form-control">
                    </div>

                    {{-- ✅ TAMBAHKAN: Ringkasan harga yang dipilih --}}
                    @if(request('harga'))
                    <div class="alert alert-info text-center mb-3">
                        <strong>Menu Dipilih:</strong> Rp {{ number_format(request('harga'), 0, ',', '.') }}
                    </div>
                    @endif

                    {{-- Tombol --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger px-4">
                            Booking Sekarang
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection