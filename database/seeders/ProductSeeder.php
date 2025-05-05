<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'seller_id' => 1,
            'nama_product' => 'Nasi Goreng',
            'harga' => 15000,
            'deskripsi' => 'Makanan nasi goreng dengan bumbu rempah bawang-bawangan',
            'is_available' => 1,
            'category_id' => 1,
            'img' => null,
        ]);

        Product::create([
            'seller_id' => 1,
            'nama_product' => 'Mie Ayam',
            'harga' => 13000,
            'deskripsi' => 'Makanan Mie Ayam dengan bumbu rempah bawang-bawangan',
            'is_available' => 1,
            'category_id' => 1,
            'img' => null,
        ]);

        Product::create([
            'seller_id' => 2,
            'nama_product' => 'Es Buah',
            'harga' => 15000,
            'deskripsi' => 'Es buah yang sangat enak dengan buah buahan bergizi',
            'is_available' => 1,
            'category_id' => 2,
            'img' => null,
        ]);

        Product::create([
            'seller_id' => 2,
            'nama_product' => 'Es Kocok',
            'harga' => 15000,
            'deskripsi' => 'Es Kocok dengan buah-buhanan yang sangat lezat dan bergizi',
            'is_available' => 1,
            'category_id' => 2,
            'img' => null,
        ]);
    }
}
