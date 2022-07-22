<?php

use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/create-post', [PostController::class, 'CreatePost'])->name('CreatePost');
Route::post('/save-post', [PostController::class, 'savePost'])->name('savePost');
Route::post('/get-posts', [PostController::class, 'getPosts'])->name('getPosts');
Route::get('/update-post/{id}', [PostController::class, 'updatePost'])->name('updatePost');
Route::post('/update-post', [PostController::class, 'editPost'])->name('editPost');
