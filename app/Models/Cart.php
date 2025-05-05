<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'buyer_id',
    ];

    // Cart memiliki banyak item
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Cart by Buyer
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
