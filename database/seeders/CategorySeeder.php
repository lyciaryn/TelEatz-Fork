<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama_kategori' => 'Makanan',
            'deskripsi' => 'Makanan untuk mengisi perut seperti makanan berat'
        ]);

        Category::create([
            'nama_kategori' => 'Minuman',
            'deskripsi' => 'Minuman untuk lepas dahaga'
        ]);

        Category::create([
            'nama_kategori' => 'Dish',
            'deskripsi' => 'Makanan penutup yang manis'
        ]);
    }
}
