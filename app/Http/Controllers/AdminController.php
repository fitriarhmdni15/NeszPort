<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Sesuaikan dengan nama view dashboard
    }

    public function dataSiswa()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.data_siswa', compact('siswa'));
    }

    public function dataBarang()
    {
        $barang = Barang::all();
        return view('admin.data_barang', compact('barang'));
    }

    public function dataAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.data_admin', compact('admins'));
    }

    // Peminjaman
    public function dataPeminjam()
    {
        $peminjaman = Peminjaman::with('barang', 'user')->get();
        return view('admin.data_peminjam', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['barang', 'user'])->findOrFail($id);
        return view('admin.peminjaman.detail', compact('peminjaman'));
    }

    public function create()
    {
        return view('admin.datadmin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|confirmed|min:8',
        ]);

        // Simpan admin baru dengan role 'admin'
        $admin = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => 'admin', // Pastikan role adalah 'admin'
        ]);

        return redirect()->route('admin.data_admin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id); // Gunakan model User
        return view('admin.datadmin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $admin = User::findOrFail($id);

        // Update username
        $admin->username = $validated['username'];

        // Update password hanya jika diubah
        if ($request->password) {
            $admin->password = bcrypt($validated['password']);
        }

        // Tidak perlu mengubah role, karena sudah pasti admin
        $admin->save();

        return redirect()->route('admin.data_admin')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.data_admin')->with('success', 'Admin berhasil dihapus!');
    }

}
