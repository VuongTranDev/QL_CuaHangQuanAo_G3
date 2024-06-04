<?php

namespace App\Http\Controllers;


use App\Mail\XacNhanDonHang;
use Carbon\Carbon;
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

    public function generateNextMaChiTietHoaDon()
    {
        $lastMaChiTietHoaDon = DB::table('CHITIETHOADON')->max('MACHITIETHOADON');

        if (!$lastMaChiTietHoaDon) {
            return 'CTHD001';
        }

        $numberPart = intval(substr($lastMaChiTietHoaDon, 4));

        $newNumberPart = $numberPart + 1;

        $newMaChiTietHoaDon = 'CTHD' . str_pad($newNumberPart, 3, '0', STR_PAD_LEFT);

        return $newMaChiTietHoaDon;
    }
    public function generateNextMaHoaDon()
    {
        $makh = Session::get('makh');
        $lastMaHoaDon = DB::table('HOADON')
            ->where('MAKHACHHANG', $makh)
            ->first();

        if ($lastMaHoaDon) {
            return $lastMaHoaDon[0]->MAHOADON;
        }

        $numberPart = intval(substr($lastMaHoaDon[0]->MAHOADON, 2));

        $newNumberPart = $numberPart + 1;

        $newMaHoaDon = 'HD' . str_pad($newNumberPart, 3, '0', STR_PAD_LEFT);

        return $newMaHoaDon;
    }



    public function sendEmail(Request $request)
    {

        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $tongCongValue = $request->input('tongCongValue');
        $phiVanChuyen = $request->input('phiVanChuyen');
        $diaChi = $request->input('diaChi');

        if (!$diaChi) {
            return back();
        }

        $cart = DB::select("SELECT GIOHANG.MASP ,SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);


        // foreach ($cart as $item) {
        //     DB::update("UPDATE GIOHANG SET CHONTHANHTOAN = 1 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $item->MASP, $item->SIZE]);
        // }

        $cartUpdate = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);

        $hoaDon = DB::table('HOADON')->where('MAKHACHHANG', $makh)->first();

        if (!$hoaDon) {
            $newMaHoaDon = $this->generateNextMaHoaDon();
            DB::table('HOADON')->insert([
                'MAHOADON' => $newMaHoaDon,
                'MAKHACHHANG' => $makh,
                'NGAYDATHANG' => Carbon::now('Asia/Ho_Chi_Minh'),
                'TONGTIEN' => 0,
                'SOLUONG' => 0,
                'TINHTRANG' => 0,
            ]);
        }
        $hoaDonUpdate = DB::select("SELECT * FROM HOADON WHERE MAKHACHHANG = ?", [$makh]);
        foreach ($cartUpdate as $item) {
            $newMaChiTietHoaDon = $this->generateNextMaChiTietHoaDon();
            $tinhtrang = 0;
            DB::table('CHITIETHOADON')->insert([
                'MACHITIETHOADON' => $newMaChiTietHoaDon,
                'MAHOADON' => $hoaDonUpdate[0]->MAHOADON,
                'MASP' => $item->MASP,
                'SIZE' => $item->SIZE,
                'SOLUONG' => $item->SOLUONG,
                'THANHTIEN' => $item->THANHTIEN,
                'TINHTRANG' => $tinhtrang,
            ]);
        }

        $chiTietHoaDon = DB::select("SELECT * FROM CHITIETHOADON WHERE MAHOADON = ?", [$hoaDon->MAHOADON]);
        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($chiTietHoaDon as $item) {
            $tinhTrang = 1;
            DB::table('HOADON')
                ->where('MAKHACHHANG', $makh)
                ->update([
                    'MAHOADON' => $hoaDon->MAHOADON,
                    'SOLUONG' => $hoaDon->SOLUONG + 1,
                    'NGAYDATHANG' => $ngayHienTai,
                    'TONGTIEN' => $hoaDon->TONGTIEN + $item->THANHTIEN,
                    'TINHTRANG' => $tinhTrang,
                ]);
            DB::table('GIOHANG')
                ->where('MAKH', $makh)
                ->where('MASP', $item->MASP)
                ->where('SIZE', $item->SIZE)
                ->delete();
        }




        $tenKhachHang = DB::select("SELECT TENKH, EMAIL FROM KHACHHANG WHERE MAKH = ?", [$makh]);
        $ten = $tenKhachHang[0]->TENKH;
        $this->email = $tenKhachHang[0]->EMAIL;



        $CTHD = DB::select("SELECT CHITIETHOADON.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, CHITIETHOADON.SOLUONG, CHITIETHOADON.THANHTIEN, CHITIETHOADON.SIZE
            FROM CHITIETHOADON 
            INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = CHITIETHOADON.MASP 
            INNER JOIN HOADON ON HOADON.MAHOADON = CHITIETHOADON.MAHOADON
            WHERE HOADON.MAKHACHHANG = ? AND CHITIETHOADON.TINHTRANG = 0", [$makh]);


        $emailParams = new \stdClass();
        $emailParams->usersName = $ten;
        $emailParams->usersEmail = $this->email;
        $emailParams->cart = $CTHD;
        $emailParams->tongtien = $tongCongValue * 1000;
        $emailParams->phiVanChuyen = $phiVanChuyen * 1000;
        $emailParams->diaChi = $diaChi;
        $emailParams->subject = "Xác nhận đơn hàng";

        $tinhTrangCTHD = 1;
        DB::table('CHITIETHOADON')
            ->where('MAHOADON', $hoaDon->MAHOADON)
            ->update([
                'TINHTRANG' => $tinhTrangCTHD,
            ]);
        Mail::to($emailParams->usersEmail)->send(new XacNhanDonHang($emailParams));
    }


    public function test()
    {
        $this->sendEmail(request());
    }
}
