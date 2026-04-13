<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    protected $fillable = [
        'name',
        'image',
        'price',
        'type',
    ];

    public function getImageAttribute($value)
    {
        return asset($value);
    }
}
