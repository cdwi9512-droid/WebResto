@extends('layout')
@section('title', 'Tambah Reservasi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Reservasi Manual</h2>
    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Orang</label>
                <input type="number" name="jumlah_orang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@endsection