@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Siswa</h1>
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $siswa->username }}" required>
        </div>
        <div class="form-group">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control" value="{{ $siswa->password }}" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $siswa->name }}" required>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ $siswa->kelas }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('admin.data_siswa') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
