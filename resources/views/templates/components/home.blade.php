<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>Selamat Datang di Sistem Peminjaman Barang Olahraga</h1>
    <p>Pilih menu di bawah untuk melanjutkan:</p>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg mx-2">Admin</a>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-success btn-lg mx-2">Peminjaman</a>
        <a href="{{ route('barang.index') }}" class="btn btn-info btn-lg mx-2">Data Barang</a>
    </div>
</div>
@endsection
