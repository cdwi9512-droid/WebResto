@extends('layout')

@section('title', 'Web Resto')

@section('content')

<div class="text-center mt-5">

    <h1 class="fw-bold text-danger display-4">
        vercinda Resto 🍔
    </h1>

    <p class="mt-3 text-secondary fs-5">
        Menyediakan makanan lezat dan minuman terbaik untuk anda
    </p>

    <a href="/menu" class="btn btn-danger mt-3 px-4">
        Lihat Menu
    </a>

</div>

<div class="row mt-5">

    <div class="col-md-6">

        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000"
             class="img-fluid rounded shadow">

    </div>

    <div class="col-md-6 d-flex align-items-center">

        <div>

            <h2 class="fw-bold">
                Tentang Resto Kami
            </h2>

            <p class="text-secondary mt-3">
                vercinda Resto adalah restoran modern dengan suasana hangat dan elegan yang menghadirkan berbagai hidangan lezat dengan cita rasa premium. 
vercinda Resto mengutamakan kualitas rasa, kenyamanan tempat, dan pelayanan terbaik untuk setiap pelanggan. Dengan desain modern dan nuansa hangat, restoran ini cocok digunakan sebagai tempat makan bersama keluarga, teman, maupun pasangan.

Menu yang disajikan terdiri dari berbagai makanan modern seperti burger, steak, pizza, pasta, hingga minuman segar dengan tampilan yang menarik dan rasa berkualitas.

Slogan:
“Serving Happiness in Every Bite.” 🍽️

            </p>

            <p class="text-secondary">
                Tempat nyaman, makanan berkualitas,
                dan pelayanan ramah 🌸
            </p>

        </div>

    </div>

</div>

@endsection