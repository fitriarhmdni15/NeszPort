@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Peminjaman</h2>
    <a href="{{ route('admin.data_peminjam') }}" class="btn btn-secondary mb-3">Kembali ke Data Peminjaman</a>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">Nama Barang: {{ $peminjaman->barang->nama_barang }}</h5>
            <p><strong>Nama Peminjam:</strong> {{ $peminjaman->user->username }}</p>
            <p><strong>Jumlah:</strong> {{ $peminjaman->jumlah_peminjaman }}</p>
            <p><strong>Tanggal Peminjaman:</strong> {{ $peminjaman->tanggal_peminjaman }}</p>
            <p><strong>Waktu Pengembalian:</strong> {{ $peminjaman->waktu_pengembalian ?? '-' }}</p>

            @if($peminjaman->bukti_pengembalian)
                <div class="mt-3">
                    <strong>Bukti Pengembalian:</strong><br>
                    <img src="{{ asset('storage/' . $peminjaman->bukti_pengembalian) }}" alt="Bukti Pengembalian" class="img-fluid img-thumbnail">
                </div>
            @else
                <p class="text-danger mt-3">Belum ada bukti pengembalian.</p>
            @endif
        </div>
    </div>
</div>
@endsection
