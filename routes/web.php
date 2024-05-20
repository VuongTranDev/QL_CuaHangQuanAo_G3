<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\HoaDonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MailController;
use App\Mail\XacNhanDonHang;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Mail;


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

Route::get('/cart/index', [
    CartController::class,
    "index"
]);

Route::get('/hoadon/thanhtoan', [
    HoaDonController::class,
    "thanhtoan"
]);
Route::get('/hoadon/thanhtoan', [
    HoaDonController::class,
    "thanhtoan"
]);
Route::get('/emails/xacnhandonhang', [
    MailController::class,
    "test"
]);


Route::post('/hoantatdonhang', 'App\Http\Controllers\DonHangController@hoanTatDonHang')->name('hoantatdonhang');
Route::get('/sendEmail', 'MailController@test')->name('sendEmail');
Route::post('/sendEmail', 'MailController@sendEmail')->name('sendEmail');
Route::post('/sendEmail', [MailController::class, 'sendEmail'])->name('sendEmail');



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