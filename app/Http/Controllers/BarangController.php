<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all(); // Ambil semua data barang
        return view('templates.index', compact('barang')); // View untuk semua user
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'required|integer',
        ]);

        $path = $request->file('image')->store('images', 'public');
        $validated['image'] = $path;

        Barang::create($validated);

        return redirect()->route('admin.data_barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jumlah' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $barang->update($validated);

        return redirect()->route('admin.data_barang')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('admin.data_barang')->with('success', 'Barang berhasil dihapus');
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

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.detail', compact('barang'));
    }
}
