<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DefinitionController;
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
    Route::get('/post/approve/{post}', [AdminController::class, 'approvePost'])->name('approve.post');
    Route::get('/post/show/{post}', [AdminController::class, 'showPost'])->name('admin.show.post');
    Route::delete('/post/destroy/{post}', [AdminController::class, 'destroyPost'])->name('admin.destroy.post');
    Route::get('/definitions', [AdminController::class, 'allDefinitions'])->name('definitions');
    Route::get('/definitions/approved', [AdminController::class, 'approvedDefinitions'])->name('approved.definitions');
    Route::get('/definitions/waiting', [AdminController::class, 'waitingDefinitions'])->name('waiting.definitions');
    Route::get('/definition/approve/{definition}', [AdminController::class, 'approveDefinition'])->name('approve.definition');
    Route::get('/definition/show/{definition}', [AdminController::class, 'showDefinition'])->name('admin.show.definition');
    Route::delete('/definition/destroy/{definition}', [AdminController::class, 'destroyDefinition'])->name('admin.destroy.definition');
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

Route::get('/definitions', [DefinitionController::class, 'index'])->name('index.definition');
Route::middleware('auth')->prefix('definition')->group(function (){
    Route::get('/create', [DefinitionController::class, 'create'])->name('create.definition');
    Route::get('/show/{definition}', [DefinitionController::class, 'show'])->name('show.definition');
    Route::post('/store', [DefinitionController::class, 'store'])->name('store.definition');
    Route::post('/like/{definition}', [DefinitionController::class, 'like'])->name('like.definition');
    Route::post('/dislike/{definition}', [DefinitionController::class, 'dislike'])->name('dislike.definition');
    Route::post('/comment/{definition}', [DefinitionController::class, 'comment'])->name('comment.definition');
    Route::post('/comment/like/{comment}', [DefinitionController::class, 'likeComment'])->name('like.definition.comment');
    Route::post('/comment/dislike/{comment}', [DefinitionController::class, 'dislikeComment'])->name('dislike.definition.comment');
    Route::get('/tag/{tag}', [DefinitionController::class, 'tag'])->name('tag.definition');
});

Auth::routes();
