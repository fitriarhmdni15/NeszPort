<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Admin</h1>
    <a href="{{ route('admin.create') }}" class="btn btn-primary">Tambah Admin</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $key => $admin)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
