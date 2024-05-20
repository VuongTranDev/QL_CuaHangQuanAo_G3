<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect ;
use Illuminate\Http\UploadedFile;
class DetailsProductController extends Controller
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
    
    public function saveDetailProduct(Request $request)
    {
        $this->AuthLogin();
        try {
            
            $data = array();
            $data['MASANPHAM'] = $request->maSP;
            $data['TENSANPHAM'] = $request->tenSP;
            $data['GIA'] = $request->giaSP;
            $data['CHATLIEU'] = $request->chatlieuSP;
            $data['MANH'] = $request->tenNH;
            $data['MALOAI'] = $request->tenLSP;
            $file = $request->file('hinhanh');
   
            // Kiểm tra xem có tệp hình ảnh được gửi không
            $filename = null;
            if ($file )
             {  
                // upload file
                $filename = rand(0.99).'.'. $file->getClientOriginalName();
                // Di chuyển tệp hình ảnh vào thư mục public/images với tên gốcss
                $file->move('public/images', $filename);
            }
            $data['HINHANH'] = $request->hinhanh;
           
            DB::table('sanpham')->insert($data);
            Session::put('message', 'Thêm thành công!!!');
            return Redirect::to('addDetailProduct');
        } catch (\Exception $e) {
            Session::put('message', 'Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addDetailProduct');
        }
    }
    public function addDetailProduct()
    {
        $this->AuthLogin();
        $product = DB::table('loaisanpham')->get();
        $brand = DB::table('nhanhieu')->get();
        
        return view('detailproduct.addDetailProduct', compact('product', 'brand'));
    }
    public function allDetailProDuct()
    {
        $this->AuthLogin();
        $allsp = DB::table('sanpham')->get();
        return view('detailproDuct.allDetailProDuct', compact('allsp'));
    }
    public function editDetailProDuct($ID)
    {
        $this->AuthLogin();
        $editSP = DB::table('sanpham')->where('ID',$ID)->get();
        $spid = null;
        foreach($editSP as $sp )
        {
            $spid = $sp->MASANPHAM ;
        }
        $product = DB::table('loaisanpham')->get();
        $brand = DB::table('nhanhieu')->get();
        $mota = DB::table('motasanpham')
        ->where('motasanpham.MASANPHAM', $spid)
        ->get();
        return view('detailproduct.editDetailProDuct', compact('editSP','mota','product', 'brand'));
    }

    public function updateDetailProduct(Request $request, $ID)
    {
        $this->AuthLogin();
        try
        {
            $data = array();
            $data['MASANPHAM'] = $request->maSP;
            $data['TENSANPHAM'] = $request->tenSP;
            $data['GIA'] = $request->giaSP;
            $data['CHATLIEU'] = $request->chatlieuSP;
            $data['MANH'] = $request->tenNH;
            $data['MALOAI'] = $request->tenLSP;
            
           
    
            // Cập nhật bảng sanpham
            DB::table('sanpham')->where('ID', $ID)->update($data);
            // Lấy ID của sản phẩm
            $sanphamID = DB::table('sanpham')->where('ID', $ID)->value('MASANPHAM');
            if ($request->has('mota')) 
            {
                foreach ($request->mota as $index => $mota)
                 {
                    $motaData = [
                        'MOTA' => $mota
                    ];
                
                    $motaID = $request->mota_id[$index]; 
                   
                    DB::table('motasanpham')->where('ID', $motaID)->update($motaData);
                }
            }
            Session::put('message', 'Cập nhật thành công!!!');
            return Redirect::to('allDetailProduct');
        } catch (\Exception $e) {
            Session::put('message', 'Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addDetailProduct');
        }
    }
    
    // public function deleteDetailProDuct($ID)
    // { 
    //     DB::table('nhanhieu')->where('ID', $ID)->delete();
    //     return $this->addDetailProDuct();
    // }
}
