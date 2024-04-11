<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {return "Hello world";})->name('posts_view');
Route::get('/posts', [PostController::class,'get_posts'])->name('posts_view');
Route::get('/posts/{post}/get', [PostController::class,'get_post'])->name('post_view');
Route::put('/posts/{post}/update', [PostController::class,'update_post'])->name('update_view');
Route::delete('/posts/{post}/delete', [PostController::class,'delete_post'])->name('delete_view');
Route::post('/post/create', [PostController::class,'create_post'])->name('create_view');
