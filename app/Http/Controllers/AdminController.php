<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect ;
session_start() ;
class AdminController extends Controller
{

    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id') ;
        if($admin_id)
        {
            return Redirect::to('admin.admin_content') ;
        }
        return Redirect::to('admin_login')->send() ;
    }
    public function index()
    {
        return view('admin_login');
    }
    public function adminlayout()
    {
        $this->AuthLogin() ;
        return view('admin.admin_content');
    }
   
    public function login(Request $request)
    {
        $login_TK = $request->login_tenTK;
        $login_MK = ($request->login_mk);
        $result = DB::table('taikhoanuser')->where('TENTK', $login_TK)->where('MATKHAU', $login_MK)->first();
        if($result)
        {
           
            if ($result->PHANQUYEN =="ADMIN") {
              
                $data = DB::table('taikhoanuser')
                ->join('thongtinadmin', 'taikhoanuser.MAUSER', '=', 'thongtinadmin.MATKUSER')
                ->where('thongtinadmin.MATKUSER',$result->MAUSER)
                ->first();
                if($data)
                {
                    Session::put('ten',$data->TENKH) ;
                    Session::put('sdt',$data->SODIENTHOAI) ;
                    Session::put('admin_id',$data->SODIENTHOAI) ;
                    return Redirect::to('admin_content') ;
                }
            }
            else if($result->PHANQUYEN =="Khách Hàng")
            {
              
                $data = DB::table('taikhoanuser')
                ->join('khachhang', 'taikhoanuser.MAUSER', '=', 'khachhang.MATKUSER')
                ->where('khachhang.MATKUSER',$result->MAUSER)
                ->first();
           
                if( $data->TENKH == "")
                    Session::put('ten',"Chưa có tên") ;
                Session::put('ten',$data->TENKH) ;
                return Redirect:: to('/') ;
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
            'MAUSER'=>$nextMatkuser,
            'TENTK' => $login_TK,
            'MATKHAU' =>  $login_MK,
            'PHANQUYEN' => $quyen,
        ]);

        $result1 = DB::table('khachhang')->insert([
            'MAKH' =>$nextMaKH,
            'TENKH' => "",
            'EMAIL' =>"" ,
            'DIACHI' =>"",
            'SODIENTHOAI'=>"",
            'MATKUSER' =>$nextMatkuser,

        ]);
        if($result && $result1)
        {
            Session::put('message','Đăng kí tài khoản thành công');
            return Redirect::to ('admin_login') ;
        }
        else
        {
            Session::put('message','Đăng kí tài khoản không thành công');
            return Redirect::to ('admin_login') ;
        }
    }
        public function logout(Request $request)
        {   
            $request->session()->invalidate();

            $request->session()->regenerateToken();

        
            return Redirect::to('admin_login'); ;
        }

    public function thongKeDS()
    {
        $this->AuthLogin() ;
        return view ('admin.thongkeDS') ;
    }

   

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
    
    public function quanLyKH()
    {
        $data = DB::SELECT('SELECT * FROM khachhang ,taikhoanuser where MAUSER = khachhang.MATKUSER and PHANQUYEN = "Khách Hàng" AND TENKH != "" ');
       
        $data1 = DB::SELECT('SELECT * FROM taikhoanuser ,thongtinadmin where MAUSER = thongtinadmin.MATKUSER and PHANQUYEN = "ADMIN"  ') ;
 
        return view('admin.quanLyKH',compact('data','data1'));
    }

    public function editTTKH($ID)
    {
        $editSP = DB::table('taikhoanuser')->where('MAUSER', $ID)->first();
        
        if ($editSP->PHANQUYEN == "ADMIN") {
            $data = DB::SELECT('SELECT * FROM taikhoanuser, thongtinadmin WHERE ? = MAUSER AND MAUSER = MATKUSER', [$ID]);
        } else {
            $data = DB::SELECT('SELECT * FROM taikhoanuser, khachhang WHERE ? = MAUSER AND MAUSER = MATKUSER', [$ID]);
        }
        return view('admin.editTTKH', compact('data'));
    }
    public function updateTTKH(Request $request , $ID)
    {
        $data = array() ;
        $data['TENKH'] = $request->tenKH;
        $data['EMAIL'] = $request->emailKH;
        $data['DIACHI'] = $request->diachiKH;
        $data['SODIENTHOAI'] = $request->sodienthoaiKH;
        $role = $request->loaiQuyen;
       
        if($role == "ADMIN")
        {

            $find = DB::table('thongtinadmin')->where('MATKUSER', $ID)->first();
        
            if($find)
            {
                
                DB::table('thongtinadmin')->where('MATKUSER', $ID)->update($data);
            }
            else
            {
                DB::table ('taikhoanuser')->where('MAUSER',$ID)->update(['PHANQUYEN' => $role]);
                $data['MATKUSER'] = $ID; 
                DB::table('thongtinadmin')->insert($data);
            }
          
        }
        else if($role == "Khách Hàng")
        {
            
            DB::table ('taikhoanuser')->where('MAUSER',$ID)->update(['PHANQUYEN' => $role]);
            $findad = DB::table('thongtinadmin')->where('MATKUSER', $ID)->first();
            if($findad)
            {
                DB::table('thongtinadmin')->where('MATKUSER', $ID)->delete();
            }
            $find = DB::table('khachhang')->where('MATKUSER', $ID)->first();
            if($find)
            {
                DB::table('khachhang')->where('MATKUSER', $ID)->update($data);
            }   
            else
            {
                $data['MATKUSER'] = $ID; 
                DB::table('khachhang')->insert($data);
            }
            
        }
        return redirect('quanLyKH');
    }
    public function deleteTTKH($ID)
    {
        DB::table('taikhoanuser')->where('MAUSER', $ID)->update(['PHANQUYEN' => ""]);
        
        return Redirect::to('quanLyKH');
    }
}
