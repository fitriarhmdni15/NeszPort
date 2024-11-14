<!-- resources/views/barang/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Barang</h1>
    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
        </div>
        <div class="form-group">
            <label>Gambar Barang</label>
            <input type="file" name="image" class="form-control">
            <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $barang->jumlah }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
