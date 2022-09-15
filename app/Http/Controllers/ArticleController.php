<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\EditRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function createForm()
    {
        $categories = Category::all();

        return view('articles.create', compact('categories'));
    }

    public function editForm(int $id)
    {
        $article = Article::query()->findOrFail($id);
        $categories = Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $article = new Article($data);

//        $user = Auth::user();
        $user = $request->user();

//        $article->user_id = $user->id;
        $article->user()->associate($user);
        $article->save();
        $article->categories()->attach($data['categories']);

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function edit(Article $article, EditRequest $request)
    {
        $data = $request->validated();
        $article->fill($data);
        $article->categories()->sync($data['categories']);
        $article->save();

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function list(Request $request)
    {
        $articles = Article::query()->paginate(3);

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
