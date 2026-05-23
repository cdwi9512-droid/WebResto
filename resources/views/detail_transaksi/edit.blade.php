@extends('layout')
@section('title', 'Ubah Detail Transaksi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Ubah Pesanan Menu</h2>
    <a href="{{ route('detail_transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card shadow p-4">
    <form action="{{ route('detail_transaksi.update', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pilih Transaksi</label>
            <select name="transaksi_id" class="form-select" required>
                @foreach($transaksi as $tr)
                <option value="{{ $tr->id }}" {{ $detail->transaksi_id == $tr->id ? 'selected' : '' }}>
                    TRS-{{ $tr->id }} | {{ $tr->tanggal_pesan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Menu Makanan</label>
            <select name="menu_id" class="form-select" required>
                @foreach($menu as $mn)
                <option value="{{ $mn->id }}" {{ $detail->menu_id == $mn->id ? 'selected' : '' }}>
                    {{ $mn->nama_menu }} | Rp {{ number_format($mn->harga, 0, ',', '.') }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Pesanan</label>
            <input type="number" name="jumlah" value="{{ $detail->jumlah }}" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-warning">Update Data</button>
    </form>
</div>

@endsection