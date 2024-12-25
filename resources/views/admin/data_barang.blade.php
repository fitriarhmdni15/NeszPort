@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('barang.show', $item->id) }}" class="btn btn-secondary btn-sm">Detail</a>
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
