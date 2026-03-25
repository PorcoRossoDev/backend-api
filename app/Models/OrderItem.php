<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    public function orderItemReceipts()
    {
        return $this->hasMany(OrderItemReceipt::class);
    }
}
