<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserCommentController;

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

Route::get('mailable',function(){
    $comment = Comment::find(1);
    return new App\Mail\CommentedPostMarkdown($comment);
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/secret',[HomeController::class,'secret'])
    ->name('secret')
    ->middleware('can:secret.page');

Route::resource('posts.comments',PostCommentController::class)->only('store','show');
Route::resource('users.comments',UserCommentController::class)->only('store');
Route::get('posts/archive',[PostController::class,'archive'])->name('archive');
Route::get('/posts/all',[PostController::class,'all'])->name('all');
Route::patch('/posts/{id}/restore',[PostController::class,'restore'])->name('restore');
Route::delete('/posts/{id}/forceDelete',[PostController::class,'forceDelete'])->name('forceDelete');
Route::resource('/posts',PostController::class);
Route::get('/posts/tag/{id}',[PostTagController::class,'index'])->name('posts.tag.index');
Route::resource('users',UserController::class);

Auth::routes();


