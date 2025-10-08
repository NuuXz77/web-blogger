<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // pakai bahasa Indonesia
        $now = now();

        $posts = [];

        for ($i = 1; $i <= 20; $i++) {
            $title = $faker->sentence(rand(4, 8)); // Judul artikel 4-8 kata
            $posts[] = [
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $i, // biar unik
                'excerpt' => $faker->paragraph(3), // ringkasan 3 kalimat
                'content' => $faker->paragraphs(rand(8, 15), true), // konten panjang (8-15 paragraf)
                'featured_image' => 'images/posts/' . Str::slug($title) . '.jpg',
                'status' => $faker->randomElement(['draft', 'published', 'archived']),
                'user_id' => 1, // pastikan user dengan id=1 ada
                'category_id' => $faker->numberBetween(1, 10), // pastikan ada 10 kategori
                'meta_title' => $title,
                'meta_description' => $faker->paragraph(2),
                'published_at' => $faker->randomElement([null, $faker->dateTimeThisYear()]),
                'views_count' => $faker->numberBetween(0, 1000),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
