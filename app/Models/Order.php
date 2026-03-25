<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderItemReceipts()
    {
        return $this->hasManyThrough(OrderItemReceipt::class, OrderItem::class);
    }
}
