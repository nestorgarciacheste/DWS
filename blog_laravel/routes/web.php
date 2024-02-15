<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');


Route::get('/posts/nuevoPrueba', [PostController::class, 'nuevoPrueba']);
Route::get('/posts/editarPrueba/{id}', [PostController::class, 'editarPrueba']);
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::resource('posts', PostController::class);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
