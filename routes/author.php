<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\authorController;






Route::prefix('author')->name('author.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
        Route::get('/password/reset/{token}', [authorController::class, 'resetForm'])->name('reset_form');
    });

    Route::middleware(['auth:web'])->group(function(){
        Route::get('/home', [authorController::class , 'index'])->name('home');
        Route::post('/logout', [authorController::class , 'logout'])->name('logout');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::post('/change-picture-profil', [authorController::class, 'changePictureProfil'])->name('change-picture-profil');



        Route::middleware(['isAdmin'])->group(function(){
            Route::view('/categories', 'back.pages.categories')->name('categories');
            Route::view('/settings', 'back.pages.settings')->name('settings');
            Route::post('/change-blog-logo', [authorController::class, 'changeBlogLogoForm'])->name('change-blog-logo');
            Route::post('/change-blog-favicon', [authorController::class, 'changeBlogFaviconForm'])->name('change-blog-favicon');
            Route::view('/authors', 'back.pages.authors')->name('authors');
        });

        Route::prefix('posts')->name('posts.')->group(function(){
            Route::view('/add-post', 'back.pages.add-post')->name('add-post');
            Route::post('/create', [authorController::class, 'createPost'])->name('create');
            Route::view('all-posts', 'back.pages.all-posts')->name('all-posts');
            Route::get('/edit-posts',[authorController::class, 'editPost'])->name('edit-posts');
            Route::post('/update-post', [authorController::class, 'updatePost'])->name('update-post');
        });
    });
});
