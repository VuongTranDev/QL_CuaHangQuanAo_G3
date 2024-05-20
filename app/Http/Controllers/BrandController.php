<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect ;
use Illuminate\Http\Request;
class BrandController extends Controller
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
    public function addBrand()
    {
        $this->AuthLogin();
        $allsp = DB::table('nhanhieu')->get();
        foreach ($allsp as $sp) {
            $tongSL = DB::table('sanpham')
                ->where('sanpham.MANH', $sp->MANH)
                ->count();
            $sp->SOLUONG = $tongSL; 
        }
        return view('brand.addbrands', compact('allsp'));
    }
    public function saveBrand(Request $request)
    {
        try {
            $data = array();
            $data['MANH'] = $request->maTH;
            $data['TENNH'] = $request->tenTH;       
            $data['QUOCGIA'] = $request->quocgia;       
            DB::table('nhanhieu')->insert($data);

            Session::put('message','Thêm thành công!!!');
            return Redirect::to('addbrands') ;
        } catch (\Exception $e) {
            
            Session::put('message','Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addbrands');
        }
    }
    public function editBrand($ID)
    {
        $this->AuthLogin();
        $editTH = DB::table('nhanhieu')->where('ID',$ID)->get();
        return view('brand.editbrand', compact('editTH'));
    }

    public function updateBrand(Request $request,$ID)
    {
        try {
            $data = array();
            $data['MANH'] = $request->maTH;
            $data['TENNH'] = $request->tenTH;       
            $data['QUOCGIA'] = $request->quocgia;       
            DB::table('nhanhieu')->where('ID',$ID)->update($data) ;
            Session::put('message','Cập nhật thành công!!!');
            return Redirect::to('addbrands') ;
        } catch (\Exception $e) {
            
            Session::put('message','Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addbrands');
        }
    }
    public function deleteBrand($ID)
    { 
        $this->AuthLogin();
        DB::table('nhanhieu')->where('ID', $ID)->delete();
        return $this->addBrand();
    }
   
}
