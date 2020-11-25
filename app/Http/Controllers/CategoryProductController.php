<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class CategoryProductController extends Controller
{
    //Adin functions
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
      $all_category_product= DB::table('tbl_category_product')->get();
      $manager_category_product=view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('manager_category_product',$manager_category_product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthenLogin();
        return view('admin.add_category_product');
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
     $data['category_name']=$request->category_product_name;
     $data['category_desc']=$request->category_product_desc;
     $data['category_status']=$request->category_product_status;
     print_r($data);
     DB::table('tbl_category_product')->insert($data);
     Session::put('message','Thêm danh mục sản phẩm thành công');

     return redirect()->route('add-categoryproduct');
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
    public function edit($category_product_id)
    {
        $this->AuthenLogin();
        $edit_category_product= DB::table('tbl_category_product')->where('category_id',$category_product_id)->get( );
        $manager_category_product=view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('manager_category_product',$manager_category_product);
    }
    public function active($category_product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message',' kích hoạt danh mục sản phẩm thành công');
         return  Redirect::to('/all-categoryproduct');
    }
    public function unactive($category_product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','không kích hoạt danh mục sản phẩm thành công');
        return  Redirect::to('/all-categoryproduct');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_product_id)
    {
        $this->AuthenLogin();
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;
        print_r($data);
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật thông tin danh mục sản phẩm thành công');
        return  Redirect::to('/all-categoryproduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','xóa danh mục sản phẩm thành công');
        return  Redirect::to('/all-categoryproduct');
    }
    //End Admin functions pages

    public function show_category_home($category_id){

        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby( 'brand_id','desc')->get();
        $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->where('tbl_category_product.category_id',$category_id)->get();
        $category_name=DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
        return view("pages.category.show_category")
        ->with('brand_home', $brand_product)
        ->with('category_home', $cate_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name);
  
    }
    public function show_brand_home($brand_id){

        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby( 'brand_id','desc')->get();
        $brand_name=DB::table('tbl_brand_product')->where('brand_id',$brand_id)->limit(1)->get();
        $brand_by_id=DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_brand_product.brand_id',$brand_id)->get();
        return view("pages.brand.show_brand")
        ->with('brand_home', $brand_product)
        ->with('category_home', $cate_product)
        ->with('brand_by_id', $brand_by_id)
        ->with('brand_name', $brand_name);
  
    }
}
