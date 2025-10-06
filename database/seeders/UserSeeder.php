<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang ada untuk menghindari duplikasi (opsional)
        // User::truncate();

        // Membuat Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@a.com',
            'password' => Hash::make('123123'), // Ganti 'password' dengan password yang aman
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Membuat User Biasa
        User::create([
            'name' => 'Mas Udin',
            'email' => 'udin@a.com',
            'password' => Hash::make('123123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Membuat Auditor
        User::create([
            'name' => 'Mas Auditor',
            'email' => 'auditor@a.com',
            'password' => Hash::make('123123'),
            'role' => 'auditor',
            'email_verified_at' => now(),
        ]);

        // Opsional: Membuat banyak user acak menggunakan factory
        // Pastikan file UserFactory.php sudah dikonfigurasi
        // User::factory(10)->create();
    }
}