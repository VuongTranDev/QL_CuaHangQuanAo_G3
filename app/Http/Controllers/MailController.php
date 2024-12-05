<?php

namespace App\Http\Controllers;


use App\Mail\XacNhanDonHang;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public $name;
    public $email;

    public function __construct() {}

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
    public function payWithVNPAY(Request $request)
    {
        Session::put('tongCongValue', $request->tongCongValue);
        Session::put('phiVanChuyen', $request->phiVanChuyen);
        Session::put('diaChi', $request->diaChi);


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay_return');
        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $vnp_TxnRef = rand(1, 1000000);
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'Wonder Vista Fashion';
        $vnp_Amount = $request->tongCongValue * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VNPAY';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Xin chờ 1 chút !!!.',
            'redirect' => $vnp_Url,
        ]);
    }

    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        if (!$this->verifySecureHash($request->all(), $vnp_HashSecret, $request->vnp_SecureHash)) {
            return response()->json(['status' => 'error', 'message' => 'Sai chữ ký']);
        }

        if ($request->vnp_ResponseCode == '00') {
            DB::beginTransaction();
            try {
                $makh = Session::get('makh');
                if (!$makh) {
                    Session::put('message', "Đăng nhập không thành công");
                    return view('admin_login');
                }
                $tongCongValue = Session::get('tongCongValue');
                $phiVanChuyen = Session::get('phiVanChuyen');
                Log::info('VNPAY response: ' . $phiVanChuyen);
                $diaChi = Session::get('diaChi');

                Log::info('VNPAY response: ' . $diaChi);
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
                $hoaDon = DB::table('hoadon')->where('MAKHACHHANG', $makh)->first();
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
                Log::info('thanh toan vnpay');
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
                        'THANHTIEN' => $item->THANHTIEN + ($phiVanChuyen * 1000),
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



                $CTHD = DB::select("SELECT chitiethoadon.MASP, sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, chitiethoadon.SOLUONG, chitiethoadon.THANHTIEN, chitiethoadon.SIZE
            FROM chitiethoadon
            INNER JOIN sanpham ON sanpham.MASANPHAM = chitiethoadon.MASP
            INNER JOIN hoadon ON hoadon.MAHOADON = chitiethoadon.MAHOADON
            WHERE hoadon.MAKHACHHANG = ? AND chitiethoadon.TINHTRANG = 0", [$makh]);

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
                Log::info('thanh toan vnpay nè');
                Mail::to($emailParams->usersEmail)->send(new XacNhanDonHang($emailParams));
                Session::forget('tongCongValue');
                Session::forget('phiVanChuyen');
                Session::forget('diaChi');
                DB::commit();
                return redirect()->route('home.index');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Order processing failed: ' . $e->getMessage());
                return response()->json(['status' => 'failed', 'message' => 'Xử lý đơn hàng không thành công. ' . $e->getMessage()]);
            }
        } else {
            return $this->handleVnpResponseCode($request->vnp_ResponseCode);
        }
    }
    private function verifySecureHash($inputData, $vnp_HashSecret, $vnp_SecureHash)
    {
        $inputData = collect($inputData)->except('vnp_SecureHash')->toArray();
        ksort($inputData);
        $hashData = http_build_query($inputData, '', '&');
        $generatedSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        return $generatedSecureHash === $vnp_SecureHash;
    }
    private function handleVnpResponseCode($code)
    {
        $messages = [
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch',
            '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.',
            '24' => 'Thanh toán bị hủy',
        ];

        $message = $messages[$code] ?? 'Thanh toán không thành công';
        if ($code === '24') {
            return redirect()->route('cart.index')->with('message', $message);
        }

        return response()->json(['status' => 'error', 'message' => $message]);
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
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
        $hoaDon = DB::table('hoadon')->where('MAKHACHHANG', $makh)->first();
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
                'THANHTIEN' => $item->THANHTIEN + $phiVanChuyen,
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



        $CTHD = DB::select("SELECT chitiethoadon.MASP, sanpham.TENSANPHAM, sanpham.GIA, sanpham.CHATLIEU, sanpham.HINHANH, chitiethoadon.SOLUONG, chitiethoadon.THANHTIEN, chitiethoadon.SIZE
            FROM chitiethoadon
            INNER JOIN sanpham ON sanpham.MASANPHAM = chitiethoadon.MASP
            INNER JOIN hoadon ON hoadon.MAHOADON = chitiethoadon.MAHOADON
            WHERE hoadon.MAKHACHHANG = ? AND chitiethoadon.TINHTRANG = 0", [$makh]);

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
