<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Article;
use App\Models\User;

class ArticleService
{
    public function create(array $data, User $user): Article
    {
        $article = new Article($data);
        $article->user()->associate($user);
        $article->save();
        $article->categories()->attach($data['categories']);

        return $article;
    }

    public function edit(Article $article, array $data): void
    {
        $article->fill($data);
        $article->categories()->sync($data['categories']);
        $article->save();
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }
}
