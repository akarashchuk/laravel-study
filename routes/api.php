<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/sign-in', [AuthController::class, 'signIn']);

Route::get('/articles/{article}', [ArticleController::class, 'show']);
Route::get('/articles', [ArticleController::class, 'list']);

Route::group(['prefix' => '/articles', 'middleware' => ['auth:api']], function () {
    Route::post('', [ArticleController::class, 'create'])->middleware('can:create,'. Article::class);
    Route::put('/{article}', [ArticleController::class, 'edit'])->middleware('can:edit,article');
    Route::delete('/{article}', [ArticleController::class, 'delete'])->middleware('can:delete,article');
});
