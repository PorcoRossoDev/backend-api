<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Models\Article;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Lấy danh sách Bài viết
     */
    public function index(Request $request)
    {
        $articles = $this->service->getAll($request);
        return response()->json($articles);
    }
}
