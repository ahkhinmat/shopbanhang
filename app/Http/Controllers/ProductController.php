<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use file;
use Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
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
        $all_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product=view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('manager_product',$manager_product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthenLogin();
        $cate_product=DB::table('tbl_category_product')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->orderby( 'brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
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
        $data['product_name']=$request->product_name;   
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;     
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;

        $get_image = $request->product_image;
        if($get_image){
            $get_image_name=$get_image->getClientOriginalName();
            $image_name=current(explode('.',$get_image_name));
        // $new_image=rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        $new_image=$image_name.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm  sản phẩm thành công');
        }else{
            $data['product_image']=' ';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm  sản phẩm thành công');
        }
        return redirect()->route('add-product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->where('brand_status','0')->orderby( 'brand_id','desc')->get();
        $details_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        return view('pages.sanpham.showdetails')
        ->with('category_home',$cate_product)
        ->with('brand_home',$brand_product)
        ->with('details_product',$details_product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $this->AuthenLogin();
        $cate_product=DB::table('tbl_category_product')->orderby( 'category_id','desc')->get();
        $brand_product=DB::table('tbl_brand_product')->orderby( 'brand_id','desc')->get();
       
        $edit_product= DB::table('tbl_product')->where('product_id',$product_id)->get( );
        $manager_product=view('admin.edit_product')->with('edit_product', $edit_product)
         ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('manager_product',$manager_product);
    
    }
    public function active($product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message',' Không kích hoạt  sản phẩm thành công');
         return  Redirect::to('/all-product');
    }
    public function unactive($product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt  sản phẩm thành công');
        return  Redirect::to('/all-product');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        //dd( $request);
        $this->AuthenLogin();
        $data=array();
        $data['product_name']=$request->product_name;   
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;     
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;
        
        $get_image = $request->file('product_image');
        if($get_image){
            $get_image_name=$get_image->getClientOriginalName();
            $image_name=current(explode('.',$get_image_name));
           $new_image=$image_name.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật thông tin  sản phẩm thành công');
         }else{
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật thông tin  sản phẩm thành công');
         }
        return  Redirect::to('/all-product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $this->AuthenLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','xóa sản phẩm thành công');
        return  Redirect::to('/all-product');
    }
}
