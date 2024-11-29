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
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Bukti Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->jumlah_peminjaman }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->tanggal_pengembalian ?? '-' }}</td>
                    <td>
                        @if($item->bukti_pengembalian)
                            <img src="{{ asset('storage/' . $item->bukti_pengembalian) }}" alt="Bukti Pengembalian" width="80" class="img-thumbnail">
                        @else
                            <span class="text-danger">Belum ada</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
