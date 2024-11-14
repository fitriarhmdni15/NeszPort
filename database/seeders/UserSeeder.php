<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin1',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'siswa1',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);
    }
}
