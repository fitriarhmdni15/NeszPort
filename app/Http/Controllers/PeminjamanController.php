<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function storePeminjaman(Request $request, $barang_id)
    {
        $barang = Barang::findOrFail($barang_id);

        if ($barang->jumlah < $request->jumlah_peminjaman) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        // Kurangi stok barang
        $barang->jumlah -= $request->jumlah_peminjaman;
        $barang->save();

        // Simpan data peminjaman ke database
        Peminjaman::create([
            'user_id' => auth()->id(),
            'barang_id' => $barang->id,
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'jumlah_peminjaman' => $request->jumlah_peminjaman,
        ]);

        return redirect()->route('peminjaman.history')->with('success', 'Peminjaman berhasil!');
    }

    public function storePengembalian(Request $request, $peminjamanId)
    {
        // Validasi role user
        if (auth()->user()->role !== 'siswa') {
            abort(403, 'Akses Ditolak');
        }

        // Ambil peminjaman dari database
        $peminjaman = Peminjaman::findOrFail($peminjamanId);

        // Ambil barang terkait
        $barang = Barang::findOrFail($peminjaman->barang_id);

        // Tambahkan stok barang kembali
        $barang->jumlah += $peminjaman->jumlah_peminjaman;
        $barang->save();

        // Hapus peminjaman dari database
        $peminjaman->delete();

        return redirect()->route('peminjaman.history')->with('success', 'Barang berhasil dikembalikan!');
    }

    public function history()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->with('barang') // Relasi ke barang
            ->get();

        return view('siswa.history', compact('peminjaman'));
    }
}
