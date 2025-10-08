<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Teknologi',
                'slug' => Str::slug('Teknologi'),
                'description' => 'Kategori seputar teknologi terbaru.',
                'color' => '#3B82F6',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bisnis',
                'slug' => Str::slug('Bisnis'),
                'description' => 'Kategori untuk berita dan tips bisnis.',
                'color' => '#F59E0B',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Olahraga',
                'slug' => Str::slug('Olahraga'),
                'description' => 'Kategori berita dan artikel olahraga.',
                'color' => '#10B981',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Kesehatan',
                'slug' => Str::slug('Kesehatan'),
                'description' => 'Kategori seputar kesehatan dan gaya hidup.',
                'color' => '#EF4444',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Pendidikan',
                'slug' => Str::slug('Pendidikan'),
                'description' => 'Artikel dan berita tentang pendidikan.',
                'color' => '#6366F1',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Kuliner',
                'slug' => Str::slug('Kuliner'),
                'description' => 'Kategori makanan dan minuman.',
                'color' => '#D97706',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Travel',
                'slug' => Str::slug('Travel'),
                'description' => 'Kategori tentang perjalanan dan wisata.',
                'color' => '#06B6D4',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Hiburan',
                'slug' => Str::slug('Hiburan'),
                'description' => 'Kategori film, musik, dan hiburan.',
                'color' => '#A855F7',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Otomotif',
                'slug' => Str::slug('Otomotif'),
                'description' => 'Kategori mobil, motor, dan otomotif.',
                'color' => '#F43F5E',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sains',
                'slug' => Str::slug('Sains'),
                'description' => 'Kategori ilmu pengetahuan dan penelitian.',
                'color' => '#22C55E',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
