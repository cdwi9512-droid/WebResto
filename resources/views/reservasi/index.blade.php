@extends('layout')
@section('title', 'Reservasi')
@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-danger">Reservasi Meja 🍽️</h1>
    <p class="text-secondary">Silahkan lakukan reservasi untuk menikmati makanan terbaik kami</p>
</div>

{{-- FORM PESAN DARI MENU (KODE ASLIMU TETAP ADA DI ATAS) --}}
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                @if(session('sukses'))
                <div class="alert alert-success text-center">{{ session('sukses') }}</div>
                @endif

                <form action="{{ route('reservasi.proses') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ request('menu_id') }}">
                    <input type="hidden" name="harga" value="{{ request('harga') }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="08xxxxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Orang</label>
                        <input type="number" name="jumlah_orang" class="form-control" placeholder="Jumlah orang" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Reservasi</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Jam Reservasi</label>
                        <input type="time" name="jam" class="form-control" required>
                    </div>

                    @if(request('harga'))
                    <div class="alert alert-info text-center mb-3">
                        <strong>Menu Dipilih:</strong> Rp {{ number_format(request('harga'), 0, ',', '.') }}
                    </div>
                    @endif

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger px-4">Booking Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<hr class="my-5">

{{-- BAGIAN DATA RESERVASI & CRUD --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Semua Reservasi</h3>
    <a href="{{ route('reservasi.create') }}" class="btn btn-primary">+ Tambah Manual</a>
</div>

<table class="table table-bordered shadow">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Telp</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservasi as $r)
        <tr>
            <td>{{ $r->nama }}</td>
            <td>{{ $r->no_telp }}</td>
            <td>{{ $r->jumlah_orang }} Orang</td>
            <td>{{ $r->tanggal }}</td>
            <td>{{ $r->jam }}</td>
            <td>
                <a href="{{ route('reservasi.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('reservasi.destroy', $r->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection