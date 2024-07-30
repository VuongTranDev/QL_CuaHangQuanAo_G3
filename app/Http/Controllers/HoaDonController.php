<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\XacNhanDonHang;
use Illuminate\Support\Facades\Session;

class HoaDonController extends Controller
{

    public function thanhtoan()
    {
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }

        $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        foreach ($cart as $item) {
            DB::update("UPDATE GIOHANG SET CHONTHANHTOAN = 1 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $item->MASP, $item->SIZE]);
        }
        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = ?", [$makh]);

        $sogiohang = count($cart);
        $tongtien = 0;
        $tongtienSP = 0;
        foreach ($cart as $item) {
            $tongtienSP += $item->THANHTIEN * $item->SOLUONG;
            $tongtien += $tongtienSP;
       }
       $diaChi = DB::select("SELECT * FROM DIACHI WHERE MAKH = ?", [$makh]);


        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = ?", [$makh]);

        return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
    }
    
    public function hoanTatDonHang(Request $request)
    {
        $tenKhachHang = Session::get('ten');
        if (!$tenKhachHang) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $khachHang = DB::select("SELECT email FROM KHACHHANG WHERE MAKH = ?", [$tenKhachHang]);

        if ($request->has('hoantatdonhang')) {
            Mail::to($khachHang[0]->email)->send(new XacNhanDonHang("Hello"));

            return "Đã gửi email xác nhận đơn hàng tới " . $khachHang[0]->email;
        } else {
            return "Nút Hoàn tất đơn hàng chưa được nhấn";
        }
    }
}
