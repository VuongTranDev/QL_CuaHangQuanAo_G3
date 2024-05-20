<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiSanPham;

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
     public function themVaoGioHang(Request $request){
          
          $masanpham = $request->masanpham;
          $this->showDetailProduct($masanpham);

          
     }
}
