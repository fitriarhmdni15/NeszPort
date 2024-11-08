<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsEquipment;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;  // Pastikan ini ada

class SportsEquipmentController extends Controller
{
    // Menampilkan daftar barang olahraga
    public function index()
    {
        $equipment = SportsEquipment::all();
        return view('equipment.index', compact('equipment'));
    }

    // Menampilkan form untuk menambah barang baru
    public function create()
    {
        return view('equipment.create');
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan gambar di storage/public/sports_images
        $imagePath = $request->file('image')->store('sports_images', 'public');

        // Menyimpan data barang ke database
        SportsEquipment::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imagePath,  // Menyimpan path gambar
        ]);

        return redirect()->route('equipment.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $equipment = SportsEquipment::findOrFail($id);
        return view('equipment.edit', compact('equipment'));
    }

    // Menyimpan perubahan data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Bisa null jika tidak ada perubahan gambar
        ]);

        $equipment = SportsEquipment::findOrFail($id);

        if ($request->hasFile('image')) {
            // Jika ada gambar baru, simpan dan update path gambar
            $imagePath = $request->file('image')->store('sports_images', 'public');
            $equipment->image = $imagePath;  // Perbarui gambar
        }

        $equipment->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Barang olahraga berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy($id)
    {
        $equipment = SportsEquipment::findOrFail($id);

        // Menghapus gambar dari storage jika ada
        if ($equipment->image && Storage::exists('public/' . $equipment->image)) {
            Storage::delete('public/' . $equipment->image);
        }

        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Barang olahraga berhasil dihapus.');
    }

    // Menampilkan form peminjaman barang
    public function book($id)
    {
        $equipment = SportsEquipment::findOrFail($id);
        return view('equipment.book', compact('equipment'));
    }

    // Menyimpan data peminjaman barang
    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'borrowed_at' => 'required|date',
            'returned_at' => 'required|date|after:borrowed_at',
        ]);

        $equipment = SportsEquipment::findOrFail($id);

        if ($request->quantity > $equipment->quantity) {
            return back()->withErrors(['quantity' => 'Jumlah yang diminta melebihi stok yang tersedia.']);
        }

        Booking::create([
            'name' => $request->name,
            'class' => $request->class,
            'major' => $request->major,
            'sports_equipment_id' => $id,
            'quantity' => $request->quantity,
            'borrowed_at' => $request->borrowed_at,
            'returned_at' => $request->returned_at,
        ]);

        $equipment->decrement('quantity', $request->quantity);

        return redirect()->route('equipment.index')->with('success', 'Peminjaman berhasil dilakukan.');
    }
}
