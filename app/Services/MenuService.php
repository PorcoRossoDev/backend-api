<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getAll($request)
    {
        $query = Menu::query();
        if( $request->category != 'undefined' ) $query->where('category_id', $request->category);
        if( $request->keyword != '' && $request->keyword != 'undefined' ) $query->where('name', 'like', '%'.$request->keyword.'%');
        return $query->latest()->paginate(20);
    }
}