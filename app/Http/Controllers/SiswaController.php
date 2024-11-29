<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa untuk admin
    public function index()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.data_siswa', compact('siswa'));
    }

    // Halaman tambah siswa (admin)
    public function create()
    {
        return view('admin.siswa.create');
    }

    // Menyimpan data siswa baru (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        $siswa = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => 'siswa', // Default sebagai siswa
            'name' => $validated['name'],
            'kelas' => $validated['kelas'],
        ]);

        return redirect()->route('admin.data_siswa')->with('success', 'Siswa berhasil ditambahkan.');
    }

    // Halaman edit siswa (admin)
    public function edit($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    // Update data siswa (admin)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        $siswa = User::findOrFail($id);
        $siswa->username = $validated['username'];
        $siswa->name = $validated['name'];
        $siswa->kelas = $validated['kelas'];

        if ($request->password) {
            $siswa->password = bcrypt($validated['password']);
        }

        $siswa->save();

        return redirect()->route('admin.data_siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }
    // Menghapus siswa (admin)
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.data_siswa')->with('success', 'Siswa berhasil dihapus.');
    }
}
