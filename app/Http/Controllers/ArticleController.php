<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function createForm()
    {
        return view('articles.create');
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $article = new Article($data);

        $article->save();

        session()->flash('success', 'Success!');

        return redirect()->back();
    }
}
