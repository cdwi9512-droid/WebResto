@extends('layout')
@section('title', 'Tambah Foto Gallery')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Foto Baru</h2>
    <a href="{{ route('galery.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('galery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Keterangan Foto</label>
                <input type="text" name="keterangan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Resto</label>
                <select name="resto_id" class="form-select" required>
                    <option value="">-- Pilih Resto --</option>
                    @foreach($resto as $r)
                    <option value="{{ $r->id }}">{{ $r->nama_resto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Gambar</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Foto</button>
        </form>
    </div>
</div>

@endsection