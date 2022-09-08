<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => '/articles', 'as' => 'article.'], function () {
    Route::get('', [ArticleController::class, 'list'])
        ->name('list');

    Route::get('/create', [ArticleController::class, 'createForm'])
        ->name('create.form');

    Route::post('/create', [ArticleController::class, 'create'])
        ->name('create');

    Route::group(['prefix' => '/{article}/edit'], function () {
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
