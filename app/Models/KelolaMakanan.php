<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelolaMakanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'id',
        'seller_id',
        'nama_product',
        'harga',
        'deskripsi',
        'is_available',
        'category_id',
        'img',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); // Setiap makanan memiliki satu kategori
    }

}
