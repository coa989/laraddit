<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DefinitionController as AdminDefinitionController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::patch('/notifications/mark-as-read/{notification}', [\App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.mark');
    Route::patch('/notifications/mark-all-as-read/', [\App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('notifications.mark_all');

    Route::get('/posts/approved', [AdminPostController::class, 'approved'])->name('posts.approved');
    Route::get('/posts/rejected', [AdminPostController::class, 'rejected'])->name('posts.rejected');
    Route::get('/posts/pending', [AdminPostController::class, 'pending'])->name('posts.pending');
    Route::get('/posts/approve/{post}', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::get('/posts/reject/{post}', [AdminPostController::class, 'reject'])->name('posts.reject');

    Route::get('/definitions/approved', [AdminDefinitionController::class, 'approved'])->name('definitions.approved');
    Route::get('/definitions/rejected', [AdminDefinitionController::class, 'rejected'])->name('definitions.rejected');
    Route::get('/definitions/pending', [AdminDefinitionController::class, 'pending'])->name('definitions.pending');
    Route::get('/definitions/approve/{definition}', [AdminDefinitionController::class, 'approve'])->name('definitions.approve');
    Route::get('/definitions/reject/{definition}', [AdminDefinitionController::class, 'reject'])->name('definitions.reject');

    Route::get('/users/{user}/posts', [AdminUserController::class, 'posts'])->name('users.posts');
    Route::get('/users/{user}/definitions', [AdminUserController::class, 'definitions'])->name('users.definitions');
    Route::get('/users/{user}/comments', [AdminUserController::class, 'comments'])->name('users.comments');
    Route::get('/users/authors', [AdminUserController::class, 'authors'])->name('users.authors');
    Route::get('/users/guests', [AdminUserController::class, 'guests'])->name('users.guests');
    Route::get('/users/change-role{user}', [AdminUserController::class, 'changeRole'])->name('users.change-role');

    Route::get('/comments/approve/{comment}', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::get('/comments/reject/{comment}', [AdminCommentController::class, 'reject'])->name('comments.reject');
    Route::get('/comments/approved', [AdminCommentController::class, 'approved'])->name('comments.approved');
    Route::get('/comments/pending', [AdminCommentController::class, 'pending'])->name('comments.pending');
    Route::get('/comments/rejected', [AdminCommentController::class, 'rejected'])->name('comments.rejected');
});

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
    Route::get('/profile/{user}/posts', [\App\Http\Controllers\UserController::class, 'posts'])->name('users.posts');
    Route::get('/profile/{user}/definitions', [\App\Http\Controllers\UserController::class, 'definitions'])->name('users.definitions');
    Route::resource('users', \App\Http\Controllers\UserController::class)->only('show');
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
