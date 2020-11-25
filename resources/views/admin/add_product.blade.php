@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                    <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype= multipart/form-data>
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên  sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Giá  sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_image">Ảnh sản phẩm</label>
                            <input type="file" id="product_image" name="product_image" class="form-control" >
                        
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả sản phẩm</label>
                            <textarea rows="5" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm"></textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Nội dung sản phẩm</label>
                            <textarea rows="5" class="form-control" name="product_content" placeholder="Nội dung sản phẩm"></textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="product_status">Danh mục sản phẩm</label> 
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $item=>$cate)
                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                          
                    
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_status">Thương hiệu</label> 
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $item=>$brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                        <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection