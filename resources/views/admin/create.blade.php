<!-- resources/views/admin/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Admin</h1>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
