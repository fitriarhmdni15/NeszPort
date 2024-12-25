@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Peminjaman</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Peminjam</th>
                    <th>Kelas & Jurusan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->user->kelas }}</td>
                    <td>{{ $item->jumlah_peminjaman }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->waktu_pengembalian ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.peminjaman.detail', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
