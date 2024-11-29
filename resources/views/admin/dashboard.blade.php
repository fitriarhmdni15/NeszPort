@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Dashboard Admin</h1>
    <hr>
    <div class="d-flex flex-column align-items-center gap-3">
        <a href="{{ route('admin.data_siswa') }}" class="btn btn-primary btn-lg w-50">Data Siswa</a>
        <a href="{{ route('admin.data_barang') }}" class="btn btn-success btn-lg w-50">Data Barang</a>
        <a href="{{ route('admin.data_admin') }}" class="btn btn-info btn-lg w-50">Data Admin</a>
        <a href="{{ route('admin.data_peminjam') }}" class="btn btn-warning btn-lg w-50">Data Peminjam</a>
    </div>
</div>
@endsection
