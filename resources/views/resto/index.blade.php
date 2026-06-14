@extends('layout')

@section('title', 'Web Resto')

@section('content')

{{-- BAGIAN JUDUL UTAMA --}}
<div class="text-center mt-5">
    <h1 class="fw-bold text-danger display-4">vercinda Resto 🍔</h1>
    {{-- Tulisan nama resto, besar, tebal, warna merah --}}
    
    <p class="mt-3 text-secondary fs-5">Menyediakan makanan lezat dan minuman terbaik untuk anda</p>
    {{-- Tulisan penjelasan singkat di bawah judul --}}
    
    <a href="/menu" class="btn btn-danger mt-3 px-4">Lihat Menu</a>
    {{-- Tombol merah, kalau diklik masuk ke halaman daftar menu --}}
</div>

{{-- BAGIAN TENTANG RESTO (GAMBAR + KETERANGAN) --}}
<div class="row mt-5">
    {{-- Bagian Kiri: Gambar --}}
    <div class="col-md-6">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000" class="img-fluid rounded shadow">
        {{-- Tampilkan gambar makanan dari internet, ukuran pas, sudut tumpul, ada bayangan --}}
    </div>

    {{-- Bagian Kanan: Penjelasan Tulisan --}}
    <div class="col-md-6 d-flex align-items-center">
        <div>
            <h2 class="fw-bold">Tentang Resto Kami</h2>
            {{-- Judul bagian penjelasan --}}
            
            <p class="text-secondary mt-3">
                vercinda Resto adalah restoran modern dengan suasana hangat dan elegan yang menghadirkan berbagai hidangan lezat dengan cita rasa premium. 
                vercinda Resto mengutamakan kualitas rasa, kenyamanan tempat, dan pelayanan terbaik untuk setiap pelanggan. Dengan desain modern dan nuansa hangat, restoran ini cocok digunakan sebagai tempat makan bersama keluarga, teman, maupun pasangan.
                Menu yang disajikan terdiri dari berbagai makanan modern seperti burger, steak, pizza, pasta, hingga minuman segar dengan tampilan yang menarik dan rasa berkualitas.
                <br><br>
                Slogan:<br>
                “Serving Happiness in Every Bite.” 🍽️
            </p>
            {{-- Isi penjelasan lengkap tentang resto, visi misi, sama slogannya --}}
            
            <p class="text-secondary">Tempat nyaman, makanan berkualitas,<br>dan pelayanan ramah 🌸</p>
            {{-- Kalimat penutup singkat --}}
        </div>
    </div>
</div>

<hr class="my-5">
{{-- Garis pemisah tebal antara bagian profil dan bagian data tabel --}}

{{-- BAGIAN JUDUL DATA & TOMBOL TAMBAH --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Resto</h3>
    {{-- Judul bagian tabel --}}
    
    <a href="{{ route('resto.create') }}" class="btn btn-primary">+ Tambah Data</a>
    {{-- Tombol biru di kanan atas, buat buka halaman tambah data baru --}}
</div>

{{-- NOTIFIKASI SUKSES JIKA BERHASIL SIMPAN/UBAH/HAPUS --}}
@if(session('sukses'))
<div class="alert alert-success">{{ session('sukses') }}</div>
@endif
{{-- Kalau ada pesan sukses dari Controller, muncul kotak hijau di sini --}}

{{-- TABEL DAFTAR DATA RESTO --}}
<table class="table table-bordered shadow">
    {{-- Bikin tabel dengan garis tepi dan bayangan --}}
    
    <thead class="table-dark">
        {{-- Kepala tabel, latar belakang warna gelap --}}
        <tr>
            <th>Nama Resto</th>
            <th>deskripsi</th>
            <th>Alamat</th>
            <th>no</th>
            <th>Aksi</th>
        </tr>
    </thead>
    
    <tbody>
        {{-- Perulangan buat nampilin SEMUA data yang diambil dari database --}}
        @foreach($resto as $data)
        <tr>
            <td>{{ $data->nama_resto }}</td> {{-- Tampilkan isi kolom nama_resto --}}
            <td>{{ $data->deskripsi}}</td>  {{-- Tampilkan isi kolom deskripsi --}}
            <td>{{ $data->alamat }}</td>    {{-- Tampilkan isi kolom alamat --}}
            <td>{{ $data->no }}</td>        {{-- Tampilkan isi kolom nomor telepon --}}
            
            <td>
                {{-- TOMBOL EDIT --}}
                <a href="{{ route('resto.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                {{-- Tombol kuning kecil, masuk ke halaman ubah data, bawa ID datanya --}}

                {{-- TOMBOL HAPUS --}}
                <form action="{{ route('resto.destroy', $data->id) }}" method="POST" class="d-inline">
                    @csrf           {{-- Kode pengaman wajib --}}
                    @method('DELETE') {{-- Perintah khusus Laravel buat hapus data --}}
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    {{-- Tombol merah kecil, diklik langsung hapus + ada peringatan konfirmasi dulu --}}
                </form>
            </td>
        </tr>
        @endforeach
        {{-- Akhir perulangan --}}
    </tbody>
</table>

@endsection
{{-- Penutup bagian isi halaman --}}