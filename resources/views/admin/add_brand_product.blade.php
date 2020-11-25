@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
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
                    <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="brand_product_name">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="brand_product_name" id="brand_product_name" placeholder="Tên danh mục sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="brand_product_desc">Mô tả thương hiệu</label>
                            <textarea rows="5" class="form-control" name="brand_product_desc" placeholder="Mô tả danh mục"></textarea>
                  
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
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection