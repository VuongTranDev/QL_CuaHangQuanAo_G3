<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $sanphamJeans = DB::table('sanpham')->where('MALOAI', 'LQJ')->limit(4)->get();
        $sanphamAoThun = DB::table('sanpham')->where('MALOAI', 'LA')->limit(8)->get();
        $sanphamSweater = DB::table('sanpham')->where('MALOAI', 'LWT')->limit(8)->get();
        $sanphamHoodie = DB::table('sanpham')->where('MALOAI', 'LHD')->inRandomOrder()->limit(4)->get();
        $sanphamQuan = DB::table('sanpham')->where('MALOAI', 'LQ')->inRandomOrder()->limit(4)->get();
        $sanphamSoMi = DB::table('sanpham')->where('MALOAI', 'LASM')->limit(4)->get();

        $makh = Session::get('makh');

        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);
        return view('index', compact('sanphamJeans', 'sanphamAoThun', 'sanphamSweater', 'sanphamHoodie', 'sanphamQuan', 'sanphamSoMi', 'sogiohang'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
