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


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts');
    Route::get('/posts/approved', [AdminPostController::class, 'approved'])->name('approved.posts');
    Route::get('/posts/waiting', [AdminPostController::class, 'waiting'])->name('waiting.posts');
    Route::get('/post/show/{post}', [AdminPostController::class, 'show'])->name('admin.show.post');
    Route::get('/post/approve/{post}', [AdminPostController::class, 'approve'])->name('approve.post');
    Route::delete('/post/destroy/{post}', [AdminPostController::class, 'destroy'])->name('admin.destroy.post');

    Route::get('/definitions', [AdminDefinitionController::class, 'index'])->name('definitions');
    Route::get('/definitions/approved', [AdminDefinitionController::class, 'approved'])->name('approved.definitions');
    Route::get('/definitions/waiting', [AdminDefinitionController::class, 'waiting'])->name('waiting.definitions');
    Route::get('/definition/approve/{definition}', [AdminDefinitionController::class, 'approve'])->name('approve.definition');
    Route::get('/definition/show/{definition}', [AdminDefinitionController::class, 'show'])->name('admin.show.definition');
    Route::delete('/definition/destroy/{definition}', [AdminDefinitionController::class, 'destroy'])->name('admin.destroy.definition');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::delete('/user/destroy/{user}', [AdminUserController::class, 'destroy'])->name('destroy.user');
    Route::get('/users/authors', [AdminUserController::class, 'authors'])->name('users.authors');
    Route::get('/users/guests', [AdminUserController::class, 'guests'])->name('users.guests');
    Route::get('/user/change-role{user}', [AdminUserController::class, 'changeRole'])->name('change-role.user');
});

Route::get('/home', [PostController::class, 'index'])->name('index');
Route::get('/post/show/{post}', [PostController::class, 'show'])->name('show.post');
Route::middleware('auth')->prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create.post');
    Route::post('/store', [PostController::class, 'store'])->name('store.post');
    Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy.post');
    Route::post('/like/{post}', [PostController::class, 'like'])->name('like.post');
    Route::post('/dislike/{post}', [PostController::class, 'dislike'])->name('dislike.post');
    Route::post('/comment/{post}', [PostController::class, 'comment'])->name('comment.post');
    Route::post('/comment/like/{comment}', [PostController::class, 'likeComment'])->name('like.post.comment');
    Route::post('/comment//dislike/{comment}', [PostController::class, 'dislikeComment'])->name('dislike.post.comment');
    Route::get('/tag/{tag}', [PostController::class, 'tag'])->name('tag.post');
});

Route::get('/definitions', [DefinitionController::class, 'index'])->name('index.definition');
Route::get('/definition/show/{definition}', [DefinitionController::class, 'show'])->name('show.definition');
Route::middleware('auth')->prefix('definition')->group(function (){
    Route::get('/create', [DefinitionController::class, 'create'])->name('create.definition');
    Route::post('/store', [DefinitionController::class, 'store'])->name('store.definition');
    Route::delete('/destroy/{definition}', [DefinitionController::class, 'destroy'])->name('destroy.definition');
    Route::post('/like/{definition}', [DefinitionController::class, 'like'])->name('like.definition');
    Route::post('/dislike/{definition}', [DefinitionController::class, 'dislike'])->name('dislike.definition');
    Route::post('/comment/{definition}', [DefinitionController::class, 'comment'])->name('comment.definition');
    Route::post('/comment/like/{comment}', [DefinitionController::class, 'likeComment'])->name('like.definition.comment');
    Route::post('/comment/dislike/{comment}', [DefinitionController::class, 'dislikeComment'])->name('dislike.definition.comment');
    Route::get('/tag/{tag}', [DefinitionController::class, 'tag'])->name('tag.definition');
});

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('/{user}/posts', [ProfileController::class, 'posts'])->name('user.posts');
    Route::get('/{user}/definitions', [ProfileController::class, 'definitions'])->name('user.definitions');
});

Auth::routes();
