<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

//static route
Route::get('/blogs', function () {
    return "This is blog page!";
});
//dynamic route
Route::get('/blogs/{id}', function ($id) {
    return "This is blog page!- $id";
});


Route::get('/dashboard', function () {
    return view('index');
})->name('dashboard');

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes(['register' => false]);
Auth::routes();



//user
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

//role
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
Route::post('/roles/{id}', [RoleController::class, 'delete'])->name('roles.delete');

//permission
// Route::resource('permissions', PermissionController::class);
Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::post('/permissions/{id}/update', [PermissionController::class, 'update'])->name('permissions.update');
Route::post('/permissions/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
// service
Route::post('/status/{id}/status', [UserController::class, 'status'])->name('users.status');
