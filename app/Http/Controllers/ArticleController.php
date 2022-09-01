<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\EditRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function createForm()
    {
        return view('articles.create');
    }

    public function editForm(int $id)
    {
        $article = Article::query()->findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $article = new Article($data);
        $article->save();

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['id' => $article->id]);
    }

    public function edit(int $id, EditRequest $request)
    {
        $article = Article::query()->findOrFail($id);

        $data = $request->validated();
        $article->fill($data);
        $article->save();

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['id' => $article->id]);
    }

    public function list()
    {
        $articles = Article::all();

        return view('articles.list', ['articles' => $articles]);
    }

    public function show(int $id)
    {
        $article = Article::query()->findOrFail($id);

        //compact('article') => ['article' => $article];
        return view('articles.show', compact('article'));
    }
}
