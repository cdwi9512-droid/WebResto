@extends('layout')

@section('title', 'Menu Resto')

@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-danger">Daftar Menu 🍽️</h1>
    <p class="text-secondary">
        Pilih makanan favorit anda
    </p>
</div>

<div class="row">

    {{-- LOOPING DATA DARI DATABASE --}}
    @foreach($menu as $item)
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            
            <img src="{{ $item->gambar }}" 
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">

            <div class="card-body text-center">
                <h4>{{ $item->nama_menu }}</h4>
                
                <p class="text-secondary">
                    {{ $item->deskripsi }}
                </p>

                <h5 class="text-danger">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </h5>

                <a href="/reservasi?menu_id={{ $item->id }}&harga={{ $item->harga }}" class="btn btn-dark w-100">
                    Pesan Sekarang
                </a>

            </div>
        </div>
    </div>
    @endforeach

</div>

@endsection