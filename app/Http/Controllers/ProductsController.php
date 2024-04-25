<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
     public function index()
     {
          $sanpham = DB::select('SELECT * FROM sanpham');
          return view('products.index', compact('sanpham'));
     }    

     public function allProducts(){
          $sanpham = DB::select('SELECT * FROM sanpham');
          return view('products.allProducts', compact('sanpham'));
     }
}
