@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <!-- Daftar Barang -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3>Daftar Barang</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">Tambah Barang</a>
                    <table class="table table-bordered">
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
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_barang }}" width="80">
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
            </div>
        </div>

        <!-- Daftar Bukti Pengembalian -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h3>Bukti Pengembalian</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Nama Peminjam</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->user->username }}</td>
                                <td>
                                    @if($item->bukti_pengembalian)
                                        <a href="{{ asset('storage/' . $item->bukti_pengembalian) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->bukti_pengembalian) }}" alt="Bukti" width="80">
                                        </a>
                                    @else
                                        <span class="text-danger">Belum ada bukti</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Daftar Admin -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h3>Daftar Admin</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.create') }}" class="btn btn-success mb-3">Tambah Admin</a>
                    <table class="table table-bordered">
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
            </div>
        </div>

        <!-- Daftar Siswa -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3>Daftar Siswa</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('siswa.create') }}" class="btn btn-success mb-3">Tambah Siswa</a>
                    <table class="table table-bordered">
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
    </div>
</div>
@endsection
