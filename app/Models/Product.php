<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'seller_id',
        'category_id',
        'nama_product',
        'deskripsi',
        'harga',
        'img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
