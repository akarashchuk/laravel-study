<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        $query = Article::query()
            ->with(['user', 'categories'])
            ->latest();

//        $query->whereHas('user', function ($q) {
//            $q->where('name', 'Test');
//        });
//        if ($request->has('category')) {
//            $query->whereHas('categories', function ($q) use ($request) {
//                $q->where('categories.id', $request->get('category'));
//            });
//        }

        if ($request->has('categories')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->get('categories'));
            });
        }

        if ($request->has('title')) {
            $search = '%' . $request->get('title') . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search);
                $q->orWhere('text', 'like', $search);
            });
        }

        $articles = $query
            ->paginate(1)
            ->appends($request->query());
//        dd(DB::getQueryLog());

        $categories = Category::all();

        return view('welcome', compact('articles', 'categories'));
    }
}
