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
    Route::get('/post/approve/{post}', [AdminPostController::class, 'approve'])->name('post.approve');
    Route::get('/post/show/{post}', [AdminPostController::class, 'show'])->name('post.show');
    Route::delete('/post/destroy/{post}', [AdminPostController::class, 'destroy'])->name('post.destroy');

    Route::get('/definitions', [AdminDefinitionController::class, 'index'])->name('definitions');
    Route::get('/definitions/approved', [AdminDefinitionController::class, 'approved'])->name('definitions.approved');
    Route::get('/definitions/waiting', [AdminDefinitionController::class, 'waiting'])->name('definitions.waiting');
    Route::get('/definition/approve/{definition}', [AdminDefinitionController::class, 'approve'])->name('definition.approve');
    Route::get('/definition/show/{definition}', [AdminDefinitionController::class, 'show'])->name('definition.show');
    Route::delete('/definition/destroy/{definition}', [AdminDefinitionController::class, 'destroy'])->name('definition.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/authors', [AdminUserController::class, 'authors'])->name('users.authors');
    Route::get('/users/guests', [AdminUserController::class, 'guests'])->name('users.guests');
    Route::delete('/user/destroy/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/change-role{user}', [AdminUserController::class, 'changeRole'])->name('change-role.user');
});

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/home', [PostController::class, 'index'])->name('index');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
        Route::post('/like/{post}', [PostController::class, 'like'])->name('like');
        Route::post('/dislike/{post}', [PostController::class, 'dislike'])->name('dislike');
        Route::post('/comment/{post}', [PostController::class, 'comment'])->name('comment');
        Route::post('/comment/like/{comment}', [PostController::class, 'likeComment'])->name('like.comment');
        Route::post('/comment//dislike/{comment}', [PostController::class, 'dislikeComment'])->name('dislike.comment');
        Route::get('/tag/{tag}', [PostController::class, 'tag'])->name('tag');
    });
});

Route::group(['prefix' => 'definition', 'as' => 'definition.'], function () {
    Route::get('/definitions', [DefinitionController::class, 'index'])->name('index');
    Route::get('/show/{definition}', [DefinitionController::class, 'show'])->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/create', [DefinitionController::class, 'create'])->name('create');
        Route::post('/store', [DefinitionController::class, 'store'])->name('store');
        Route::delete('/destroy/{definition}', [DefinitionController::class, 'destroy'])->name('destroy');
        Route::post('/like/{definition}', [DefinitionController::class, 'like'])->name('like');
        Route::post('/dislike/{definition}', [DefinitionController::class, 'dislike'])->name('dislike');
        Route::post('/comment/{definition}', [DefinitionController::class, 'comment'])->name('comment');
        Route::post('/comment/like/{comment}', [DefinitionController::class, 'likeComment'])->name('like.comment');
        Route::post('/comment/dislike/{comment}', [DefinitionController::class, 'dislikeComment'])->name('dislike.comment');
        Route::get('/tag/{tag}', [DefinitionController::class, 'tag'])->name('tag');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/{user}/posts', [ProfileController::class, 'posts'])->name('posts');
    Route::get('/{user}/definitions', [ProfileController::class, 'definitions'])->name('definitions');
});

Auth::routes();
