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

        $cart = DB::select("SELECT giohang.MASP, sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, giohang.SOLUONG, giohang.THANHTIEN , giohang.SIZE
        FROM giohang 
        INNER JOIN sanpham ON sanpham.sanpham = giohang.MASP 
        WHERE MAKH = ?", [$makh]);
        foreach ($cart as $item) {
            DB::update("UPDATE giohang SET CHONTHANHTOAN = 1 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $item->MASP, $item->SIZE]);
        }
        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM khachhang WHERE MAKH = ?", [$makh]);

        $sogiohang = count($cart);
        $tongtien = 0;
        $tongtienSP = 0;
        foreach ($cart as $item) {
            $tongtienSP += $item->THANHTIEN * $item->SOLUONG;
            $tongtien += $tongtienSP;
       }
       $diaChi = DB::select("SELECT * FROM diachi WHERE MAKH = ?", [$makh]);


        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM khachhang WHERE MAKH = ?", [$makh]);

        return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
    }
    
    public function hoanTatDonHang(Request $request)
    {
        $tenKhachHang = Session::get('ten');
        if (!$tenKhachHang) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $khachHang = DB::select("SELECT email FROM khachhang WHERE MAKH = ?", [$tenKhachHang]);

        if ($request->has('hoantatdonhang')) {
            Mail::to($khachHang[0]->email)->send(new XacNhanDonHang("Hello"));

            return "Đã gửi email xác nhận đơn hàng tới " . $khachHang[0]->email;
        } else {
            return "Nút Hoàn tất đơn hàng chưa được nhấn";
        }
    }
}
