<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiSanPham;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
     public function index()
     {
          $sanpham = DB::select('SELECT * FROM sanpham');

          return view('products.index', compact('sanpham'));
     }

     public function allProducts()
     {
          $sanpham = DB::select('SELECT * FROM sanpham');

          if (isset($_GET['sort_by'])) {
               $sort_by = $_GET['sort_by'];
               if ($sort_by == 'giam_dan') {
                    $sanpham = DB::table('sanpham')->orderBy('GIA', 'desc')->get();
               } else if ($sort_by == 'tang_dan') {
                    $sanpham = DB::table('sanpham')->orderBy('GIA', 'asc')->get();
               } else if ($sort_by == 'kytu_za') {
                    $sanpham = DB::table('sanpham')->orderBy('TENSANPHAM', 'desc')->get();
               } else {
                    $sanpham = DB::table('sanpham')->orderBy('TENSANPHAM', 'asc')->get();
               }
          }
          return view('products.allProducts', compact('sanpham'));
     }

     public function showDetailProduct($masanpham)
     {
          session(['session_masp' => $masanpham]);
          $hinhanh = DB::table('hinhanh')->where('MASANPHAM', $masanpham)->get();
          $mota = DB::table('motasanpham')->where('MASANPHAM', $masanpham)->get();
          $size = DB::table('size')->where('MASANPHAM', $masanpham)->get();
          $sanpham = DB::table('sanpham')->where('MASANPHAM', $masanpham)->get();
          $sanphamgoiy = DB::table('sanpham')->inRandomOrder()->limit(8)->get();

          $sanphamdaco = DB::table('sanpham')->where('MASANPHAM', $masanpham)->first();
          $tenloai = DB::table('sanpham')
               ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
               ->where('sanpham.MASANPHAM', $masanpham)
               ->value('loaisanpham.TENLOAI');
          // dd($sanphamdaco);
          $sanphamcungloai = [];
          if ($sanphamdaco) {
               $loaisanpham = DB::select("SELECT * FROM loaisanpham WHERE MALOAI = ?", [$sanphamdaco->MALOAI]);
               if ($loaisanpham) {
                    $sanphamcungloai = DB::select("SELECT * FROM sanpham WHERE MALOAI = ? AND MASANPHAM != ? LIMIT 8", [$sanphamdaco->MALOAI, $masanpham]);
               } else {
                    $sanphamcungloai = [];
               }
          }

          $linkDanhMuc = $this->productsByType($tenloai);

          // $danhgia = DB::table('danhgia')->get();

          // $layTen = DB::table('danhgia')
          //      ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
          //      ->select('khachhang.TENKH')
          //      ->get();

          $danhgia = DB::table('danhgia')
               ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
               ->select('khachhang.TENKH', 'danhgia.SOSAO', 'danhgia.NOIDUNG')
               ->get();

          $countDanhGia = $danhgia->count();
          $countDanhGia5s = DB::table('danhgia')->where('SOSAO', 5)->count();
          $countDanhGia4s = DB::table('danhgia')->where('SOSAO', 4)->count();
          $countDanhGia3s = DB::table('danhgia')->where('SOSAO', 3)->count();
          $countDanhGia2s = DB::table('danhgia')->where('SOSAO', 2)->count();
          $countDanhGia1s = DB::table('danhgia')->where('SOSAO', 1)->count();

          $totalStar = DB::table('danhgia')->sum('SOSAO');
          $totalReviews = DB::table('danhgia')->count();

          if ($totalReviews > 0) {
               $diemDanhGiaTong = $totalStar / $totalReviews;
          } else {
               $diemDanhGiaTong = 0;
          }
          $diemDanhGiaTong = round($diemDanhGiaTong, 1);

          return view('products.showDetailProduct', compact('hinhanh', 'mota', 'size', 'sanpham', 'sanphamgoiy', 'sanphamcungloai', 'tenloai', 'danhgia', 'countDanhGia', 'countDanhGia5s', 'countDanhGia4s', 'countDanhGia3s', 'countDanhGia2s', 'countDanhGia1s', 'diemDanhGiaTong'));
     }

     public function productsByType($tenloai)
     {
          $sanphamtheoloai = DB::table('sanpham')
               ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
               ->where('loaisanpham.TENLOAI', 'like', '%' . $tenloai . '%')
               ->get();

          if (isset($_GET['sort_by'])) {
               $sort_by = $_GET['sort_by'];
               if ($sort_by == 'giam_dan') {
                    $sanphamtheoloai = DB::table('sanpham')
                         ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
                         ->where('loaisanpham.TENLOAI', 'like', '%' . $tenloai . '%')
                         ->orderBy('GIA', 'desc')
                         ->get();
               } else if ($sort_by == 'tang_dan') {
                    $sanphamtheoloai = DB::table('sanpham')
                         ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
                         ->where('loaisanpham.TENLOAI', 'like', '%' . $tenloai . '%')
                         ->orderBy('GIA', 'asc')
                         ->get();
               } else if ($sort_by == 'kytu_za') {
                    $sanphamtheoloai = DB::table('sanpham')
                         ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
                         ->where('loaisanpham.TENLOAI', 'like', '%' . $tenloai . '%')
                         ->orderBy('TENSANPHAM', 'desc')
                         ->get();
               } else {
                    $sanphamtheoloai = DB::table('sanpham')
                         ->join('loaisanpham', 'sanpham.MALOAI', '=', 'loaisanpham.MALOAI')
                         ->where('loaisanpham.TENLOAI', 'like', '%' . $tenloai . '%')
                         ->orderBy('TENSANPHAM', 'asc')
                         ->get();
               }
          }

          // dd($sanphamtheoloai);
          return view('products.productsByType', compact('sanphamtheoloai', 'tenloai'));
     }

     public function search($search_query = null)
     {
          if ($search_query === null) {
               $search_query = request()->input('search_query');
          }

          $search_product = DB::table('sanpham')
               ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')
               ->get();

          $count_product = $search_product->count();

          if (isset($_GET['sort_by'])) {
               $sort_by = $_GET['sort_by'];
               if ($sort_by == 'giam_dan') {
                    $search_product = DB::table('sanpham')
                         ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')
                         ->orderBy('GIA', 'desc')
                         ->get();
               } else if ($sort_by == 'tang_dan') {
                    $search_product = DB::table('sanpham')
                         ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')
                         ->orderBy('GIA', 'asc')
                         ->get();
               } else if ($sort_by == 'kytu_za') {
                    $search_product = DB::table('sanpham')
                         ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')
                         ->orderBy("TENSANPHAM", 'desc')
                         ->get();
               } else {
                    $search_product = DB::table('sanpham')
                         ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')
                         ->orderBy("TENSANPHAM", 'asc')
                         ->get();
               }
          }
          return view('products.search', compact('search_product', 'count_product', 'search_query'));
     }
     public function getNextMAGH()
     {
          $lastMAGH = DB::table('GIOHANG')->select('MAGH')
               ->orderBy('MAGH', 'desc')
               ->first();

          if ($lastMAGH) {
               $lastMAGH = $lastMAGH->MAGH;
               $numericPart = (int)substr($lastMAGH, 2);

               $nextNumericPart = $numericPart + 1;

               $nextMAGH = 'GH' . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
          } else {
               $nextMAGH = 'GH001';
          }

          return $nextMAGH;
     }


     public function ThemVaoGioHang(Request $request)
     {
          $makh = Session::get('makh');
          if (!$makh) {
               Session::put('message', "Đăng nhập không thành công");
               return view('admin_login');
          }
          $themvaogiohang = $request->has('themvaogiohang');
          $muangay = $request->has('muangay');
          $masanpham = session('session_masp');

          $size = $request->input('size');
          $quantity = $request->input('quantity');
          $discout = $request->input('discout');
          $priceOld = $request->input('price_old');
          $discountLabel = $request->input('discount_label');

          $totalPrice = $discout * $quantity;

          $existingProduct = DB::table('GIOHANG')
               ->where('MAKH', $makh)
               ->where('MASP', $masanpham)
               ->where('SIZE', $size)
               ->first();

          if ($existingProduct) {
               $newQuantity = $existingProduct->SOLUONG + $quantity;
               $newTotalPrice = $newQuantity * $discout;

               DB::table('GIOHANG')
                    ->where('MAGH', $existingProduct->MAGH)
                    ->update([
                         'SOLUONG' => $newQuantity,
                         'THANHTIEN' => $newTotalPrice
                    ]);
          } else {
               $newMAGH = $this->getNextMAGH();

               DB::table('GIOHANG')->insert([
                    'MAGH' => $newMAGH,
                    'MAKH' => $makh,
                    'MASP' => $masanpham,
                    'SOLUONG' => $quantity,
                    'SIZE' => $size,
                    'THANHTIEN' => $totalPrice
               ]);
          }


          if ($masanpham) {
               if ($request->has('muangay')) {

                    DB::update("UPDATE GIOHANG SET CHONTHANHTOAN = 1 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $masanpham, $size]);
                    $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
                    FROM GIOHANG 
                    INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
                    WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);
                    $tongtien = 0;
                    $tongtienSP = 0;
                    foreach ($cart as $item) {
                         $save_price = $item->GIA * (20 / 100);
                         $discout = $item->GIA - $save_price;
                         $tongtienSP += $discout * $item->SOLUONG;
                         $tongtien += $tongtienSP;
                    }

                    $tienGiam = 0;
                    $sogiohang = count($cart);
                    $diaChi = DB::select("SELECT * FROM DIACHI WHERE MAKH = ?", [$makh]);
                    $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = ?", [$makh]);
                    return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
               } else {
                    $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
                        FROM GIOHANG 
                        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
                        WHERE MAKH = ? AND CHONTHANHTOAN = 0", [$makh]);

                    $tongtien = 0;
                    $tongtienSP = 0;
                    foreach ($cart as $item) {
                         $save_price = $item->GIA * (20 / 100);
                         $discout = $item->GIA - $save_price;
                         $tongtienSP += $discout * $item->SOLUONG;
                         $tongtien += $tongtienSP;
                    }

                    $tienGiam = 0;
                    $sogiohang = count($cart);
                    return view('cart.index', compact('cart', 'sogiohang', 'tongtienSP', 'tongtien', 'tienGiam'));
               }
          } else {
               return back();
          }
     }
}
