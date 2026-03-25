<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemReceipt extends Model
{
    protected $table = 'order_item_receipts';

    public function scopeReturnType($query, $type)
    {
        return $query->where('returned', $type);
    }
}
