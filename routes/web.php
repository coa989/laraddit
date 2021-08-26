<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Posts
Route::redirect('/', '/posts');
Route::group(['middleware' => 'auth'], function () {
    Route::view('posts/create', 'posts.create')->middleware('can:create,App\Models/Post')->name('posts.create');
    Route::get('posts/hot', [PostController::class, 'hot'])->name('posts.hot');
    Route::resource('posts', PostController::class)->only(['store', 'destroy']);
});
Route::resource('posts', PostController::class)->only(['index', 'show']);

// Definitions
Route::group(['middleware' => 'auth'], function() {
    Route::view('definitions/create', 'definitions.create')->middleware('can:create,App\Models/Definition')->name('definitions.create');
    Route::get('definitions/hot', [DefinitionController::class, 'hot'])->name('definitions.hot');
    Route::resource('definitions', DefinitionController::class)->only(['store', 'destroy']);
});
Route::resource('definitions', DefinitionController::class)->only(['index', 'show']);

Route::group(['middleware' => 'auth'], function() {
    // Comments and Replies
    Route::resource('comments', CommentController::class)->only('store');
    Route::resource('replies', ReplyController::class)->only('store');
    // TODO: refactor
    // Users
    Route::get('/profile/{user}/posts', [UserController::class, 'posts'])->name('users.posts');
    Route::get('/profile/{user}/definitions', [UserController::class, 'definitions'])->name('users.definitions');
    Route::resource('users', UserController::class)->only('show');
    // Likes and Dislike
    Route::resource('likes', LikeController::class)->only('store');
    Route::resource('dislikes', DislikeController::class)->only('store');
});

// Tags
Route::group(['middleware' => 'auth', 'prefix' => 'tags', 'as' => 'tags.'], function() {
   Route::get('/find', [TagController::class, 'find']);
   Route::get('/posts/{tag:name}', [TagController::class, 'filterPosts'])->name('posts');
   Route::get('/definitions/{tag:name}', [TagController::class, 'filterDefinitions'])->name('definitions');
});

Auth::routes();
