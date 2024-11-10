<!-- resources/views/admin/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Admin</h1>
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>
        <div class="form-group">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
