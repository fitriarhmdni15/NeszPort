<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    //
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.dashboard', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        // Menambahkan 'role' untuk siswa baru
        $siswa = User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => 'siswa', // Menambahkan default role
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
        ]);

        $siswa = User::findOrFail($id);

        // Update username
        $siswa->username = $validated['username'];

        // Jika password diubah, hash password baru
        if ($request->password) {
            $siswa->password = bcrypt($validated['password']);
        }

        // Simpan perubahan
        $siswa->save();

        return redirect()->route('admin.dashboard')->with('success', 'Data siswa berhasil diubah.');
    }


    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Siswa berhasil dihapus.');
    }
}
