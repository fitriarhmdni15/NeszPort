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
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Peminjaman</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Bukti Pengembalian</th>
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
                            @if ($item->bukti_pengembalian)
                                <img src="{{ asset('storage/' . $item->bukti_pengembalian) }}" alt="Bukti Pengembalian" width="100">
                            @else
                                Belum ada bukti
                            @endif
                        </td>
                        <td>
                            @if (!$item->bukti_pengembalian)
                                <form action="{{ route('pengembalian.store', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bukti_pengembalian">Unggah Bukti Pengembalian (Foto)</label>
                                        <input type="file" name="bukti_pengembalian" class="form-control" accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Kembalikan</button>
                                </form>
                            @else
                                <span class="text-success">Sudah Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('templates.components.footer')
</body>
</html>
