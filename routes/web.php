<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])
    ->name('main');

Route::get('/report', [ReportController::class, 'show'])
    ->name('report');

Route::post('/report', [ReportController::class, 'store'])
    ->name('report.store');

Route::get('/articles/create', [ArticleController::class, 'createForm'])
    ->name('article.create.form');

Route::post('/articles/create', [ArticleController::class, 'create'])
    ->name('article.create');

Route::get('/articles', [ArticleController::class, 'list'])
    ->name('article.list');

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('article.show');

Route::get('/articles/{article}/edit', [ArticleController::class, 'editForm'])
    ->name('article.edit.form');

Route::post('/articles/{article}/edit', [ArticleController::class, 'edit'])
    ->name('article.edit');

Route::post('/articles/{article}/delete', [ArticleController::class, 'delete'])
    ->name('article.delete');
