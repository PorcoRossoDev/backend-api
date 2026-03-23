<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    protected ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Lấy danh sách bài viết
     */
    public function index(Request $request): JsonResponse
    {
        $articles = $this->service->getAll($request);

        return response()->json($articles);
    }

    /**
     * Tạo bài viết
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $article = $this->service->create($data);

        return response()->json([
            'message' => 'Tạo bài viết thành công',
            'data' => $article
        ], 201);
    }

    /**
     * Xoá bài viết
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->delete($id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Không tìm thấy bài viết'
            ], 404);
        }

        return response()->json([
            'message' => 'Xoá bài viết thành công'
        ]);
    }
}