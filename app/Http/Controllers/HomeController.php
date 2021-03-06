<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
 
    public function index(){
        // $all_product= DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $all_product= DB::table('tbl_product')->where('product_status','0')->orderby( 'product_id','desc')->limit(4)->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby( 'brand_id','desc')->get();
        return view('pages.home')->with('category_home', $cate_product)
        ->with('brand_home', $brand_product)
        ->with('all_product', $all_product);
    }
}
