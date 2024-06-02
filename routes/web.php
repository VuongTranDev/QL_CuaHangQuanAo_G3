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

// Giỏ hàng
Route::post('/cart/index', [
    ProductsController::class,
    "ThemVaoGioHang"
])->name('muahang');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity'])->name('updateCartQuantity');
Route::post('/process-selected-items', [CartController::class, 'processSelectedItems'])->name('processSelectedItems');
Route::post('/delete-item', [CartController::class, 'deleteItem'])->name('delete.item');

// địa chỉ
Route::post('/update-address', [MailController::class, 'sendEmail'])->name('update.address');

    