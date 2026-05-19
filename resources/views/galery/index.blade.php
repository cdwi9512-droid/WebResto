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

    <h1 class="fw-bold text-danger">
        Gallery Resto 🍽️
    </h1>

    <p class="text-secondary">
        Beberapa makanan favorit di restoran kami
    </p>

</div>

<div class="row g-4">

    @foreach ($photos as $galery)

        <div class="col-md-4">

            <div class="card shadow border-0">

                <img src="{{ $galery }}"
                     class="gallery-img">

            </div>

        </div>

    @endforeach

</div>

@endsection