<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\UploadFileController;

Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/main/dashboard', [App\Http\Controllers\MainPageController::class, 'index'])->name('main');
Route::get('/main/add', [App\Http\Controllers\MainPageController::class, 'addPost'])->name('addPost');
Route::post('/main/add', [App\Http\Controllers\MainPageController::class, 'createpost']);
Route::get('/main/editdelte', [App\Http\Controllers\MainPageController::class, 'showallmyposts']);
Route::delete('/main/editdelte/{id}', [App\Http\Controllers\MainPageController::class, 'destroy'])->name('posts.destroy')->middleware('auth');