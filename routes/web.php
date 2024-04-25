<?php

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

Route::get("/product", [
    ProductsController::class,
    "index"
]);

Route::get("/product/productsJeans", [
    ProductsController::class,
    "productsJeans"
]);

Route::get('/allProducts', [
    ProductsController::class,
    "allProducts"
]);
