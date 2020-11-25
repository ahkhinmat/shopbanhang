<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class BrandProductController extends Controller
{
    public function AuthenLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
           return  Redirect::to('admin')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthenLogin();
      $all_brand_product= DB::table('tbl_brand_product')->get();
      $manager_brand_product=view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('manager_brand_product',$manager_brand_product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthenLogin();
        return view('admin.add_brand_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->AuthenLogin();
     $data=array();
     $data['brand_name']=$request->brand_product_name;
     $data['brand_desc']=$request->brand_product_desc;
     $data['brand_status']=$request->brand_product_status;
     print_r($data);
     DB::table('tbl_brand_product')->insert($data);
     Session::put('message','Thêm thương hiệu sản phẩm thành công');

     return redirect()->route('add-brandproduct');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($brand_product_id)
    {
        $this->AuthenLogin();
        $edit_brand_product= DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get( );
        $manager_brand_product=view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('manager_brand_product',$manager_brand_product);
    }
    public function active($brand_product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message',' kích hoạt thương hiệu sản phẩm thành công');
         return  Redirect::to('/all-brandproduct');
    }
    public function unactive($brand_product_id)
    {
             $this->AuthenLogin();
            DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
            Session::put('message','không kích hoạt thương hiệu sản phẩm thành công');
            return  Redirect::to('/all-brandproduct');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brand_product_id)
    {
        $this->AuthenLogin();
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        $data['brand_status']=$request->brand_product_status;
        print_r($data);
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thông tin thương hiệu sản phẩm thành công');
   
        return  Redirect::to('/all-brandproduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','xóa thương hiệu sản phẩm thành công');
        return  Redirect::to('/all-brandproduct');
    }
}
