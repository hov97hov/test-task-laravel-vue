<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//LOGIN
Route::post('register', [AuthController::class, 'register']);
Route::post('check-login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

//CONTACT
Route::get('get-contacts', [ContactController::class, 'getContacts'])->name('getContacts');
Route::post('create-contact', [ContactController::class, 'createContact'])->name('createContact');
Route::post('update-contact', [ContactController::class, 'updateContact'])->name('updateContact');
Route::post('delete-contact', [ContactController::class, 'deleteContact'])->name('deleteContact');
Route::post('delete-contacts', [ContactController::class, 'deleteContacts'])->name('deleteContacts');
//GROUP
Route::post('create-group', [GroupsController::class, 'createGroup'])->name('createGroup');
Route::post('get-groups', [GroupsController::class, 'getGroups'])->name('getGroups');
Route::post('delete-group', [GroupsController::class, 'deleteGroup'])->name('deleteGroup');
Route::post('add-contact-group', [GroupsController::class, 'addContactGroup'])->name('addContactGroup');
//MESSAGES
Route::get('get-all-messages', [MessageController::class, 'getAllMessages'])->name('getAllMessages');
Route::post('add-archive-message', [MessageController::class, 'addArchiveMessage'])->name('addArchiveMessage');
Route::get('get-archive-message', [MessageController::class, 'getArchiveMessages'])->name('getArchiveMessages');
Route::post('delete-message', [MessageController::class, 'deleteMessage'])->name('deleteMessage');
Route::get('get-message', [MessageController::class, 'getOneMessage'])->name('getOneMessage');

