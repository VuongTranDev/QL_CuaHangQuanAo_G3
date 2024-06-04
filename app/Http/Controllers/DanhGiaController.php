<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DanhGiaController extends Controller
{
    public function showDanhGia()
    {
        $danhgia = DB::table('danhgia')->where('TINHTRANG',1)->get();
        return view('danhgias.showDanhGia', compact('danhgia'));
    }

    public function themDanhGia(Request $request)
    {
        if (Session::get('makh') == null) {
            return Redirect('/admin_login');
        } else {
            $maKH = Session::get('makh');
            $maDG = $this->createMADANHGIA();
            $maCTHD = $request->input('MACTHD');
            $noiDung = $request->input('NOIDUNG');
            $soSao = $request->input('SOSAO');
            if($soSao < 4)
                $tinhtrang = 0;
            else
                $tinhtrang = 1 ;
            DB::table('danhgia')->insert([
                'MAKH' => $maKH,
                'MADANHGIA' => $maDG,
                'MACTHD' => $maCTHD,
                'NOIDUNG' => $noiDung,
                'SOSAO' => $soSao,
                'TINHTRANG' => $tinhtrang,
            ]);
            return Redirect()->back();
        }
    }

    public function xoaDanhGia($id)
    {
        try {
            DB::table('danhgia')->where('id', $id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function createMADANHGIA()
    {
        $latestMADANHGIA = DB::table('danhgia')->max('MADANHGIA');
        if (!$latestMADANHGIA) {
            return 'DG001';
        }

        $lastNumber = intval(substr($latestMADANHGIA, 3));
        $nextNumber = $lastNumber + 1;
        $newMADANHGIA = 'DG' . sprintf('%03d', $nextNumber);

        return $newMADANHGIA;
    }

    public function showAllComment()
    {
        $danhgia = DB::table('danhgia')
            ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
            ->select('khachhang.TENKH', 'danhgia.SOSAO', 'danhgia.NOIDUNG', 'danhgia.MAKH', 'danhgia.ID')
            ->where('TINHTRANG',1)
            ->paginate(10);

        $countDanhGia = $danhgia->total();
        $countDanhGia5s = DB::table('danhgia')->where('SOSAO', 5)->where('TINHTRANG',1)->count();
        $countDanhGia4s = DB::table('danhgia')->where('SOSAO', 4)->where('TINHTRANG',1)->count();
        $countDanhGia3s = DB::table('danhgia')->where('SOSAO', 3)->where('TINHTRANG',1)->count();
        $countDanhGia2s = DB::table('danhgia')->where('SOSAO', 2)->where('TINHTRANG',1)->count();
        $countDanhGia1s = DB::table('danhgia')->where('SOSAO', 1)->where('TINHTRANG',1)->count();

        $totalStar = DB::table('danhgia')->sum('SOSAO');
        $totalReviews = DB::table('danhgia')->count();

        if ($totalReviews > 0) {
            $diemDanhGiaTong = $totalStar / $totalReviews;
        } else {
            $diemDanhGiaTong = 0;
        }
        $diemDanhGiaTong = round($diemDanhGiaTong, 1);

        return view('danhgias.showAllComment', compact(
            'danhgia',
            'countDanhGia',
            'countDanhGia1s',
            'countDanhGia2s',
            'countDanhGia3s',
            'countDanhGia4s',
            'countDanhGia5s',
            'diemDanhGiaTong'
        ));
    }

    public function filterByRating($rating = null)
    {
        if ($rating === null) {
            $rating = request()->query('rating');
        }

        if ($rating == 0) {
            $danhgia = DB::table('danhgia')
                ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
                ->select('khachhang.TENKH', 'danhgia.SOSAO', 'danhgia.NOIDUNG')
                ->where('danhgia.SOSAO', 5)
                ->where('TINHTRANG',1)
                ->limit(5)
                ->get();

            $countDanhGia = $danhgia->count();
            $countDanhGia5s = DB::table('danhgia')->where('SOSAO', 5)->where('TINHTRANG',1)->count();
            $countDanhGia4s = DB::table('danhgia')->where('SOSAO', 4)->where('TINHTRANG',1)->count();
            $countDanhGia3s = DB::table('danhgia')->where('SOSAO', 3)->where('TINHTRANG',1)->count();
            $countDanhGia2s = DB::table('danhgia')->where('SOSAO', 2)->where('TINHTRANG',1)->count();
            $countDanhGia1s = DB::table('danhgia')->where('SOSAO', 1)->where('TINHTRANG',1)->count();

            $totalStar = DB::table('danhgia')->sum('SOSAO');
            $totalReviews = DB::table('danhgia')->count();

            if ($totalReviews > 0) {
                $diemDanhGiaTong = $totalStar / $totalReviews;
            } else {
                $diemDanhGiaTong = 0;
            }
            $diemDanhGiaTong = round($diemDanhGiaTong, 1);
            return view('danhgias.contentComment', compact(
                'danhgia',
                'countDanhGia',
                'countDanhGia1s',
                'countDanhGia2s',
                'countDanhGia3s',
                'countDanhGia4s',
                'countDanhGia5s',
                'diemDanhGiaTong'
            ));
        } else {
            $danhgia = DB::table('danhgia')
                ->join('khachhang', 'danhgia.MAKH', '=', 'khachhang.MAKH')
                ->select('khachhang.TENKH', 'danhgia.SOSAO', 'danhgia.NOIDUNG')
                ->where('danhgia.SOSAO', $rating)
                ->where('TINHTRANG',1)
                ->limit(5)
                ->get();

            $countDanhGia = $danhgia->count();
            $countDanhGia5s = DB::table('danhgia')->where('SOSAO', 5)->where('TINHTRANG',1)->count();
            $countDanhGia4s = DB::table('danhgia')->where('SOSAO', 4)->where('TINHTRANG',1)->count();
            $countDanhGia3s = DB::table('danhgia')->where('SOSAO', 3)->where('TINHTRANG',1)->count();
            $countDanhGia2s = DB::table('danhgia')->where('SOSAO', 2)->where('TINHTRANG',1)->count();
            $countDanhGia1s = DB::table('danhgia')->where('SOSAO', 1)->where('TINHTRANG',1)->count();

            $totalStar = DB::table('danhgia')->sum('SOSAO');
            $totalReviews = DB::table('danhgia')->count();

            if ($totalReviews > 0) {
                $diemDanhGiaTong = $totalStar / $totalReviews;
            } else {
                $diemDanhGiaTong = 0;
            }
            $diemDanhGiaTong = round($diemDanhGiaTong, 1);
            return view('danhgias.contentComment', compact(
                'danhgia',
                'countDanhGia',
                'countDanhGia1s',
                'countDanhGia2s',
                'countDanhGia3s',
                'countDanhGia4s',
                'countDanhGia5s',
                'diemDanhGiaTong'
            ));
        }
    }
}
