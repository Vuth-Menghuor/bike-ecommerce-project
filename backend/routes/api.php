<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('categories')->group(function(){
    Route::get('/', 'getCategories');
    Route::post('/', 'createCategory');
    Route::get('/{category}', 'getCategory');
    Route::patch('/{category}', 'updateCategory');
    Route::delete('/{category}', 'deleteCategory');
});


Route::controller(ProductController::class)->prefix('products')->group(function(){
    Route::get('/', 'getProducts');
    Route::post('/', 'createProduct');
    Route::get('/{product}', 'getProduct');
    Route::patch('/{product}', 'updateProduct');
    Route::delete('/{product}', 'deleteProduct');
}); 