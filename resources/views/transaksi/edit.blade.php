@extends('layout')
@section('title', 'Proses Pembayaran')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Proses Pembayaran 💳</h2>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Pemesan:</strong></label>
                        <input type="text" class="form-control" value="{{ $transaksi->reservasi->nama ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Total Bayar:</strong></label>
                        <input type="text" class="form-control bg-light" value="Rp {{ number_format($transaksi->total, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="Belum Dipilih" {{ $transaksi->metode_pembayaran == 'Belum Dipilih' ? 'selected' : '' }}>-- Pilih Metode --</option>
                            <option value="Tunai" {{ $transaksi->metode_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer Bank" {{ $transaksi->metode_pembayaran == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="E-Wallet" {{ $transaksi->metode_pembayaran == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (QRIS/Gopay/Dana)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="status" class="form-select" required>
                            <option value="Belum Bayar" {{ $transaksi->status == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="Lunas" {{ $transaksi->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Batal" {{ $transaksi->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success w-100">
                            ✅ Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection