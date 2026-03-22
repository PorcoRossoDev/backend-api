<?php
namespace App\Services;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleService
{
    /*
     * Lấy danh sách Bài viết
     */
    public function getAll($request)
    {
        return Article::latest()->paginate(10);
    }
}