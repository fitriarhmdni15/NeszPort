<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeminjamanController extends Controller
{
    public function storePeminjaman(Request $request, $barang_id)
    {
        $barang = Barang::findOrFail($barang_id);

        if ($barang->jumlah < $request->jumlah_peminjaman) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        // Simpan riwayat peminjaman dalam session
        $peminjamanData = [
            'barang_id' => $barang_id,
            'jumlah_peminjaman' => $request->jumlah_peminjaman,
            'nama_peminjam' => $request->nama_peminjam,
            'kelas_jurusan' => $request->kelas_jurusan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
        ];

        // Jika session 'peminjaman' belum ada, buat array kosong
        $peminjamanHistory = session()->get('peminjaman', []);
        $peminjamanHistory[] = $peminjamanData;  // Menambahkan peminjaman baru ke riwayat
        session()->put('peminjaman', $peminjamanHistory);

        // Kurangi stok barang yang dipinjam
        $barang->jumlah -= $request->jumlah_peminjaman;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Peminjaman berhasil!');
    }

    public function storePengembalian(Request $request, $peminjamanId)
    {
            // Ambil riwayat peminjaman dari session
    $peminjamanHistory = session()->get('peminjaman', []);

    // Cari peminjaman terakhir berdasarkan barang_id
    $peminjaman = end($peminjamanHistory);  // Ambil peminjaman terakhir
    $barang = Barang::findOrFail($peminjaman['barang_id']);

    // Validasi pengembalian jumlah yang sesuai
    if ($barang->jumlah < 0) {
        return redirect()->back()->with('error', 'Jumlah barang tidak sesuai untuk pengembalian!');
    }

    // Tambahkan kembali jumlah barang yang dipinjam ke stok
    $barang->jumlah += $peminjaman['jumlah_peminjaman'];
    $barang->save();

    // Hapus riwayat peminjaman dari session
    session()->forget('peminjaman');

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dikembalikan!');
}
}
