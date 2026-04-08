<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function customizations()
    {
        return $this->belongsToMany(Customization::class);
    }

    public function scopeCategory($id) {
        return $this->where('category_id', $id);
    }
}
