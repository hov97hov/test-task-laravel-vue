<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
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

//login
Route::get('/login', [LoginController::class, 'loginPage'])->name('loginPage');
Route::get('/register', [LoginController::class, 'register'])->name('register');

//Groups
Route::get('/groups', [GroupsController::class, 'index'])->name('index.groups');
Route::get('/group/{id}', [GroupsController::class, 'groupPage'])->name('group');

//Users
Route::get('/users', [UsersController::class, 'index'])->name('index.users');
Route::get('/user/{id}', [UsersController::class, 'userPage'])->name('userPage');

Route::middleware(['auth'])->group(function () {

});
