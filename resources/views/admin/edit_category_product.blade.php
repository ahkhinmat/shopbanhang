@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục sản phẩm
                </header>   <?php
                        $message=Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session :: put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    @foreach ($edit_category_product as $item=>$edit_value)
                       <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_product_name">Tên danh mục</label>
                        <input type="text" class="form-control" value="{{$edit_value->category_name}}" name="category_product_name" id="category_product_name" placeholder="Tên danh mục sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="category_product_desc">Mô tả</label>
                            <textarea rows="5" class="form-control" name="category_product_desc" placeholder="Mô tả danh mục"> {{$edit_value->category_desc}}
                            </textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="category_product_status">Hiển thị</label> 
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Chọn ảnh sản phẩm</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Chọn ảnh này là mặc định
                            </label>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                 @endforeach
                  

                </div>
            </section>

    </div>
</div>
@endsection