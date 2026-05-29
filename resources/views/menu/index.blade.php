@extends('layout')
@section('title', 'Menu Resto')
@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-danger">Daftar Menu 🍽️</h1>
    <p class="text-secondary">Pilih makanan favorit anda</p>
    <a href="{{ route('menu.create') }}" class="btn btn-primary mt-2">+ Tambah Menu Baru</a>
</div>

{{-- NOTIFIKASI SUKSES --}}
@if(session('sukses'))
<div class="alert alert-success text-center">{{ session('sukses') }}</div>
@endif

<div class="row">
    @foreach($menu as $item)
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <img src="{{ asset($item->gambar) }}" class="card-img-top" style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>{{ $item->nama_menu }}</h4>
                <p class="text-secondary">{{ $item->deskripsi }}</p>
                <h5 class="text-danger">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                <a href="/pesan-sekarang?menu_id={{ $item->id }}&harga={{ $item->harga }}" class="btn btn-dark w-100">Pesan Sekarang</a>
                
                {{-- TOMBOL EDIT & HAPUS --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-sm btn-warning w-50 me-1">Edit</a>
                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST" class="w-50">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection