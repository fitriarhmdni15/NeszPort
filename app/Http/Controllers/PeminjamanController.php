<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    // Store peminjaman
    public function storePeminjaman(Request $request, $barang_id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'jumlah_peminjaman' => 'required|integer|min:1|max:10',
        ]);

        $barang = Barang::findOrFail($barang_id);

        // Periksa stok barang
        if ($barang->jumlah < $validated['jumlah_peminjaman']) {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        // Kurangi stok barang
        $barang->decrement('jumlah', $validated['jumlah_peminjaman']);

        // Simpan data peminjaman ke database
        Peminjaman::create([
            'user_id' => auth()->id(), // Ambil user yang sedang login
            'barang_id' => $barang->id,
            'tanggal_peminjaman' => $validated['tanggal_peminjaman'],
            'jumlah_peminjaman' => $validated['jumlah_peminjaman'],
            'status' => 'Dipinjam', // Tambahkan status default
        ]);

        return redirect()->route('peminjaman.history')->with('success', 'Peminjaman berhasil!');
    }

    // Store pengembalian
    public function storePengembalian(Request $request, $peminjamanId)
    {
        $peminjaman = Peminjaman::findOrFail($peminjamanId);

        // Validasi input
        $validated = $request->validate([
            'bukti_pengembalian' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'waktu_pengembalian' => 'required|date',
        ]);

        // Simpan file bukti pengembalian
        $path = $request->file('bukti_pengembalian')->store('bukti_pengembalian', 'public');

        // Gunakan transaksi database
        DB::transaction(function () use ($peminjaman, $path) {
            // Update status peminjaman
            $peminjaman->update([
                'bukti_pengembalian' => $path,
                'waktu_pengembalian' => now(),
                'status' => 'Diajukan',
            ]);
        });

        return redirect()->route('peminjaman.history')->with('success', 'Pengajuan Pengembalian Berhasil.');
    }

    // Tampilkan riwayat peminjaman
    public function history()
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->with(['barang', 'user']) // Relasi ke barang dan user
            ->get();

        return view('siswa.history', compact('peminjaman'));
    }
}
