@extends('layout')

@section('title', 'Web Resto')

@section('content')

<div class="text-center mt-5">
    <h1 class="fw-bold text-danger display-4">vercinda Resto 🍔</h1>
    <p class="mt-3 text-secondary fs-5">Menyediakan makanan lezat dan minuman terbaik untuk anda</p>
    <a href="/menu" class="btn btn-danger mt-3 px-4">Lihat Menu</a>
</div>

<div class="row mt-5">
    <div class="col-md-6">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div>
            <h2 class="fw-bold">Tentang Resto Kami</h2>
            <p class="text-secondary mt-3">
                vercinda Resto adalah restoran modern dengan suasana hangat dan elegan yang menghadirkan berbagai hidangan lezat dengan cita rasa premium. 
                vercinda Resto mengutamakan kualitas rasa, kenyamanan tempat, dan pelayanan terbaik untuk setiap pelanggan. Dengan desain modern dan nuansa hangat, restoran ini cocok digunakan sebagai tempat makan bersama keluarga, teman, maupun pasangan.
                Menu yang disajikan terdiri dari berbagai makanan modern seperti burger, steak, pizza, pasta, hingga minuman segar dengan tampilan yang menarik dan rasa berkualitas.
                <br><br>
                Slogan:<br>
                “Serving Happiness in Every Bite.” 🍽️
            </p>
            <p class="text-secondary">Tempat nyaman, makanan berkualitas,<br>dan pelayanan ramah 🌸</p>
        </div>
    </div>
</div>

<hr class="my-5">

{{-- BAGIAN DATA & TOMBOL CRUD --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Resto</h3>
    <a href="{{ route('resto.create') }}" class="btn btn-primary">+ Tambah Data</a>
</div>

{{-- NOTIFIKASI SUKSES --}}
@if(session('sukses'))
<div class="alert alert-success">{{ session('sukses') }}</div>
@endif

<table class="table table-bordered shadow">
    <thead class="table-dark">
        <tr>
            <th>Nama Resto</th>
            <th>deskripsi</th>
            <th>Alamat</th>
            <th>no</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($resto as $data)
        <tr>
            <td>{{ $data->nama_resto }}</td>
            <td>{{ $data->deskripsi}}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->no }}</td>
            <td>
                <a href="{{ route('resto.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('resto.destroy', $data->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection