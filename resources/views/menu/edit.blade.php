@extends('layout')
@section('title', 'Ubah Menu')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ubah Menu</h2>
    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $menu->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pilih Resto</label>
                <select name="resto_id" class="form-select" required>
                    @foreach($resto as $r)
                    <option value="{{ $r->id }}" {{ $menu->resto_id == $r->id ? 'selected' : '' }}>{{ $r->nama_resto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                <img src="{{ asset($menu->gambar) }}" width="150" class="mb-2">
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Update Menu</button>
        </form>
    </div>
</div>

@endsection