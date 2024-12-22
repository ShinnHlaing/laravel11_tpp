<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

//category
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::post('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
//day1 hw
Route::get('/article', [ArticleController::class, 'article']);

//product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::post('/proudcts/{id}', [ProductController::class, 'delete'])->name('products.delete');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
