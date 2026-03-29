<?php

namespace App\Services;
use App\Models\Post;

class PostService
{
    public function getPost()
    {
        $query = Post::query();
        $query->with('comments');
        $query->with('category')->publish(1);
        return $query->paginate(10);
    }
}