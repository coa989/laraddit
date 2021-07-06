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
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index'])->name('index');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
    Route::get('/posts/approved', [AdminPostController::class, 'approved'])->name('posts.approved');
    Route::get('/posts/rejected', [AdminPostController::class, 'rejected'])->name('posts.rejected');
    Route::get('/posts/pending', [AdminPostController::class, 'pending'])->name('posts.pending');
    Route::get('/posts/approve/{post}', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::get('/posts/reject/{post}', [AdminPostController::class, 'reject'])->name('posts.reject');
    Route::get('/posts/show/{post}', [AdminPostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/destroy/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/definitions', [AdminDefinitionController::class, 'index'])->name('definitions');
    Route::get('/definitions/approved', [AdminDefinitionController::class, 'approved'])->name('definitions.approved');
    Route::get('/definitions/rejected', [AdminDefinitionController::class, 'rejected'])->name('definitions.rejected');
    Route::get('/definitions/pending', [AdminDefinitionController::class, 'pending'])->name('definitions.pending');
    Route::get('/definitions/approve/{definition}', [AdminDefinitionController::class, 'approve'])->name('definitions.approve');
    Route::get('/definitions/reject/{definition}', [AdminDefinitionController::class, 'reject'])->name('definitions.reject');
    Route::get('/definitions/show/{definition}', [AdminDefinitionController::class, 'show'])->name('definitions.show');
    Route::delete('/definitions/destroy/{definition}', [AdminDefinitionController::class, 'destroy'])->name('definitions.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user}/posts', [AdminUserController::class, 'posts'])->name('users.posts');
    Route::get('/users/{user}/definitions', [AdminUserController::class, 'definitions'])->name('users.definitions');
    Route::get('/users/{user}/comments', [AdminUserController::class, 'comments'])->name('users.comments');
    Route::get('/users/show/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::get('/users/authors', [AdminUserController::class, 'authors'])->name('users.authors');
    Route::get('/users/guests', [AdminUserController::class, 'guests'])->name('users.guests');
    Route::delete('/users/destroy/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/change-role{user}', [AdminUserController::class, 'changeRole'])->name('users.change-role');

    Route::get('/comments}', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/approve/{comment}', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::get('/comments/reject/{comment}', [AdminCommentController::class, 'reject'])->name('comments.reject');
    Route::get('/comments/approved', [AdminCommentController::class, 'approved'])->name('comments.approved');
    Route::get('/comments/pending', [AdminCommentController::class, 'pending'])->name('comments.pending');
    Route::get('/comments/rejected', [AdminCommentController::class, 'rejected'])->name('comments.rejected');
    Route::delete('/comments/destroy/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
    Route::get('/home', [PostController::class, 'index'])->name('index');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::view('/create', 'posts.create')->middleware('can:create,App\Models\Post')->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/tags/{tag}', [PostController::class, 'tag'])->name('tags');
        Route::get('/hot', [PostController::class, 'hot'])->name('hot');
    });
});

Route::group(['prefix' => 'definitions', 'as' => 'definitions.'], function () {
    Route::get('/', [DefinitionController::class, 'index'])->name('index');
    Route::get('/show/{definition}', [DefinitionController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::view('/create', 'definitions.create')->middleware('can:create,App\Models/Definition')->name('create');
        Route::post('/store', [DefinitionController::class, 'store'])->name('store');
        Route::delete('/destroy/{definition}', [DefinitionController::class, 'destroy'])->name('destroy');
        Route::get('/tags/{tag}', [DefinitionController::class, 'tag'])->name('tags');
        Route::get('/hot', [DefinitionController::class, 'hot'])->name('hot');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'comments', 'as' => 'comments.'], function () {
    Route::post('/store/{model}', [CommentController::class, 'store'])->name('store');
    Route::post('/reply/{model}', [CommentController::class, 'reply'])->name('reply');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/{user}/posts', [ProfileController::class, 'posts'])->name('posts');
    Route::get('/{user}/definitions', [ProfileController::class, 'definitions'])->name('definitions');
});

Route::group(['middleware' => 'auth', 'prefix' => 'likes', 'as' => 'likes.'], function () {
    Route::post('/{model}/store', [LikeController::class, 'store'])->name('store');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dislikes', 'as' => 'dislikes.'], function () {
    Route::post('/{model}/store', [DislikeController::class, 'store'])->name('store');
});

Auth::routes();
