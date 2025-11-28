<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin (Agar bisa login)
        User::updateOrCreate(
            ['email' => 'ardiansyahdzan@gmail.com'], // Cek jika email sudah ada
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // Password: password
                'email_verified_at' => now(),
            ]
        );

        // 2. Panggil Seeder Pengaturan Acara
        $this->call([
            EventSettingSeeder::class,
        ]);
    }
}