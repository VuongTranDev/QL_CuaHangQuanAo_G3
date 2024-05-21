<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect ;
use Illuminate\Http\Request;
session_start() ;
class CategoryProductController extends Controller
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
    public function addProduct()
    {
        $this->AuthLogin();
        $allsp = DB::table('loaisanpham')->get();
        
        foreach ($allsp as $sp) {
            $tongSL = DB::table('sanpham')
                ->where('sanpham.MALOAI', $sp->MALOAI)
                ->count();
            $sp->SOLUONG = $tongSL; 
        }

        return view('admin.addProduct', compact('allsp'));
    }
   

    public function saveCategoryProduct(Request $request)
    {
        try {
            $data = array();
            $data['MALOAI'] = $request->maLoai;
            $data['TENLOAI'] = $request->loaiSP;
            
            DB::table('loaisanpham')->insert($data);

            Session::put('message','Thêm thành công!!!');
            return Redirect::to('addCategoryProduct') ;
        } catch (\Exception $e) {
            
            Session::put('message','Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addCategoryProduct');
        }
    }

    public function editCategoryProduct($ID)
    {
        $this->AuthLogin();

        $editloaiSP = DB::table('loaisanpham')->where('ID',$ID)->get();
        return view('admin.editProduct', compact('editloaiSP'));
    }

    public function updateCategoryProduct(Request $request,$ID)
    {
        $this->AuthLogin();

        try {
            $data = array();
            $data['MALOAI'] = $request->maLoai;
            $data['TENLOAI'] = $request->loaiSP;       
            DB::table('loaisanpham')->where('ID',$ID)->update($data) ;
            Session::put('message','Cập nhật thành công!!!');
            return Redirect::to('addCategoryProduct') ;
        } catch (\Exception $e) {
            
            Session::put('message','Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addCategoryProduct');
        }
    }
    public function deleteCategoryProduct($ID)
    { 
        $this->AuthLogin();

        DB::table('loaisanpham')->where('ID', $ID)->delete();
        return $this->addProduct();
    }
}