<?php

use App\Http\Controllers\DanhGiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

Route::get("/", [
    HomeController::class,
    "index"
]);

Route::get("/about", [
    HomeController::class,
    "about"
]);

Route::get("/contact", [
    HomeController::class,
    "contact"
]);

Route::get("/products", [
    ProductsController::class,
    "index"
]);

Route::post('/products/search/{search_query?}', [
    ProductsController::class,
    "search"
])->name('products.search');

Route::get('/products/search/{search_query?}', [
    ProductsController::class,
    "search"
])->name('products.search');

Route::get("/product/productsJeans", [
    ProductsController::class,
    "productsJeans"
]);

Route::get('/allProducts', [
    ProductsController::class,
    "allProducts"
]);

Route::get('/products/{masanpham}', [
    ProductsController::class, 
    'showDetailProduct'
])->name('product.showDetailProduct');

Route::get('/products/productsByType/{tenloai}', [
    ProductsController::class, 
    'productsByType' 
])->name('products.productsByType');

Route::post('/danhgias/themDanhGia', [
    DanhGiaController::class,
    'themDanhGIa'
])->name('danhgias.themDanhGia');

Route::get('/danhgias/showAllComment', [
    DanhGiaController::class,
    'showAllComment'
]);

Route::get('/danhgias/filterByRating', [
    DanhGiaController::class,
    'filterByRating'
]);

Route::get('/danhgias/showDanhGia', [
    DanhGiaController::class, 
    'showDanhGia'
]);