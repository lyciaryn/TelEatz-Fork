<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    // 1 kategori dapat memiliki banyak products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
