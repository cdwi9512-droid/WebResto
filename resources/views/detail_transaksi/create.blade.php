@extends('layout')
@section('title', 'Tambah Detail Transaksi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tambah Pesanan Menu</h2>
    <a href="{{ route('detail_transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow p-4">
    <form action="{{ route('detail_transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Transaksi</label>
            <select name="transaksi_id" class="form-select" required>
                <option value="">-- Pilih Nomor Transaksi --</option>
                @foreach($transaksi as $tr)
                <option value="{{ $tr->id }}">TRS-{{ $tr->id }} | {{ $tr->tanggal_pesan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Menu Makanan</label>
            <select name="menu_id" class="form-select" required>
                <option value="">-- Pilih Menu --</option>
                @foreach($menu as $mn)
                <option value="{{ $mn->id }}">{{ $mn->nama_menu }} | Rp {{ number_format($mn->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Pesanan</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>

        {{-- ⚠️ Kolom Sub Total TIDAK PERLU ADA DI FORM, KARENA DIHITUNG OTOMATIS DI CONTROLLER --}}

        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
</div>

@endsection