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
use App\Http\Controllers\LocationController;

use Illuminate\Support\Facades\Session;

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

Route::get("/profile", [
    HomeController::class,
    "profile"
]);

Route::put('/profile', [
    HomeController::class,
    'updateProfile'
])->name('profile.updateProfile');

Route::get('/address', [
    HomeController::class,
    'showAddress'
]);

Route::post('/address', [
    HomeController::class,
    'addAddress'
])->name('home.addAddress');

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

Route::delete('/xoaDanhGia/{id}', [
    DanhGiaController::class,
    'xoaDanhGia'
])->name('comments.xoaDanhGia');

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
]);
Route::get('/admin_content', [
    AdminController::class,
    "adminlayout"
]);


Route::post('/admin_TK', [
    AdminController::class,
    "login"
]);


Route::post('/DangKiTK', [
    AdminController::class,
    "register"
]);
Route::get('/logout', [
    AdminController::class,
    "logout",
]);

Route::get('/logoutUser', [
    AdminController::class,
    "logoutUser"
]);
Route::get('/checkforgotPassword', [
    AdminController::class,
    "checkforgotPassword"
]);

Route::post('/forgotPassword', [
    AdminController::class,
    "forgotPassword"
]);

Route::get('/resetPassword/{token}', [
    AdminController::class,
    "resetPassword"
]);

Route::post('/checkresetPassword', [
    AdminController::class,
    "checkresetPassword"
]);
Route::get('/thongKeDS', [
    AdminController::class,
    "thongKeDS"
]);
Route::post('/thongKeSanLuong', [
    AdminController::class,
    "thongKeSanLuong"
]);


Route::get('/quanLyKH',
[
    AdminController::class,
    "quanLyKH"
]);
Route::post('/updateTTKH{ID}',
[
    AdminController::class,
    "   "
]);

Route::get('/editTTKH/{ID}',
[
    AdminController::class,
    "editTTKH"
]);

Route::get('/deleteTTKH/{ID}',
[
    AdminController::class,
    "deleteTTKH"
]);

Route::post('/resetpassAdmin',
[
    AdminController::class,
    "resetpassAdmin"
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
Route::get('/addbrands', [
    BrandController::class,
    "addBrand"
]);


// DetailPRoduc -- ADMIN
Route::get(
    '/addDetailProduct',
    [
        DetailsProductController::class,
        "addDetailProduct"
    ]
);

Route::post(
    '/saveDetailProduct',
    [
        DetailsProductController::class,
        "saveDetailProduct"
    ]
);
Route::get(
    '/allDetailProduct',
    [
        DetailsProductController::class,
        "allDetailProDuct"
    ]
);

Route::get(
    '/editDetailProduct/{ID}',
    [
        DetailsProductController::class,
        "editDetailProDuct"
    ]
);
Route::post(
    '/updateDetailProduct{ID}',
    [
        DetailsProductController::class,
        "updateDetailProduct"
    ]
);


Route::get('/api/provinces', [
    LocationController::class, 
    'getProvinces'
]);

Route::get('/api/districts/{provinceId}', [
    LocationController::class, 
    'getDistricts'
]);

Route::get('/api/wards/{districtId}', [
    LocationController::class, 'getWards'
]);

Route::post('/update-address', [
    HomeController::class, 
    'updateAddress'
])->name('home.updateAddress');

Route::delete('/deleteAddress/{id}', [
    HomeController::class,
    'deleteAddress'
])->name('home.deleteAddress');

Route::post('/updateDetailProduct{ID}',
[
    DetailsProductController::class,
    "updateDetailProduct"
]); 
Route::get('/deleteDetailProduct/{ID}',
[
    DetailsProductController::class,
    "deleteDetailProDuct"
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
Route::get('/hoadon/thanhtoan', [CartController::class, 'showHoaDon'])->name('hoadon.thanhtoan');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');


// địa chỉ
Route::post('/updateaddress', [MailController::class, 'sendEmail'])->name('update.address');


// đơn mua
Route::get('/donmua', [
    HomeController::class,
    'showDonMua'
]);
    
