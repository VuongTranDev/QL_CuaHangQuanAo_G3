<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Validator;

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

    public function profile()
    {
        $makh = Session::get('makh');
        if ($makh == null) {
            return redirect('/admin_login');
        }
        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);
        $profile = DB::table('khachhang')
            ->join('taikhoanuser', 'khachhang.MATKUSER', '=', 'taikhoanuser.MAUSER')
            ->where('khachhang.MAKH', $makh)
            ->get();

        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);

        return view('home.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID' => 'required|string|max:255',
            'TENKH' => 'required|string|max:255',
            'EMAIL' => 'required|email|max:255',
            'SODIENTHOAI' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
        ], [
            'TENKH.required' => 'Vui lòng nhập tên.',
            'TENKH.max' => 'Tên không được vượt quá 255 ký tự.',
            'EMAIL.required' => 'Vui lòng nhập địa chỉ email.',
            'EMAIL.email' => 'Địa chỉ email không hợp lệ.',
            'EMAIL.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            'SODIENTHOAI.required' => 'Vui lòng nhập số điện thoại.',
            'SODIENTHOAI.regex' => 'Số điện thoại không hợp lệ.',
            'SODIENTHOAI.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'SODIENTHOAI.max' => 'Số điện thoại không được vượt quá 15 chữ số.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        DB::table('khachhang')
            ->where('ID', $validatedData['ID'])
            ->update([
                'TENKH' => $validatedData['TENKH'],
                'EMAIL' => $validatedData['EMAIL'],
                'SODIENTHOAI' => $validatedData['SODIENTHOAI']
            ]);
        return redirect('profile');
    }



    public function showAddress()
    {
        
        $makh = Session::get('makh');

        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);
        $profile = DB::table('khachhang')
            ->join('diachi', 'khachhang.MAKH', '=', 'diachi.MAKH')
            ->where('khachhang.MAKH', $makh)
            ->get();

        $locationController = new LocationController();
        $response = $locationController->getProvinces();

        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);

        if ($response->getStatusCode() == 200) {
            $provinces = json_decode($response->getContent());
        } else {
            $provinces = [];
        }


        return view('home.address', compact('profile', 'provinces'));
    }


    public function addAddress(Request $request)
    {
        $makh = Session::get('makh');

        if ($makh == null) {
            return redirect('/admin_login');
        }

        $province = $request->input('provinceName');
        $district = $request->input('districtName');
        $ward = $request->input('wardName');
        $soNha = $request->input('SoNha');

        $fullAddress = $soNha . ', ' . $ward . ', ' . $district . ', ' . $province;

        DB::table('diachi')->insert([
            'DIACHI' => $fullAddress,
            'MAKH' => $makh
        ]);

        return redirect('/address');
    }


    public function updateAddress(Request $request)
    {
        $makh = Session::get('makh');

        if ($makh == null) {
            return redirect('/admin_login');
        }

        $ID = $request->input('ID');
        $province = $request->input('provinceNameUpdate');
        $district = $request->input('districtNameUpdate');
        $ward = $request->input('wardNameUpdate');
        $soNha = $request->input('SoNhaUpdate');

        $fullAddress = $soNha . ', ' . $ward . ', ' . $district . ', ' . $province;

        DB::table('diachi')
            ->where('ID', $ID)
            ->update([
                'DIACHI' => $fullAddress,
                'MAKH' => $makh
            ]);
        return redirect('/address');
    }

    public function deleteAddress($id)
    {
        try {
            DB::table('diachi')->where('ID', $id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function showDonMua()
    {
        $makh = Session::get('makh');

        $cart = DB::select("SELECT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, SANPHAM.GIA, SANPHAM.CHATLIEU, SANPHAM.HINHANH, GIOHANG.SOLUONG, GIOHANG.THANHTIEN , GIOHANG.SIZE
        FROM GIOHANG 
        INNER JOIN SANPHAM ON SANPHAM.MASANPHAM = GIOHANG.MASP 
        WHERE MAKH = ?", [$makh]);
        $sogiohang = count($cart);

        Session::put('sogiohang', $sogiohang);
        $donmua = DB::select("SELECT *, CHITIETHOADON.SOLUONG AS SL FROM CHITIETHOADON
       INNER JOIN SANPHAM ON CHITIETHOADON.MASP = SANPHAM.MASANPHAM
       INNER JOIN HOADON ON HOADON.MAHOADON = CHITIETHOADON.MAHOADON
       WHERE MAKHACHHANG = ?", [$makh]);




        $sodonmua = count($donmua);
        return view('home.donmua', compact('donmua', 'sodonmua'));
    }
}
