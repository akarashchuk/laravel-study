<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Article;
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
    ->middleware(['cookie-banner'])
    ->name('main');

Route::get('/today', [MainController::class, 'todayArticles'])
    ->name('today');

Route::get('/report', [ReportController::class, 'show'])
    ->name('report');

Route::post('/report', [ReportController::class, 'store'])
    ->name('report.store');

Route::group(['prefix' => '/articles', 'as' => 'article.', 'middleware' => ['auth', 'cookie-banner']], function () {
    Route::get('', [ArticleController::class, 'list'])
        ->name('list');

    Route::get('/create', [ArticleController::class, 'createForm'])
        ->name('create.form')->middleware('can:create,'. Article::class);

    Route::post('/create', [ArticleController::class, 'create'])
        ->name('create')->middleware('can:create,'. Article::class);

    Route::group(['prefix' => '/{article}/edit', 'middleware' => 'can:edit,article'], function () {
        Route::get('', [ArticleController::class, 'editForm'])
            ->name('edit.form');

        Route::post('', [ArticleController::class, 'edit'])
            ->name('edit');
    });

    Route::get('/{article}', [ArticleController::class, 'show'])
        ->name('show');


    Route::post('/{article}/delete', [ArticleController::class, 'delete'])
        ->name('delete');
});

Route::get('/sign-up', [UserController::class, 'signUpForm'])
    ->name('sign-up.form');
Route::post('/sign-up', [UserController::class, 'signUp'])->name('sign-up');


Route::get('/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])
    ->name('verify.email');

Route::get('/sign-in', [AuthController::class, 'signInForm'])->name('login');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['spa'], function () {
    Route::fallback(fn () => view('spa'));
});
