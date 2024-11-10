<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Admin;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Ambil data barang dan data admin
        $barang = Barang::all();
        $admins = Admin::all();  // Ambil semua data admin

        // Kirim data barang dan admin ke view dashboard
        return view('admin.dashboard', compact('barang', 'admins'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk file gambar
            'jumlah' => 'required|integer|min:1',
        ]);

        // Menyimpan gambar ke folder public/images
        $imagePath = $request->file('image')->store('images', 'public');  // menyimpan gambar

        // Simpan barang ke database
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'image' => $imagePath, // menyimpan path gambar
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }



    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    // Menampilkan stok barang untuk admin
    public function showStok()
    {
        $barang = Barang::all();
        return view('admin.barang.stok', compact('barang'));
    }

    // Memperbarui stok barang
    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->stok = $request->stok;
        $barang->save();

        return redirect()->route('admin.barang.stok')->with('success', 'Stok barang berhasil diperbarui');
    }
}
