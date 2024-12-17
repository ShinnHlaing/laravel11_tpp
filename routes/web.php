<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

//contorller pass view
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
//day1 hw
Route::get('/article', [ArticleController::class, 'article']);

//product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/proudcts/{id}', [ProductController::class, 'delete'])->name('products.delete');
