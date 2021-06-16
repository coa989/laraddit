<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/posts', [AdminController::class, 'allPosts'])->name('posts');
    Route::get('/posts/approved', [AdminController::class, 'approvedPosts'])->name('approved.posts');
    Route::get('/posts/waiting', [AdminController::class, 'waitingPosts'])->name('waiting.posts');
    Route::get('/posts/approve/{post}', [AdminController::class, 'approvePost'])->name('approve.post');
    Route::get('/posts/show/{post}', [AdminController::class, 'showPost'])->name('show.post');
    Route::delete('/posts/delete/{post}', [AdminController::class, 'destroyPost'])->name('destroy.post');
    Route::get('/definitions', [AdminController::class, 'allDefinitions'])->name('definitions');
    Route::get('/definitions/approved', [AdminController::class, 'approvedDefinitions'])->name('approved.definitions');
    Route::get('/definitions/waiting', [AdminController::class, 'waitingDefinitions'])->name('waiting.definitions');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
