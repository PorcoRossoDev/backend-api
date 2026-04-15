<?php

namespace App\Services;

use App\Models\Menu;

class MenuService
{
    public function getAll($request)
    {
        $id = (int)$request->category;
        $query = Menu::query();
        if( $request->category > 0 ) $query->where('category_id', $request->category);
        if( $request->keyword != '' && $request->keyword != 'undefined' ) $query->where('name', 'like', '%'.$request->keyword.'%');
        return $query->latest()->paginate(20);
    }

    public function getDetail($id)
    {
        $query = Menu::find($id);
        return $query;
    }
}