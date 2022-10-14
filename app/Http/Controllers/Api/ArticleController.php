<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Article\CreateRequest;
use App\Http\Requests\Api\Article\EditRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService)
    {
    }

    public function create(CreateRequest $request): ArticleResource
    {
        $data = $request->validated();
        $user = $request->user();
        $article = $this->articleService->create($data, $user);

        return new ArticleResource($article);
    }

    public function edit(Article $article, EditRequest $request): ArticleResource
    {
        $data = $request->validated();
        $this->articleService->edit($article, $data);

        return new ArticleResource($article);
    }

    public function list(): AnonymousResourceCollection
    {
        $articles = Article::query()->with(['user', 'categories'])->latest()->paginate(1);

        return ArticleResource::collection($articles);
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function delete(Article $article): Response
    {
        $this->articleService->delete($article);
        $data = [
            'message' => 'success',
        ];

        return response($data, status: 204);
    }
}
