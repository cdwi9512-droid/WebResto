@extends('layout')
@section('title', 'Tambah Data Resto')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Data Resto</h2>
    <a href="{{ route('resto.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('resto.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Resto</label>
                <input type="text" name="nama_resto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="telepon" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</div>

@endsection