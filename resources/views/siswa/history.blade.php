<!DOCTYPE html>
<html lang="en">
<head>
    <title>NesZport - History Peminjaman</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/logo.ico') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
</head>
<body>
    @include('templates.components.navbar')

    <div class="container mt-5">
        <h2>Riwayat Peminjaman</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Peminjaman</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $item)
                    <tr>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->jumlah_peminjaman }}</td>
                        <td>{{ $item->tanggal_peminjaman }}</td>
                        <td>
                            <form action="{{ route('pengembalian.store', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('templates.components.footer')
</body>
</html>
