<!-- resources/views/admin/barang/stok.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manajemen Stok Barang</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Stok Tersedia</th>
                <th>Update Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <form action="{{ route('admin.barang.update-stok', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="number" name="stok" value="{{ $item->stok }}" min="0" class="form-control" style="width: 100px; display: inline-block;">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
