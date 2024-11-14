@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Admin</h1>
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
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
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
