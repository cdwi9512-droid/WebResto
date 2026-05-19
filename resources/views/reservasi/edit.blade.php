@extends('layout')
@section('title', 'Ubah Reservasi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ubah Data Reservasi</h2>
    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama" value="{{ $reservasi->nama }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" value="{{ $reservasi->no_telp }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Orang</label>
                <input type="number" name="jumlah_orang" value="{{ $reservasi->jumlah_orang }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $reservasi->tanggal }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jam</label>
                <input type="time" name="jam" value="{{ $reservasi->jam }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>

@endsection