<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Redirect ;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
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
            Session::put('message', 'Hãy xem lại thông tin sản phẩm!!!');
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
    $allsp = DB::table('sanpham')->paginate(10); // Thay số 10 bằng số lượng mục bạn muốn hiển thị trên mỗi trang
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
                    dd($motaData) ;
                    $motaID = $request->mota_id[$index]; 
                   
                    DB::table('motasanpham')->where('ID', $motaID)->update($motaData);
                }
            }
            Session::put('message', 'Cập nhật thành công!!!');
            return Redirect::to('allDetailProduct');
        } catch (\Exception $e) {
            Session::put('message', 'Cập nhật không thành công!!!');
            return Redirect::to('addDetailProduct');
        }
    }
    public function phanHoiKH()
    {
        $this->AuthLogin() ;
        $data =  DB::select('SELECT danhgia.MADANHGIA,danhgia.ID,danhgia.TINHTRANG,TENSANPHAM,SOSAO,TENKH,danhgia.NOIDUNG FROM danhgia INNER JOIN khachhang on danhgia.MAKH = khachhang.makh
                                                            INNER JOIN chitiethoadon on chitiethoadon.MACHITIETHOADON = danhgia.MACTHD
                                                            INNER JOIN sanpham on sanpham.MASANPHAM = chitiethoadon.MASP
                                                            ');
        $data1 = DB::select('SELECT * FROM PHANHOI');
       
        return view('detailproduct.phanHoi',compact('data','data1'));
    }
    public function updateComment(Request $request)
    {
        
        $commentId = $request->input('comment_id');
        $comment = DB::table('danhgia')->where('ID', $commentId)->first();
        if($comment)
        {
            $newStatus = ($comment->TINHTRANG== 0) ? 1 : 0 ;
            DB::table('danhgia')->where('ID', $commentId)->update(['TINHTRANG' => $newStatus]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function replyComment(Request $request)
    {
        
        try {
        
            $commentMDG = $request->input('comment_dg');
            $replyContent = $request->input('reply_content');
            // && 
            // Kiểm tra các giá trị đầu vào
            if (empty($commentMDG) && empty($replyContent)) {
                return response()->json(['success' => false, 'message' => 'Invalid input']);
            }
    
            // Lấy comment từ bảng 'danhgia'
            $comment = DB::select("SELECT * FROM danhgia WHERE MADANHGIA =  '$commentMDG' ");
    
            // Kiểm tra giá trị của $comment
            if (!$comment) {
                return response()->json(['success' => false, 'message' => 'Comment not found']);
            }
    
            $maxMaPH = DB::table('phanhoi')->max('MAPHANHOI');
            if ($maxMaPH) {
                $nextMaPH = 'PH' . str_pad((intval(substr($maxMaPH, 2)) + 1), 3, '0', STR_PAD_LEFT);
            } else {
                $nextMaPH = 'PH001';
            }
    
            // Chèn phản hồi vào bảng 'phanhoi'
            DB::table('phanhoi')->insert([
                'MADANHGIA' => $commentMDG,
                'MAPHANHOI' => $nextMaPH,
                'NOIDUNG' => $replyContent
            ]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in replyComment: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error']);
        }
    }
    

    
    public function deleteDetailProDuct($ID)
    { 
        try {
        DB::table('sanpham')->where('ID', $ID)->delete();
        return $this->allDetailProDuct();
        Session::put('message', 'Đã xoá thành công');
        return Redirect::to('allDetailProduct');
    } catch (\Exception $e) {
        Session::put('message', 'Xoá thất bại! Hãy kiểm tra lại');
        return Redirect::to('addDetailProduct');
    }
    }


}
