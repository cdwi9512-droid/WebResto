@extends('layout') {{-- PAKAI LAYOUT UTAMA KAMU --}}

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Selamat Datang, {{ session('nama') }} 🎉</h2>
    <a href="{{ route('logout') }}" class="btn btn-danger" onclick="return confirm('Yakin ingin keluar?')">Keluar</a>
</div>

<div class="card shadow p-4">
    <h4>Panel Administrasi Restoran</h4>
    <p>Selamat bekerja, gunakan menu di samping untuk mengelola data Resto, Menu, Reservasi, dan Transaksi.</p>
</div>
@endsection