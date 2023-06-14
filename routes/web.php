<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\authorController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('front.pages.exemple');
});*/

Route::view('/', 'front.pages.home')->name('home');
Route::get('/article/{any}', [BlogController::class, 'readPost'])->name('read_posts');
Route::get('/category/{any}', [BlogController::class, 'categoryPost'])->name('category_posts');
Route::get('/posts/tag/{any}', [BlogController::class, 'tagPosts'])->name('tag_posts');
Route::get('/search', [BlogController::class, 'searchPost'])->name('search_posts');


