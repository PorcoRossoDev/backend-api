<?php 
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getCategory($request)
    {
        $query = Category::query();
        return $query->paginate(20);
    }
}