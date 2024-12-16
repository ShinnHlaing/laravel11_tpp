<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//static route
Route::get('/blogs', function () {
    return "This is blog page!";
});
//dynamic route
Route::get('/blogs/{id}', function ($id) {
    return "This is blog page!- $id";
});

//naming route
Route::get('/dashboard', function () {
    return "Welcome from tpp";
})->name('dashboard.tpp');

//redirect route
//only naming route can redirect
Route::get('/welcome', function () {
    return redirect()->route('dashboard.tpp');
});

//route group
Route::prefix('/tpp')->group(function () {
    Route::get('/admin', function () {
        return "This is admin";
    })->name('tpp.admin');

    Route::get('/user', function () {
        return "This is user";
    });
    //only naming route can redirect
    Route::get('/student', function () {
        return redirect()->route('tpp.admin');
    });
});

// Route::get('/categories', function () {
//     return view('categories.index');
// });
//contorller pass view
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

//day1 hw
Route::get('/article', [ArticleController::class, 'article']);
