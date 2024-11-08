<!-- resources/views/peminjaman/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Alat Olahraga</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Form Data Peminjaman Alat Olahraga</h1>
    
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"><br><br>

        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" value="{{ old('kelas') }}"><br><br>

        <label for="jurusan">Jurusan:</label><br>
        <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}"><br><br>

        <label for="nis">NIS:</label><br>
        <input type="number" id="nis" name="nis" value="{{ old('nis') }}"><br><br>

        <label for="barang">Barang yang Dipinjam:</label><br>
        <input type="text" id="barang" name="barang" value="{{ old('barang') }}"><br><br>

        <label for="jumlah">Jumlah Peminjaman:</label><br>
        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}"><br><br>

        <label for="tanggal">Tanggal Peminjaman:</label><br>
        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
