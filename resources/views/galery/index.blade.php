@extends('layout')
@section('title', 'Gallery')
@section('content')

<style>
    .gallery-img{
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
        transition: 0.3s;
    }
    .gallery-img:hover{
        transform: scale(1.03);
    }
</style>

<div class="text-center mb-5">
    <h1 class="fw-bold text-danger">Gallery Resto 🍽️</h1>
    <p class="text-secondary">Beberapa makanan favorit di restoran kami</p>
    <a href="{{ route('galery.create') }}" class="btn btn-primary mt-2">+ Tambah Foto Baru</a>
</div>

@if(session('sukses'))
<div class="alert alert-success text-center">{{ session('sukses') }}</div>
@endif

<div class="row g-4">
    {{-- UBAH: Sekarang baca dari Database, bukan array --}}
    @foreach ($galery as $item)
    <div class="col-md-4">
        <div class="card shadow border-0">
            <img src="{{ asset($item->gambar) }}" class="gallery-img" alt="{{ $item->keterangan }}">
            <div class="card-body text-center">
                <p>{{ $item->keterangan }}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('galery.edit', $item->id) }}" class="btn btn-sm btn-warning w-50 me-1">Edit</a>
                    <form action="{{ route('galery.destroy', $item->id) }}" method="POST" class="w-50">
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