@extends('layout')
@section('title', 'Tambah Menu')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Menu Baru</h2>
    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required>
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
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Menu</button>
        </form>
    </div>
</div>

@endsection