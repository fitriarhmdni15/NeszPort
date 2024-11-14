@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="row">
        <!-- Daftar Barang -->
        <div class="col-md-4">
            <h2>Daftar Barang</h2>
            <a href="{{ route('barang.create') }}" class="btn btn-primary mb-2">Tambah Barang</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Gambar</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" width="100">
                        </td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" style="display:inline;">
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

        <!-- Daftar Admin -->
        <div class="col-md-4">
            <h2>Daftar Admin</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary mb-2">Tambah Admin</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $key => $admin)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $admin->username }}</td>
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

        <!-- Daftar Siswa -->
        <div class="col-md-4">
            <h2>Daftar Siswa</h2>
            <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-2">Tambah Siswa</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $key => $siswaItem)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $siswaItem->username }}</td>
                        <td>
                            <a href="{{ route('siswa.edit', $siswaItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('siswa.destroy', $siswaItem->id) }}" method="POST" style="display:inline;">
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
    </div>
</div>
@endsection
