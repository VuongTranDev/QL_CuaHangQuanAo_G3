<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        // Lấy session mã khách hàng gán vào cái nào là 'KH001'
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }

        $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
          FROM GIOHANG 
          INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
          WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);
        $cartUpdate = DB::select("SELECT GIOHANG.MASP, SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
          FROM GIOHANG 
          INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
          WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);


        Session::put('sogiohang', $sogiohang);
        $tongtienSP = 0;
        $tongtien = 0;


        foreach ($cartUpdate as $item) {
            DB::update("UPDATE GIOHANG SET CHONTHANHTOAN = 0 WHERE MAKH = ? AND MASP = ? AND SIZE = ?", [$makh, $item->MASP, $item->SIZE]);
        }

        foreach ($cart as $item) {
            $save_price = $item->GIA * (20 / 100);
            $discout = $item->GIA - $save_price;
            $tongtienSP += $discout * $item->SOLUONG;
            $tongtien += $tongtienSP;
        }

        $tienGiam = 0;

        return view('cart.index', compact('cart', 'sogiohang', 'tongtienSP', 'tongtien', 'tienGiam'));
    }
    public function updatePaymentStatus(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        DB::table('GIOHANG')
            ->whereIn('MAGH', $selectedItems)
            ->update(['CHONTHANHTOAN' => 1]);

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function removeFromCart(Request $request)
    {
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $masp = $request->input('masp');
        $size = $request->input('size');

        DB::table('GIOHANG')
            ->where('MAKH', $makh)
            ->where('MASP', $masp)
            ->where('SIZE', $size)
            ->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

    public function updateCartQuantity(Request $request)
    {
        $masanpham = $request->input('masanpham');
        $size = $request->input('size');
        $soluong = $request->input('soluong');
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }


        $sanpham = DB::select("SELECT * FROM SANPHAM WHERE MASANPHAM = ? ", [$masanpham]);

        $donGia = $sanpham[0]->GIA;
        $giamGia = 20 / 100;
        $thanhTien = $soluong * ($donGia - ($donGia * $giamGia));

        DB::table('GIOHANG')
            ->where('MAKH', $makh)
            ->where('MASP', $masanpham)
            ->where('SIZE', $size)
            ->update(['SOLUONG' => $soluong]);
        DB::table('GIOHANG')
            ->where('MAKH', $makh)
            ->where('MASP', $masanpham)
            ->where('SIZE', $size)
            ->update(['THANHTIEN' => $thanhTien]);

        $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
            FROM GIOHANG 
            INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
            WHERE MAKH = ? AND CHONTHANHTOAN = 0", [$makh]);
        $cartUpdatePrice = DB::select("SELECT GIOHANG.MASP, SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 0 AND GIOHANG.MASP = ? AND GIOHANG.SIZE = ?", [$makh], [$masanpham], [$size]);

        $tongTienSPUpdate = 0;
        $soLuong = 0;
        foreach ($cartUpdatePrice as $item) {
            $tongTienSPUpdate = $item->GIA * $item->SOLUONG;
            $soLuong = $item->soLuong;
        }

        $tongtienSP = 0;
        $tongtien = 0;

        foreach ($cart as $item) {
            $tongtienSP += $item->GIA * $item->SOLUONG;
            $tongtien += $tongtienSP;
        }

        $tienGiam = 0;

        return response()->json([
            'tongtienSP' => $tongtienSP,
            'tongtien' => $tongtien,
            'tienGiam' => $tienGiam,
            'tongTienSPUpdate' => $tongTienSPUpdate,
            'soLuong' => $soLuong
        ]);
    }
    // public function processSelectedItems(Request $request)
    // {
    //     $selectedItems = $request->input('selected_items', []);

    //     if (empty($selectedItems)) {
    //         return back()->with('error', 'Bạn chưa chọn sản phẩm nào.');
    //     }

    //     $cartItems = [];
    //     foreach ($selectedItems as $item) {
    //         list($masanpham, $size) = explode('|', $item);
    //         $cartItems[] = DB::table('GIOHANG')
    //             ->where('MAKH', 'KH001')
    //             ->where('MASANPHAM', $masanpham)
    //             ->where('SIZE', $size)
    //             ->first();
    //     }

    //     if (empty($cartItems)) {
    //         return back()->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng.');
    //     }

    //     $sogiohang = count($cartItems);
    //     $tongtien = 0;
    //     foreach ($cartItems as $item) {
    //         $tongtien += $item->THANHTIEN;
    //     }

    //     $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = 'KH001'");

    //     return view('hoadon.thanhtoan', compact('cartItems', 'sogiohang', 'profile', 'tongtien'));
    // }
    public function processSelectedItems(Request $request)
    {
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }

        $selectedItems = $request->input('selected_items', []);

        if(!$selectedItems){
            return back();
        }
        $cart = [];
        foreach ($selectedItems as $item) {
            list($masanpham, $size) = explode('|', $item);

            $cartItems = DB::table('GIOHANG')
                ->join('SANPHAM', 'SANPHAM.MASANPHAM', '=', 'GIOHANG.MASP')
                ->select('GIOHANG.MASP', 'SANPHAM.MASANPHAM', 'SANPHAM.TENSANPHAM', 'SANPHAM.GIA', 'SANPHAM.CHATLIEU', 'SANPHAM.HINHANH', 'GIOHANG.SOLUONG', 'GIOHANG.THANHTIEN', 'GIOHANG.SIZE')
                ->where('GIOHANG.MAKH', $makh)
                ->where('GIOHANG.MASP', $masanpham)
                ->where('GIOHANG.SIZE', $size)
                ->get();

            $cart = array_merge($cart, $cartItems->toArray());

            DB::table('GIOHANG')
                ->where('MAKH', $makh)
                ->where('MASP', $masanpham)
                ->where('SIZE', $size)
                ->update(['CHONTHANHTOAN' => 1]);
        }
        $cart2 = DB::select("SELECT GIOHANG.MASP, SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN, GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);

        $cart = $cart2;


        $sogiohang = count($cart);
        $tongtien = 0;
        $tongtienSP = 0;
        foreach ($cart as $item) {
            $save_price = $item->GIA * (20 / 100);
            $discout = $item->GIA - $save_price;
            $tongtienSP += $discout * $item->SOLUONG;
            $tongtien += $tongtienSP;
        }

        $profile = DB::select("SELECT TENKH, SODIENTHOAI, DIACHI FROM KHACHHANG WHERE MAKH = ?", [$makh]);

        $diaChi = DB::select("SELECT * FROM DIACHI WHERE MAKH = ?", [$makh]);
        return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
    }

    public function deleteItem(Request $request)
    {
        $itemId = $request->input('MASP');
        $size = $request->input('SIZE');
        $makh = Session::get('makh');
        if (!$makh) {
            Session::put('message', "Đăng nhập không thành công");
            return view('admin_login');
        }
        $deleted = DB::table('GIOHANG')
            ->where('MASP', $itemId)
            ->where('SIZE', $size)
            ->where('MAKH', $makh)
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    public function showHoaDon(Request $request)
    {
        $makh = Session::get('makh');
        if ($request->has('checkout_btn')) {
            $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ? AND CHONTHANHTOAN = 0", [$makh]);
        } else {
            $cart = DB::select("SELECT GIOHANG.MASP, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
            FROM GIOHANG 
            INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
            WHERE MAKH = ? AND CHONTHANHTOAN = 1", [$makh]);
        }

        foreach($cart as $item){
            DB::table('GIOHANG')
                ->where('MAKH', $makh)
                ->where('MASP', $item->MASP)
                ->where('SIZE', $item->SIZE)
                ->update(['CHONTHANHTOAN' => 1]);
        }

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

        return view('hoadon.thanhtoan', compact('cart', 'sogiohang', 'profile', 'tongtien', 'tongtienSP', 'diaChi'));
    }

    public function showCart()
    {
        $makh = Session::get('makh');
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

        return view('cart.index', compact('cart', 'sogiohang', 'tongtienSP', 'tongtien', 'tienGiam'));
    }
}
