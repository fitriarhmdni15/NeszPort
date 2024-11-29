@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Siswa</h1>
    <a href="{{ route('siswa.create') }}" class="btn btn-success mb-3">Tambah Siswa</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $key => $siswaItem)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $siswaItem->username }}</td>
                <td>{{ $siswaItem->name }}</td>
                <td>{{ $siswaItem->kelas }}</td>
                <td>
                    <a href="{{ route('siswa.edit', $siswaItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('siswa.destroy', $siswaItem->id) }}" method="POST" class="d-inline">
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
