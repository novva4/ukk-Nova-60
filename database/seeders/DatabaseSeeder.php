<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Pembuatan Akun Admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Pembuatan Akun Siswa (User)
        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@sekolah.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 3. (Bonus) Beberapa Koleksi Buku untuk memudahkan Anda melakukan tes
        Book::create([
            'title' => 'Belajar Framework Laravel Dasar',
            'author' => 'Eko Kurniawan',
            'publisher' => 'Pustaka Tech',
            'year' => 2024,
            'stock' => 5,
        ]);

        Book::create([
            'title' => 'Mahir Membangun UI Menggunakan Bootstrap 5',
            'author' => 'Sandhika Galih',
            'publisher' => 'Web Studio Nusantara',
            'year' => 2023,
            'stock' => 3,
        ]);
        
        Book::create([
            'title' => 'Kumpulan Soal Studi Kasus PHP Native',
            'author' => 'Abdul Kadir',
            'publisher' => 'Andi Publisher',
            'year' => 2022,
            'stock' => 10,
        ]);
    }
}
