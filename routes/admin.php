<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DefinitionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

// Posts
Route::get('/posts/approved', [PostController::class, 'approved'])->name('posts.approved');
Route::get('/posts/rejected', [PostController::class, 'rejected'])->name('posts.rejected');
Route::get('/posts/pending', [PostController::class, 'pending'])->name('posts.pending');
Route::get('/posts/approve/{post}', [PostController::class, 'approve'])->name('posts.approve');
Route::get('/posts/reject/{post}', [PostController::class, 'reject'])->name('posts.reject');
Route::resource('posts', PostController::class)->only(['index', 'show', 'destroy']);

// Definitions
Route::get('/definitions/approved', [DefinitionController::class, 'approved'])->name('definitions.approved');
Route::get('/definitions/rejected', [DefinitionController::class, 'rejected'])->name('definitions.rejected');
Route::get('/definitions/pending', [DefinitionController::class, 'pending'])->name('definitions.pending');
Route::get('/definitions/approve/{definition}', [DefinitionController::class, 'approve'])->name('definitions.approve');
Route::get('/definitions/reject/{definition}', [DefinitionController::class, 'reject'])->name('definitions.reject');
Route::resource('definitions', DefinitionController::class)->only(['index', 'show', 'destroy']);

// Users
Route::get('/users/{user}/posts', [UserController::class, 'posts'])->name('users.posts');
Route::get('/users/{user}/definitions', [UserController::class, 'definitions'])->name('users.definitions');
Route::get('/users/{user}/comments', [UserController::class, 'comments'])->name('users.comments');
Route::get('/users/authors', [UserController::class, 'authors'])->name('users.authors');
Route::get('/users/guests', [UserController::class, 'guests'])->name('users.guests');
Route::get('/users/change-role{user}', [UserController::class, 'changeRole'])->name('users.change-role');
Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);

// Comments
Route::get('/comments/approve/{comment}', [CommentController::class, 'approve'])->name('comments.approve');
Route::get('/comments/reject/{comment}', [CommentController::class, 'reject'])->name('comments.reject');
Route::get('/comments/approved', [CommentController::class, 'approved'])->name('comments.approved');
Route::get('/comments/pending', [CommentController::class, 'pending'])->name('comments.pending');
Route::get('/comments/rejected', [CommentController::class, 'rejected'])->name('comments.rejected');
Route::resource('comments', CommentController::class)->only(['index', 'destroy']);

// Notifications
Route::patch('/notifications/mark-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.mark');
Route::patch('/notifications/mark-all-as-read/', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark_all');
Route::resource('notifications', NotificationController::class)->only('index');
