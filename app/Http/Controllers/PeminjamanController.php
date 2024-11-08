<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function create()
    {
        return view('peminjaman.create');
    }

    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'jurusan' => 'required|string|max:100',
            'nis' => 'required|numeric',
            'barang' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        // Simpan data ke database (tambahkan logika penyimpanan sesuai kebutuhan)

        return redirect()->route('peminjaman.create')->with('success', 'Data peminjaman berhasil disimpan!');
    }
}
