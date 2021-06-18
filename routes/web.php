<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('index');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/posts', [AdminController::class, 'allPosts'])->name('posts');
    Route::get('/posts/approved', [AdminController::class, 'approvedPosts'])->name('approved.posts');
    Route::get('/posts/waiting', [AdminController::class, 'waitingPosts'])->name('waiting.posts');
    Route::get('/posts/approve/{post}', [AdminController::class, 'approvePost'])->name('approve.post');
    Route::get('/post/show/{post}', [AdminController::class, 'showPost'])->name('admin.show.post');
    Route::delete('/post/delete/{post}', [AdminController::class, 'destroyPost'])->name('admin.destroy.post');
    Route::get('/definitions', [AdminController::class, 'allDefinitions'])->name('definitions');
    Route::get('/definitions/approved', [AdminController::class, 'approvedDefinitions'])->name('approved.definitions');
    Route::get('/definitions/waiting', [AdminController::class, 'waitingDefinitions'])->name('waiting.definitions');
});

Route::get('/home', [PostController::class, 'index'])->name('index');
Route::middleware('auth')->prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create.post');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('show.post');
    Route::post('/store', [PostController::class, 'store'])->name('store.post');
    Route::post('/like/{post}', [PostController::class, 'like'])->name('like.post');
    Route::post('/dislike/{post}', [PostController::class, 'dislike'])->name('dislike.post');
    Route::post('/comment/{post}', [PostController::class, 'comment'])->name('comment.post');
    Route::post('/comment/like/{comment}', [PostController::class, 'likeComment'])->name('like.post.comment');
    Route::post('/comment//dislike/{comment}', [PostController::class, 'dislikeComment'])->name('dislike.post.comment');
});

Auth::routes();
