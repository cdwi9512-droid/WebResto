@extends('layout')
@section('title', 'Ubah Foto Gallery')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ubah Data Foto</h2>
    <a href="{{ route('galery.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('galery.update', $galery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Keterangan Foto</label>
                <input type="text" name="keterangan" value="{{ $galery->keterangan }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Resto</label>
                <select name="resto_id" class="form-select" required>
                    @foreach($resto as $r)
                    <option value="{{ $r->id }}" {{ $galery->resto_id == $r->id ? 'selected' : '' }}>{{ $r->nama_resto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                <img src="{{ asset($galery->gambar) }}" width="200" class="mb-2">
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Update Foto</button>
        </form>
    </div>
</div>

@endsection