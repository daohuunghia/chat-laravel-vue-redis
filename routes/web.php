<?php

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
Auth::routes();

//Route::get('/', function () {
//    return view('layouts.chat');
//})->middleware('auth');
Route::prefix('chats')->group(function() {
    Route::get('/', [App\Http\Controllers\ChatController::class, 'chats'])->name('chats');
    Route::get('/messages', [App\Http\Controllers\ChatController::class, 'fetchMessages']);
    Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage']);
    Route::get('/getUserLogin', [App\Http\Controllers\ChatController::class, 'getUserLogin']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
