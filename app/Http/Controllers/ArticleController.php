<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\EditRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService)
    {
    }

    public function createForm()
    {
//        $this->authorize('create', Article::class);
        $categories = Category::all();

        return view('articles.create', compact('categories'));
    }

    public function editForm(Article $article)
    {
//        Gate::forUser(User::query()->find(10))->authorize('edit-article');
//        $this->authorize('edit', $article);
//        Gate::authorize('edit-article', $article);
        $categories = Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $article = $this->articleService->create($data, $user);

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function edit(Article $article, EditRequest $request)
    {
        $data = $request->validated();
        $this->articleService->edit($article, $data);

        session()->flash('success', 'Success!');

        return redirect()->route('article.show', ['article' => $article->id]);
    }

    public function list(Request $request)
    {
        $articles = Article::query()->with(['categories', 'user'])->paginate(3);

        return view('articles.list', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        //compact('article') => ['article' => $article];
        return view('articles.show', compact('article'));
    }

    public function delete(Article $article)
    {
//        Gate::authorize('delete', $article);
        $this->articleService->delete($article);
        session()->flash('success', 'Successfully deleted!');

        return redirect()->route('article.list');
    }

    // Пример восстановления записи
    public function restore(int $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
    }
}
