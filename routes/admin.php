<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DefinitionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

Route::resource('posts', PostController::class)->only(['index', 'show', 'destroy']);

Route::resource('definitions', DefinitionController::class)->only(['index', 'show', 'destroy']);

Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);

Route::resource('comments', CommentController::class)->only(['index', 'destroy']);

Route::resource('notifications', NotificationController::class)->only('index');
