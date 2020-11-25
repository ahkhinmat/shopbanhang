@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thương hiệu sản phẩm
                </header>   <?php
                        $message=Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session :: put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    @foreach ($edit_brand_product as $item=>$edit_value)
                       <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="brand_product_name">Tên thương hiệu</label>
                        <input type="text" class="form-control" value="{{$edit_value->brand_name}}" name="brand_product_name" id="brand_product_name" placeholder="Tên thương hiệu sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="brand_product_desc">Mô tả</label>
                            <textarea rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả thương hiệu"> {{$edit_value->brand_desc}}
                            </textarea>
                  
                        </div>
                        <div class="form-group">
                            <label for="brand_product_status">Hiển thị</label> 
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
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
                        <button type="submit" name="add_brand_product" class="btn btn-info">Lưu</button>
                    </form>
                    </div>
                 @endforeach
                  

                </div>
            </section>

    </div>
</div>
@endsection