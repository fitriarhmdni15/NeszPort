<!DOCTYPE html>
<html lang="en">
<head>
    <title>NesZport - History Peminjaman</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/logo.ico') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Bukti Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->tanggal_peminjaman }}</td>
                    <td>{{ $item->jumlah_peminjaman }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        @if ($item->bukti_pengembalian)
                            <a href="{{ asset('storage/' . $item->bukti_pengembalian) }}" target="_blank">Lihat Bukti</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 'Dipinjam')
                            <!-- Tombol Pengembalian -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pengembalianModal{{ $item->id }}">
                                Pengembalian
                            </button>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <!-- Modal Pengembalian -->
                <div class="modal fade" id="pengembalianModal{{ $item->id }}" tabindex="-1" aria-labelledby="pengembalianModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pengembalianModalLabel{{ $item->id }}">Form Pengembalian Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pengembalian.store', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Nama Barang -->
                                    <div class="mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" value="{{ $item->barang->nama_barang }}" readonly>
                                    </div>
                                    <!-- Jumlah Peminjaman -->
                                    <div class="mb-3">
                                        <label for="jumlah_peminjaman" class="form-label">Jumlah Peminjaman</label>
                                        <input type="number" class="form-control" id="jumlah_peminjaman" value="{{ $item->jumlah_peminjaman }}" readonly>
                                    </div>
                                    <!-- Tanggal Peminjaman -->
                                    <div class="mb-3">
                                        <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
                                        <input type="text" class="form-control" id="tanggal_peminjaman" value="{{ $item->tanggal_peminjaman }}" readonly>
                                    </div>
                                    <!-- Waktu Pengembalian -->
                                    <div class="mb-3">
                                        <label for="waktu_pengembalian" class="form-label">Waktu Pengembalian</label>
                                        <input type="datetime-local" class="form-control" name="waktu_pengembalian" required>
                                    </div>
                                    <!-- Bukti Pengembalian -->
                                    <div class="mb-3">
                                        <label for="bukti_pengembalian" class="form-label">Bukti Pengembalian</label>
                                        <input type="file" class="form-control" name="bukti_pengembalian" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('templates.components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
