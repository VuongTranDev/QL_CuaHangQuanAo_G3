<?php

namespace App\Http\Controllers;


use App\Mail\XacNhanDonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public $name;
    public $email;

    public function __construct()
    {
    }


    public function sendEmail(Request $request)
    {
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $this->name = "HaoDepTrai2Like";
        $this->email = "vonhuthao11235@gmail.com";
        $tongCongValue = $request->input('tongCongValue');
        $phiVanChuyen = $request->input('phiVanChuyen');

        $cart = DB::select("SELECT SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);

        $tenKhachHang = DB::select("SELECT TENKH FROM KHACHHANG WHERE MAKH = ?", [$makh]);
        $ten = $tenKhachHang[0]->TENKH;

        //Thêm vào chi tiết hoá đơn và cập nhật lại hoá đơn
        //Xoá khỏi giỏ hàng

        $emailParams = new \stdClass();
        $emailParams->usersName = $ten;
        $emailParams->usersEmail = $this->email;
        $emailParams->cart = $cart;
        $emailParams->tongtien = $tongCongValue * 1000;
        $emailParams->phiVanChuyen = $phiVanChuyen * 1000;
        $emailParams->subject = "Xác nhận đơn hàng";

        Mail::to($emailParams->usersEmail)->send(new XacNhanDonHang($emailParams));

    }


    public function test()
    {
        $this->sendEmail(request());
    }
}
