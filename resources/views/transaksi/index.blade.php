@extends('layout')

@section('title', 'Transaksi')

@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-success">
        Transaksi Pembayaran 💳
    </h1>
    <p class="text-secondary">
        Silahkan lakukan pembayaran pesanan anda
    </p>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">
        {{-- Looping setiap data transaksi --}}
        @foreach ($transaksi as $item)
        <div class="card shadow border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="mb-4">
                    Detail Pesanan 🍔
                </h3>

                <table class="table">
                    <tr>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>

                    {{-- Looping menu yang ada di transaksi ini --}}
                    @foreach ($item->menus as $menu)
                    <tr>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->pivot->jumlah }}</td>
                        <td>Rp {{ number_format($menu->harga * $menu->pivot->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach

                </table>

                <hr>

                <div class="d-flex justify-content-between">
                    <h4>Total Bayar</h4>
                    <h4 class="text-success">
                        Rp {{ number_format($item->total, 0, ',', '.') }}
                    </h4>
                </div>

                {{-- Tampil data reservasi kalau mau --}}
                <div class="mt-3 p-2 bg-light rounded">
                    <p class="mb-1"><strong>Nama Pemesan:</strong> {{ $item->reservasi->nama ?? 'Tidak ada data' }}</p>
                    <p class="mb-1"><strong>Tanggal Pesan:</strong> {{ $item->tanggal_pesan }}</p>
                    <p class="mb-1"><strong>Metode Bayar:</strong> {{ $item->metode_pembayaran }}</p>
                </div>

                <div class="mt-4">
                    <label class="form-label">Status Pembayaran</label>
                    <span class="badge bg-success">{{ $item->status }}</span>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-success px-4">
                        Bayar Sekarang
                    </button>
                </div>

            </div>
        </div>
        @endforeach

        {{-- Kalau data kosong --}}
        @if($transaksi->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada data transaksi.
        </div>
        @endif

    </div>
</div>

@endsection