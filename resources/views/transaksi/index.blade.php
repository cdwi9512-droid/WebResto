@extends('layout')
@section('title', 'Transaksi')
@section('content')

<div class="text-center mb-5">
    <h1 class="fw-bold text-success">Transaksi Pembayaran 💳</h1>
    <p class="text-secondary">Silahkan lakukan pembayaran pesanan anda</p>
</div>

@if(session('sukses'))
<div class="alert alert-success text-center">{{ session('sukses') }}</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-7">
        @foreach ($transaksi as $item)
        <div class="card shadow border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="mb-4">Detail Pesanan 🍔</h3>
                <table class="table">
                    <tr>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                    {{-- ✅ KODE INI UDAH BENER, AKU TINGGALIN --}}
                    @foreach ($item->detail_transaksi as $detail)
                        <tr>
                            <td>{{ $detail->menu->nama_menu }}</td> 
                            {{-- ✅ TAMBAHKAN KATA "Porsi" BIAR JELAS --}}
                            <td><strong>{{ $detail->jumlah }}</strong> Porsi</td>           
                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td> 
                        </tr>
                    @endforeach
                </table>
                <hr>
                <div class="d-flex justify-content-between">
                    <h4>Total Bayar</h4>
                    {{-- ✅ BAGIAN INI YANG DIPERBAIKI: HITUNG OTOMATIS JUMLAH SEMUA SUB TOTAL --}}
                    @php
                        // Rumus ajaib: Jumlahkan semua harga dari detail pesanan di atas
                        $total_semua = $item->detail_transaksi->sum('sub_total');
                    @endphp
                    <h4 class="text-success">Rp {{ number_format($total_semua, 0, ',', '.') }}</h4>
                </div>
                <div class="mt-3 p-2 bg-light rounded">
                    <p class="mb-1"><strong>Nama Pemesan:</strong> {{ $item->reservasi->nama ?? 'Tidak ada data' }}</p>
                    <p class="mb-1"><strong>Tanggal Pesan:</strong> {{ $item->tanggal_pesan }}</p>
                    <p class="mb-1"><strong>Metode Bayar:</strong> {{ $item->metode_pembayaran }}</p>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        <label class="form-label d-block">Status Pembayaran</label>
                        @if($item->status == 'Lunas')
                            <span class="badge bg-success fs-6">{{ $item->status }}</span>
                        @else
                            <span class="badge bg-danger fs-6">{{ $item->status }}</span>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-primary">Ubah Status / Bayar</a>
                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus transaksi ini?')">Hapus</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endforeach

        @if($transaksi->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada data transaksi.
        </div>
        @endif

    </div>
</div>

@endsection