<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // --- Buat User Admin ---
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // --- Buat User Siswa (Contoh) ---
        User::updateOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'name' => 'Siswa ',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]
        );

        // --- Buat Kategori ---
        $categories = [
            [
                'name' => 'Fasilitas Kelas',
                'description' => 'Pengaduan terkait fasilitas di dalam kelas seperti meja, kursi, papan tulis, dll.',
                'is_active' => 1,
                'slug' => 'fasilitas-kelas',
            ],
            [
                'name' => 'Fasilitas Toilet',
                'description' => 'Pengaduan terkait kebersihan dan kerusakan fasilitas toilet.',
                'is_active' => 1,
                'slug' => 'fasilitas-toilet',
            ],
            [
                'name' => 'Fasilitas Lapangan',
                'description' => 'Pengaduan terkait fasilitas olahraga dan lapangan.',
                'is_active' => 1,
                'slug' => 'fasilitas-lapangan',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}