<?php
namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function getAll($request)
    {
        $query = Article::query();

        if ($request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        return $query->latest()->paginate(10);
    }

    public function create(array $data): Article
    {
        return Article::create($data);
    }

    public function delete(int $id): bool
    {
        $article = Article::find($id);

        if (!$article) {
            return false;
        }

        return $article->delete();
    }
}