<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\XacNhanDonHang;

class HoaDonController extends Controller
{

    public function thanhtoan()
    {
        $cart = DB::select("SELECT SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = 'KH001'");
        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = 'KH001'");

        $sogiohang = count($cart);
        return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile'));
    }
    public function hoanTatDonHang(Request $request)
    {
        $khachHang = DB::select("SELECT email FROM KHACHHANG WHERE MAKH = 'KH001'");

        if ($request->has('hoantatdonhang')) {
            Mail::to($khachHang[0]->email)->send(new XacNhanDonHang("Hello"));

            return "Đã gửi email xác nhận đơn hàng tới " . $khachHang[0]->email;
        } else {
            return "Nút Hoàn tất đơn hàng chưa được nhấn";
        }
    }
}
