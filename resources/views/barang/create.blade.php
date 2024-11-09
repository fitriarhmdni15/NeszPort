<!-- resources/views/barang/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Barang</h1>
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
