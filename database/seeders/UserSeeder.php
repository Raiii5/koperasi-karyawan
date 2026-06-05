<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'username' => 'admin',
        ], [
            'name' => 'Admin HRD',
            'email' => 'admin@example.com',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        $karyawan = Karyawan::first();

        User::firstOrCreate([
            'username' => 'karyawan',
        ], [
            'name' => $karyawan ? $karyawan->nama : 'Karyawan Demo',
            'email' => 'karyawan@example.com',
            'password' => 'karyawan123',
            'role' => 'karyawan',
            'karyawan_id' => $karyawan ? $karyawan->id : null,
        ]);
    }
}
