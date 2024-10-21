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
        $lastMaChiTietHoaDon = DB::table('chitiethoadon')->max('MACHITIETHOADON');

        if (!$lastMaChiTietHoaDon) {
            return 'CTHD001';
        }

        $numberPart = intval(substr($lastMaChiTietHoaDon, 4));

        $newNumberPart = $numberPart + 1;

        $newMaChiTietHoaDon = 'CTHD' . str_pad($newNumberPart, 3, '0', STR_PAD_LEFT);

        return $newMaChiTietHoaDon;
    }
    // public function generateNextMaHoaDon()
    // {
    //     $makh = Session::get('makh');
    //     $lastMaHoaDon = DB::table('HOADON')
    //         ->where('MAKHACHHANG', $makh)
    //         ->first();
    //     if ($lastMaHoaDon) {
    //         return $lastMaHoaDon[0]->MAHOADON;
    //     }

    //     $numberPart = intval(substr($lastMaHoaDon[0]->MAHOADON, 2));

    //     $newNumberPart = $numberPart + 1;

    //     $newMaHoaDon = 'HD' . str_pad($newNumberPart, 3, '0', STR_PAD_LEFT);

    //     return $newMaHoaDon;
    // }

    public function generateNextMaHoaDon()
    {
        $makh = Session::get('makh');

        $existingMaHoaDon = DB::table('hoadon')
            ->where('MAKHACHHANG', $makh)
            ->first();

        if ($existingMaHoaDon) {
            return $existingMaHoaDon->MAHOADON;
        }

        $lastGlobalMaHoaDon = DB::table('hoadon')
            ->orderBy('MAHOADON', 'desc')
            ->first();

        if ($lastGlobalMaHoaDon) {
            $numberPart = intval(substr($lastGlobalMaHoaDon->MAHOADON, 2));
        } else {
            $numberPart = 0;
        }

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

        $cart = DB::select("SELECT giohang.MASP ,sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, giohang.SOLUONG, giohang.THANHTIEN , giohang.SIZE
        FROM giohang 
        INNER JOIN sanpham ON sanpham.MASANPHAM = giohang.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);

        // foreach ($cart as $item) {
        //     DB::update("UPDATE giohang SET CHONTHANHTOAN = 1 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $item->MASP, $item->SIZE]);
        // }
        $cartUpdate = DB::select("SELECT giohang.MASP, sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, giohang.SOLUONG, giohang.THANHTIEN , giohang.SIZE
        FROM giohang 
        INNER JOIN sanpham ON sanpham.MASANPHAM = giohang.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);
        $hoaDon = DB::table('HOADON')->where('MAKHACHHANG', $makh)->first();
        if (!$hoaDon) {
            $newMaHoaDon = $this->generateNextMaHoaDon();
            DB::table('hoadon')->insert([
                'MAHOADON' => $newMaHoaDon,
                'MAKHACHHANG' => $makh,
                'NGAYDATHANG' => Carbon::now('Asia/Ho_Chi_Minh'),
                'TONGTIEN' => 0,
                'SOLUONG' => 0,
                'TINHTRANG' => 0,
            ]);
        }
        $hoaDonUpdate = DB::select("SELECT * FROM hoadon WHERE MAKHACHHANG = ?", [$makh]);
            foreach ($cartUpdate as $item) {
                $newMaChiTietHoaDon = $this->generateNextMaChiTietHoaDon();
                $tinhtrang = 0;
        
                DB::table('chitiethoadon')->insert([
                    'MACHITIETHOADON' => $newMaChiTietHoaDon,
                    'MAHOADON' => $hoaDonUpdate[0]->MAHOADON,
                    'MASP' => $item->MASP,
                    'SIZE' => $item->SIZE,
                    'SOLUONG' => $item->SOLUONG,
                    'THANHTIEN' => $item->THANHTIEN,
                    'TINHTRANG' => $tinhtrang,
                ]);
            }
        
        $chiTietHoaDon = DB::select("SELECT * FROM chitiethoadon WHERE MAHOADON = ?", [$hoaDon->MAHOADON]);
        $ngayHienTai = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($chiTietHoaDon as $item) {
            $tinhTrang = 1;
            DB::table('hoadon')
                ->where('MAKHACHHANG', $makh)
                ->update([
                    'MAHOADON' => $hoaDon->MAHOADON,
                    'SOLUONG' => $hoaDon->SOLUONG + 1,
                    'NGAYDATHANG' => $ngayHienTai,
                    'TONGTIEN' => $hoaDon->TONGTIEN + $item->THANHTIEN,
                    'TINHTRANG' => $tinhTrang,
                ]);
            DB::table('giohang')
                ->where('MAKH', $makh)
                ->where('MASP', $item->MASP)
                ->where('SIZE', $item->SIZE)
                ->delete();
        }



        $tenKhachHang = DB::select("SELECT TENKH, EMAIL FROM khachhang WHERE MAKH = ?", [$makh]);
        $ten = $tenKhachHang[0]->TENKH;
        $this->email = $tenKhachHang[0]->EMAIL;



        $CTHD = DB::select("SELECT CHITIETHOADON.MASP, sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, CHITIETHOADON.SOLUONG, CHITIETHOADON.THANHTIEN, CHITIETHOADON.SIZE
            FROM CHITIETHOADON 
            INNER JOIN sanpham ON sanpham.MASANPHAM = CHITIETHOADON.MASP 
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
        DB::table('chitiethoadon')
            ->where('MAHOADON', $hoaDon->MAHOADON)
            ->update([
                'TINHTRANG' => $tinhTrangCTHD,
            ]);
        // foreach ($emailParams->cart as $item) {
        //     $item->GIA = number_format($item->GIA * 1000, 0, ',', '.') . ' ₫';
        //     $item->THANHTIEN = number_format($item->THANHTIEN * 1000, 0, ',', '.') . ' ₫';
        // }
        // $emailParams->tongtien = number_format($emailParams->tongtien, 0, ',', '.');
        // $emailParams->phiVanChuyen = number_format($emailParams->phiVanChuyen, 0, ',', '.');
        Mail::to($emailParams->usersEmail)->send(new XacNhanDonHang($emailParams));
    }


    public function test()
    {
        $this->sendEmail(request());
    }
}
