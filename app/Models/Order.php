<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'total_price',
        'status',
        'dine_option',
        'payment',
        'estimated_ready_at'
    ];
    protected $casts = [
        'estimated_ready_at' => 'datetime',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function orderItems()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
