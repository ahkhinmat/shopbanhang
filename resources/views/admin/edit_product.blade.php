@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <?php
                        $message=Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session :: put('message',null);
                        }
                    ?>
                    <div class="position-center">
                        @foreach ($edit_product as $item=>$pro)
                            
         
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype= multipart/form-data>
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name" id="product_name" value="{{$pro->product_name}}">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="product_price" id="product_price" value="{{$pro->product_price}}" >
                        </div>
                        <div class="form-group">
                            <label for="product_image">Ảnh sản phẩm</label> 
                            <input type="file" id="product_image" name="product_image" class="form-control" >
                       
                        <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" width="150" height="150">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả sản phẩm</label>
                            <textarea rows="5" class="form-control" name="product_desc" value="{{$pro->product_desc}}" ></textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Nội dung sản phẩm</label>
                            <textarea rows="5" class="form-control" name="product_content" value="{{$pro->product_content}}" ></textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="product_status">Danh mục sản phẩm</label> 
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $item=>$cate)
                                    @if($cate->category_id==$pro->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else
                                    <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endif
                                @endforeach
                          
                    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_status">Thương hiệu</label> 
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $item=>$brand)
                                    @if($brand->brand_id==$pro->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_product_status">Hiển thị</label> 
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="up_product" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection