<!-- resources/views/barang/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Barang</h1>
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label for="image">Gambar Barang</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Barang</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
