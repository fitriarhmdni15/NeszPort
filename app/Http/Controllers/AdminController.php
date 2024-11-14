<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $barang = Barang::all();  // Data barang tetap terlihat di dashboard
        $admins = User::where('role', 'admin')->get();  // Data admin

        return view('admin.dashboard', compact('barang', 'admins'));
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

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil ditambahkan!');
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

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil dihapus!');
    }

}
