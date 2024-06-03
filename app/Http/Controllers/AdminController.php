<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class AdminController extends Controller
{

    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id') ;
        if($admin_id)
        {
            return Redirect::to('admin.admin_content') ;
        }
        return Redirect::to('admin_login')->send();
    }
    public function index()
    {
        return view('admin_login');
    }
    public function adminlayout()
    {
        $this->AuthLogin();
        return view('admin.admin_content');
    }

    public function login(Request $request)
    {
        Session::put('previous_url', url()->previous());
        
        $login_TK = $request->login_tenTK;
        $login_MK = ($request->login_mk);
        $result = DB::table('taikhoanuser')->where('TENTK', $login_TK)->where('MATKHAU', $login_MK)->first();
        if ($result) {

            if ($result->PHANQUYEN == "ADMIN") {

                $data = DB::table('taikhoanuser')
                ->join('thongtinadmin', 'taikhoanuser.MAUSER', '=', 'thongtinadmin.MATKUSER')
                ->where('thongtinadmin.MATKUSER',$result->MAUSER)
                ->first();
                if($data)
                {
                    Session::put('ten',$data->TENAD) ;
                    Session::put('sdt',$data->SODIENTHOAIAD) ;
                    Session::put('admin_id',$data->SODIENTHOAIAD) ;
                    return Redirect::to('admin_content') ;
                }
            } else if ($result->PHANQUYEN == "Khách Hàng") {

                $data = DB::table('taikhoanuser')
                ->join('khachhang', 'taikhoanuser.MAUSER', '=', 'khachhang.MATKUSER')
                ->where('khachhang.MATKUSER',$result->MAUSER)
                ->first();
           
                if( $data->TENKH == "")
                {
                    Session::put('ten',"Chưa có tên") ;
                }
                else {
                    Session::put('ten',$data->TENTK) ;
                }
                Session::put('makh', $data->MAKH);
                    
<<<<<<< HEAD
                return Redirect::to('/') ;
=======
                return Redirect:: to('/') ;
>>>>>>> NhutHaoo
            }
        }
        else
        {
            Session::put('message',"Đăng nhập không thành công") ;
            return view('admin_login');
        }
    }

    public function register(Request $request)
    {
        $quyen = "Khách Hàng";
        $login_TK = $request->TenTK;
        $login_MK = $request->MatKhau;
        $maxMatkuser = DB::table('taikhoanuser')->max('MAUSER');
        if ($maxMatkuser) {
            $nextMatkuser = 'TK' . str_pad((intval(substr($maxMatkuser, 2)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $nextMatkuser = 'TK001';
        }
        $maxKH = DB::table('khachhang')->max('MAKH');
        if ($maxKH) {
            $nextMaKH = 'KH' . str_pad((intval(substr($maxMatkuser, 2)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $nextMaKH = 'KH001';
        }

        $result = DB::table('taikhoanuser')->insert([
            'MAUSER' => $nextMatkuser,
            'TENTK' => $login_TK,
            'MATKHAU' =>  $login_MK,
            'PHANQUYEN' => $quyen,
        ]);

        $result1 = DB::table('khachhang')->insert([
            'MAKH' => $nextMaKH,
            'TENKH' => "",
            'EMAIL' => "",
            'DIACHI' => "",
            'SODIENTHOAI' => "",
            'MATKUSER' => $nextMatkuser,

        ]);
        if ($result && $result1) {
            Session::put('message', 'Đăng kí tài khoản thành công');
            return Redirect::to('admin_login');
        } else {
            Session::put('message', 'Đăng kí tài khoản không thành công');
            return Redirect::to('admin_login');
        }
    }
    public function logout()
    {   
        $this->AuthLogin() ;
        return Redirect::to('admin_login'); ;
    }

    public function logoutUser() {
        Session::flush();
        return Redirect::back();
    }

    public function thongKeDS()
    {
        return view ('admin.thongkeDS') ;
    }

    // public function thongKeSanLuong(Request $request)
    // {
    //     $data = $request->all() ;
    //     $fromdate = $data['from_date'] ;
    //     $todate = $data['to_date'] ;
    //     $get = DB::table('hoadon')->whereBetween('NGAYDATHANG',[$fromdate, $todate])->orderBy('NGAYDATHANG','ASC')->get() ;
       
    //     foreach($get as $key => $val)
    //     {
    //         $charData[] = array(
    //             'thoiGian' => $val->NGAYDATHANG,
    //             'soLuong' =>$val->SOLUONG,
    //             'tongTien' =>$val->TONGTIEN
    //         ) ;
    //     }
    //     echo $data = json_encode($charData) ;
    // }


    public function thongKeSanLuong(Request $request)
    {
        try {
            $data = $request->all();
            $fromdate = $data['from_date'];
            $todate = $data['to_date'];

            // Lấy dữ liệu từ bảng 'hoadon'
            $get = DB::table('hoadon')
                ->whereBetween('NGAYDATHANG', [$fromdate, $todate])
                ->orderBy('NGAYDATHANG', 'ASC')
                ->get();

            $charData = [];

            foreach ($get as $key => $val) {
                $charData[] = array(
                    'thoiGian' => $val->NGAYDATHANG,
                    'soLuong' => $val->SOLUONG,
                    'tongTien' => $val->TONGTIEN
                );
            }

        // Trả về phản hồi JSON
        return response()->json($charData);

    } catch (\Exception $e) {
        // Bắt lỗi và trả về phản hồi JSON
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
