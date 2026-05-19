@extends('layout')
@section('title', 'Ubah Data Resto')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ubah Data Resto</h2>
    <a href="{{ route('resto.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('resto.update', $resto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Resto</label>
                <input type="text" name="nama_resto" value="{{ $resto->nama_resto }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ $resto->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required>{{ $resto->alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="telepon" value="{{ $resto->telepon }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Data</button>
        </form>
    </div>
</div>

@endsection