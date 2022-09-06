<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\EditRequest;
use App\Models\Article;
use Illuminate\Http\Request;

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

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function edit(Article $article, EditRequest $request)
    {
        $data = $request->validated();
        $article->fill($data);
        $article->save();

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function list(Request $request)
    {
        $articles = Article::query()->paginate(1);

        return view('articles.list', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        //compact('article') => ['article' => $article];
        return view('articles.show', compact('article'));
    }

    public function delete(Article $article)
    {
        $article->delete();

        session()->flash('success', 'Successfully deleted!');

        return redirect()->route('article.list');
    }
}
