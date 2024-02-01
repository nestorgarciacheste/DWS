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

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/posts', function () {
    return view('posts.listado');
})->name('post_listado');

Route::get('/post/{id?}', function ($id = 1) {
    return view('posts.ficha', ['id' => $id]);
})->where('id', "[0-9]+")->name('post_ficha');
