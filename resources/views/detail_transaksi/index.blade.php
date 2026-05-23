@extends('layout')
@section('title', 'Detail Transaksi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Detail Transaksi</h2>
    <a href="{{ route('detail_transaksi.create') }}" class="btn btn-primary">+ Tambah Pesanan</a>
</div>

@if(session('sukses'))
<div class="alert alert-success">{{ session('sukses') }}</div>
@endif

<table class="table table-bordered table-striped shadow">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nomor Transaksi</th>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Sub Total (Harga)</th> {{-- ✅ KOLOM BARU --}}
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail as $dt)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>TRS - {{ $dt->transaksi->id }}</td> {{-- Ambil nama dari relasi --}}
            <td>{{ $dt->menu->nama_menu }}</td> {{-- Ambil nama dari relasi --}}
            <td>{{ $dt->jumlah }} Porsi</td>
            {{-- ✅ TAMPILKAN SUB TOTAL DENGAN FORMAT RUPIAH --}}
            <td>Rp {{ number_format($dt->sub_total, 0, ',', '.') }}</td> 
            <td>
                <a href="{{ route('detail_transaksi.edit', $dt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('detail_transaksi.destroy', $dt->id) }}" method="POST" class="d-inline">
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