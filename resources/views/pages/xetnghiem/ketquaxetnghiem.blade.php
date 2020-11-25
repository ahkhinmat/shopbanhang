@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            KẾT QUẢ XÉT NGHIỆM
          </div>
          {{-- <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
              <select class="input-sm form-control w-sm inline v-middle">
                <option value="0">Tên thương hiệu</option>
                <option value="1">Ngày thêm</option>
                <option value="2">Hiển thị</option>
              </select>
              <button class="btn btn-sm btn-default">Apply</button>                
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="input-sm form-control" placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-sm btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div> --}}
          <div class="table-responsive table-wrapper">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                    <th class="headXN" scope="col">BenhNhan_Id</th>
                    <th class="headXN hide" scope="col">STT</th>
                  <th  class="headXN" scope="col">Tên xét nghiệm</th>
                  <th class="headXN" scope="col">Kết quả</th>
                  <th class="headXN" scope="col">Đơn vị tính</th>
                  <th class="headXN" scope="col">Trị số bình thường</th>
                </tr>
              </thead>
              <tbody>
                <?php   $id_dichvu_check=0;$id_nhomdichvu_check=0; $group2='';?>
                            @foreach ($kq_xnbn as $item=>$kq)
                            <?php  
                                   if($kq->NhomDichVu_Id!=$id_nhomdichvu_check){ ?>
                                    <tr>
                                        <td colspan="6"> <span class="tennhomdichvu">{{$kq->NhomNoiDung}}<span></td>
                                      </tr>
                                <?php
                                    }  ?>
                            <?php  
                                if($kq->DichVu_Id!=$id_dichvu_check){ ?>
                                    <tr>
                                        <td colspan="6"> <span class="tendichvu">{{'                 '.$kq->TenDichVu}}<span></td>
                                      </tr>
                                <?php
                                    }  ?>

                            <?php  
                            if($kq->TenGroupCap2!=''&&$group2!=$kq->TenGroup){ ?>
                                <tr>
                                    <td colspan="6"> <span class="tengroup">{{'                 '.$kq->TenGroup}}<span></td>
                                </tr>
                            <?php
                                }  ?>
                            <tr>
                                <td><span class="text-ellipsis">{{$kq->BenhNhan_Id}}</span></td>
                                <td class="hide"><span class="text-ellipsis">{{$kq->STT}}</span></td>
                                <td><span class="text-ellipsis">{{$kq->NoiDung}}</span></td>

                                <td><span class="text-ellipsis">
                                    <?php
                                    if ($kq->BatThuong==1){
                                    ?>
                                        <span class="batthuong">  {{$kq->KetQua}}</span>
                                    <?php
                                    }else {
                                    ?>
                                    <span class="">{{$kq->KetQua}}</span>
                                    <?php }?>
                            
                                </span></td>
                                <td><span class="text-ellipsis">{{$kq->DonViTinh}}</span></td>
                                <td><span class="text-ellipsis">{{$kq->CSBT}}</span></td>
                                </tr>
                                <?php $id_dichvu_check =$kq->DichVu_Id; $id_nhomdichvu_check =$kq->NhomDichVu_Id;$group2=$kq->TenGroup?>
                            @endforeach
              </tbody>
            </table>
          </div>
          <footer class="panel-footer">
            <div class="row">
              
              <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
              </div>
              <div class="col-sm-7 text-right text-center-xs">                
                <ul class="pagination pagination-sm m-t-none m-b-none">
                  <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                  <li><a href="">1</a></li>
                  <li><a href="">2</a></li>
                  <li><a href="">3</a></li>
                  <li><a href="">4</a></li>
                  <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>
          </footer>
        </div>
      </div>
</div>
@endsection