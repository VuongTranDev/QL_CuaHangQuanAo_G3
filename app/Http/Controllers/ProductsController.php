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
          $query = DB::table('sanpham');

          if (isset($_GET['sort_by'])) {
               $sort_by = $_GET['sort_by'];
               if ($sort_by == 'giam_dan') {
                    $query->orderBy('GIA', 'desc');
               } else if ($sort_by == 'tang_dan') {
                    $query->orderBy('GIA', 'asc');
               } else if ($sort_by == 'kytu_za') {
                    $query->orderBy('TENSANPHAM', 'desc');
               } else {
                    $query->orderBy('TENSANPHAM', 'asc');
               }
          }

          $sanpham = $query->paginate(12);

          return view('products.allProducts', compact('sanpham'));
     }


     public function showDetailProduct($masanpham)
     {
          $makh = Session::get('makh');
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

          if ($makh == null) {
               return back();
          } else {
               $MACTHD = DB::select(
                    "
                    SELECT MAX(CHITIETHOADON.MACHITIETHOADON) AS max_macthd
                    FROM CHITIETHOADON
                    INNER JOIN SANPHAM ON CHITIETHOADON.MASP = SANPHAM.MASANPHAM
                    INNER JOIN HOADON ON HOADON.MAHOADON = CHITIETHOADON.MAHOADON
                    WHERE HOADON.MAKHACHHANG = ? AND SANPHAM.MASANPHAM = ?",
                    [$makh, $masanpham]
                );
                
                if (!empty($MACTHD) && isset($MACTHD[0]->max_macthd)) {
                    Session::put('macthd', $MACTHD[0]->max_macthd);
                } else {
                    // Handle the case where no rows are returned or max_macthd is not set
                    Session::put('macthd', null);
                }
                
          }




          $danhgia = DB::table('danhgia')
               ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
               ->join('chitiethoadon', 'danhgia.MACTHD', '=', 'chitiethoadon.MACHITIETHOADON')
               ->select('khachhang.TENKH', 'danhgia.SOSAO', 'danhgia.NOIDUNG', 'danhgia.MAKH', 'danhgia.ID', 'chitiethoadon.MASP')
               ->orderBy('MADANHGIA', 'desc')
               ->where('danhgia.TINHTRANG', 1)
               ->where('chitiethoadon.MASP', $masanpham)
               ->limit(5)
               ->get();

          $countDanhGia = $danhgia->count();
          $countDanhGia5s = DB::table('danhgia')->where('SOSAO', 5)->where('TINHTRANG', 1)->count();
          $countDanhGia4s = DB::table('danhgia')->where('SOSAO', 4)->where('TINHTRANG', 1)->count();
          $countDanhGia3s = DB::table('danhgia')->where('SOSAO', 3)->where('TINHTRANG', 1)->count();
          $countDanhGia2s = DB::table('danhgia')->where('SOSAO', 2)->where('TINHTRANG', 1)->count();
          $countDanhGia1s = DB::table('danhgia')->where('SOSAO', 1)->where('TINHTRANG', 1)->count();

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

          $query = DB::table('sanpham')
               ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%');

          if (request()->has('sort_by')) {
               $sort_by = request()->input('sort_by');
               if ($sort_by == 'giam_dan') {
                    $query->orderBy('GIA', 'desc');
               } else if ($sort_by == 'tang_dan') {
                    $query->orderBy('GIA', 'asc');
               } else if ($sort_by == 'kytu_za') {
                    $query->orderBy("TENSANPHAM", 'desc');
               } else if ($sort_by == 'kytu_az') {
                    $query->orderBy("TENSANPHAM", 'asc');
               }
          }

          Session::put('search_query', $search_query);

          $search_product = $query->paginate(12);
          $count_product = DB::table('sanpham')
               ->where('TENSANPHAM', 'LIKE', '%' . $search_query . '%')->count();

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
                    Session::put('sogiohang', $sogiohang);
                    //return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
                    return redirect()->route('hoadon.thanhtoan');
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
                    Session::put('sogiohang', $sogiohang);
                    return redirect()->route('cart.index');
                    //return view('cart.index', compact('cart', 'sogiohang', 'tongtienSP', 'tongtien', 'tienGiam'));
               }
          }
     }
}
