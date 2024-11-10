<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function storePeminjaman(Request $request, $barangId)
    {
        $barang = Barang::findOrFail($barangId);

        // Cek stok barang
        if ($barang->jumlah <= 0) {
            return redirect()->back()->with('error', 'Barang ini tidak tersedia untuk dipinjam.');
        }

        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'kelas_jurusan' => 'required|string|max:255',
            'tanggal_peminjaman' => 'required|date',
        ]);

        // Simpan data peminjaman
        Peminjaman::create([
            'barang_id' => $barang->id,
            'nama_peminjam' => $request->nama_peminjam,
            'kelas_jurusan' => $request->kelas_jurusan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
        ]);

        // Kurangi stok barang
        $barang->decrement('jumlah');

        return redirect()->back()->with('success', 'Peminjaman berhasil disimpan.');
    }

    public function storePengembalian(Request $request, $peminjamanId)
    {
        $request->validate([
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($peminjamanId);
        $barang = $peminjaman->barang;

        // Simpan tanggal pengembalian
        $peminjaman->update([
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
        ]);

        // Kembalikan stok barang
        $barang->increment('jumlah');

        return redirect()->back()->with('success', 'Pengembalian berhasil disimpan.');
    }
}
