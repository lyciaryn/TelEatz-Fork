<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['buyer_id', 'total_harga'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
