<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
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
   
    public function saveBrand(Request $request)
    {
        try {
         
            // Prepare data for insertion
            $data = [
                'MANH' => $request->maTH,
                'TENNH' => $request->tenTH,
                'QUOCGIA' => $request->tenQG,
            ];
           
            // Insert data into the database
            DB::table('nhanhieu')->insert($data);

            // Set success message
            Session::put('message', 'Thêm thành công!!!');
            return Redirect::to('addbrands');
        } catch (\Exception $e) {
            // Handle exceptions and set error message
            Session::put('message', 'Hãy xem lại mã loại hoặc tên sản phẩm!!!');
            return Redirect::to('addbrands');
        }
    }

    public function addBrand()
    {
        $this->AuthLogin();

        // Lấy danh sách các quốc gia từ API
        $response = Http::timeout(30)->get('https://countriesnow.space/api/v0.1/countries');

        if ($response->successful()) {
            $countries = $response->json()['data'];
        } else {
            $countries = []; // Nếu API lỗi, đặt mảng rỗng
        }

        // Lấy thông tin các nhãn hiệu và số lượng sản phẩm
        $allsp = DB::table('nhanhieu')->get();
        foreach ($allsp as $sp) {
            $tongSL = DB::table('sanpham')
                ->where('sanpham.MANH', $sp->MANH)
                ->count();
            $sp->SOLUONG = $tongSL; 
        }

        // Trả về view và truyền dữ liệu
        return view('brand.addbrands', compact('allsp', 'countries'));
    }

    public function updateBrand(Request $request,$ID)
    {
        try {
            
            $data = array();
            $data['MANH'] = $request->maTH;
            $data['TENNH'] = $request->tenTH;       
            $data['QUOCGIA'] = $request->tenQG;       
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

 
    public function editBrand($ID)
    {
        $this->AuthLogin();
          // Lấy danh sách các quốc gia từ API
          $response = Http::timeout(30)->get('https://countriesnow.space/api/v0.1/countries');

          if ($response->successful()) {
              $countries = $response->json()['data'];
          } else {
              $countries = []; // Nếu API lỗi, đặt mảng rỗng
          }
  
        $editTH = DB::table('nhanhieu')->where('ID',$ID)->get();
        return view('brand.editbrand', compact('editTH','countries'));
    }
   
}
