<?php

use App\Http\Controllers\DanhGiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandController;

use App\Http\Controllers\DetailsProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;

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


Route::get('/admin_login',[
    AdminController::class,
    "index"
]) ;
Route::get('/admin_content',[
    AdminController::class,
    "adminlayout"
]) ;


Route::post('/admin_TK',[
    AdminController::class,
    "login"
]) ;


Route::post('/DangKiTK',[
    AdminController::class,
    "register"
]) ;
Route::get('/logout',[
    AdminController::class,
    "logout"
]) ;
Route::get('/thongKeDS',[
    AdminController::class,
    "thongKeDS"
]) ;
Route::post('/thongKeSanLuong',[
    AdminController::class,
    "thongKeSanLuong"
]) ;

Route::get('/quanLyKH',
[
    AdminController::class,
    "quanLyKH"
]);

// CategoryProduct

Route::get('/addCategoryProduct', [
    CategoryProductController::class,
    "addProduct"
]);

Route::post('/saveCategoryProduct', [
    CategoryProductController::class,
    "saveCategoryProduct"
]);

Route::get('/editCategoryProduct/{ID}', [
    CategoryProductController::class,
    "editCategoryProduct"
]);
Route::post('/updateCategoryProduct{ID}', [
    CategoryProductController::class,
    "updateCategoryProduct"
]);

Route::get('/deleteCategoryProduct/{ID}', [
    CategoryProductController::class,
    "deleteCategoryProduct"
]);

//Brand Controller

Route::get('/addbrands', [
    BrandController::class,
    "addBrand"
]);
Route::post('/saveBrand', [
    BrandController::class,
    "SaveBrand"
]);
Route::get('/editBrand/{ID}', [
    BrandController::class,
    "editBrand"
]);
Route::post('/updateBrand{ID}', [
    BrandController::class,
    "updateBrand"
]);

Route::get('/deleteBrand/{ID}', [
    BrandController::class,
    "deleteBrand"
]);

Route::get ('/addCountry',[
    BrandController::class,
    "addCountry"
]) ;

// DetailPRoduc -- ADMIN
Route::get('/addDetailProduct',
[
    DetailsProductController::class,
    "addDetailProduct"
]);

Route::post('/saveDetailProduct',
[
    DetailsProductController::class,
    "saveDetailProduct"
]);
Route::get('/allDetailProduct',
[
    DetailsProductController::class,
    "allDetailProDuct"
]);

Route::get('/editDetailProduct/{ID}',
[
    DetailsProductController::class,
    "editDetailProDuct"
]);
Route::post('/updateDetailProduct{ID}',
[
    DetailsProductController::class,
    "updateDetailProduct"
]); 
Route::get('/phanHoiKH',
[
    DetailsProductController::class,
    "phanHoiKH"
]);

Route::post('/updateComment',
[
    DetailsProductController::class,
    "updateComment"
]);

Route::post('/replyComment',
[
    DetailsProductController::class,
    "replyComment"
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

