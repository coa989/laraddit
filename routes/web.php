<?php

use App\Http\Controllers\Admin\DefinitionController as AdminDefinitionController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
    Route::get('/posts/approved', [AdminPostController::class, 'approved'])->name('posts.approved');
    Route::get('/posts/waiting', [AdminPostController::class, 'waiting'])->name('posts.waiting');
    Route::get('/posts/approve/{post}', [AdminPostController::class, 'approve'])->name('posts.approve');
    Route::get('/posts/show/{post}', [AdminPostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/destroy/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/comment/{comment}/approve', [AdminPostController::class, 'approveComment'])->name('posts.comment.approve');
    Route::get('/posts/comments/waiting', [AdminPostController::class, 'waitingComments'])->name('posts.comments.waiting');
    Route::delete('/posts/comments/{comment}/destroy', [AdminPostController::class, 'destroyComment'])->name('posts.comment.destroy');

    Route::get('/definitions', [AdminDefinitionController::class, 'index'])->name('definitions');
    Route::get('/definitions/approved', [AdminDefinitionController::class, 'approved'])->name('definitions.approved');
    Route::get('/definitions/waiting', [AdminDefinitionController::class, 'waiting'])->name('definitions.waiting');
    Route::get('/definitions/approve/{definition}', [AdminDefinitionController::class, 'approve'])->name('definitions.approve');
    Route::get('/definitions/show/{definition}', [AdminDefinitionController::class, 'show'])->name('definitions.show');
    Route::delete('/definitions/destroy/{definition}', [AdminDefinitionController::class, 'destroy'])->name('definitions.destroy');
    Route::get('/definitions/comment/{comment}/approve', [AdminDefinitionController::class, 'approveComment'])->name('definitions.comment.approve');
    Route::get('/definitions/comments/waiting', [AdminDefinitionController::class, 'waitingComments'])->name('definitions.comments.waiting');
    Route::delete('/definitions/comments/{comment}/destroy', [AdminDefinitionController::class, 'destroyComment'])->name('definitions.comment.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user}/posts', [AdminUserController::class, 'posts'])->name('users.posts');
    Route::get('/users/{user}/definitions', [AdminUserController::class, 'definitions'])->name('users.definitions');
    Route::get('/users/{user}/comments', [AdminUserController::class, 'comments'])->name('users.comments');
    Route::get('/users/show/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::get('/users/authors', [AdminUserController::class, 'authors'])->name('users.authors');
    Route::get('/users/guests', [AdminUserController::class, 'guests'])->name('users.guests');
    Route::delete('/users/destroy/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/change-role{user}', [AdminUserController::class, 'changeRole'])->name('users.change-role');
});

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/home', [PostController::class, 'index'])->name('index');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::view('/create', 'posts.create')->middleware('can:create,App\Models\Post')->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('/like/{post}', [PostController::class, 'like'])->name('like');
        Route::post('/dislike/{post}', [PostController::class, 'dislike'])->name('dislike');
        Route::post('/comment/{post}', [PostController::class, 'comment'])->name('comment');
        Route::post('/comment/like/{comment}', [PostController::class, 'likeComment'])->name('like.comment');
        Route::post('/comment//dislike/{comment}', [PostController::class, 'dislikeComment'])->name('dislike.comment');
        Route::get('/tag/{tag}', [PostController::class, 'tag'])->name('tag');
        Route::get('/hot', [PostController::class, 'hot'])->name('hot');
    });
});

Route::group(['prefix' => 'definition', 'as' => 'definition.'], function () {
    Route::get('/definitions', [DefinitionController::class, 'index'])->name('index');
    Route::get('/show/{definition}', [DefinitionController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::view('/create', 'definitions.create')->middleware('can:create,App\Models/Definition')->name('create');
        Route::post('/store', [DefinitionController::class, 'store'])->name('store');
        Route::delete('/destroy/{definition}', [DefinitionController::class, 'destroy'])->name('destroy');
        Route::post('/like/{definition}', [DefinitionController::class, 'like'])->name('like');
        Route::post('/dislike/{definition}', [DefinitionController::class, 'dislike'])->name('dislike');
        Route::post('/comment/{definition}', [DefinitionController::class, 'comment'])->name('comment');
        Route::post('/comment/like/{comment}', [DefinitionController::class, 'likeComment'])->name('like.comment');
        Route::post('/comment/dislike/{comment}', [DefinitionController::class, 'dislikeComment'])->name('dislike.comment');
        Route::get('/tag/{tag}', [DefinitionController::class, 'tag'])->name('tag');
        Route::get('/hot', [DefinitionController::class, 'hot'])->name('hot');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/{user}/posts', [ProfileController::class, 'posts'])->name('posts');
    Route::get('/{user}/definitions', [ProfileController::class, 'definitions'])->name('definitions');
});

Auth::routes();
