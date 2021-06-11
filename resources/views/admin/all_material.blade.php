@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nguyên vật liệu
    </div>
    
    <div class="table-responsive">
      <?php

      use Illuminate\Support\Facades\Session;

      $message = Session::get('message');
      if ($message) {
        echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
        Session::put('message', null);
      }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên nguyên vật liệu</th>
            <th>Số lượng tồn</th>
            <th>Đơn vị đo</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_material as $key => $material_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $material_pro->material_name }}</td>
            <td>{{ $material_pro->material_qty }}</td>
            <td>
              <?php
                if ($material_pro->material_unit == 0) {
                  echo 'Kg (Kilogram)';
                } elseif ($material_pro->material_unit == 1) {
                  echo 'g (gram)';
                } elseif ($material_pro->material_unit == 2) {
                  echo 'L (liter)';
                } elseif ($material_pro->material_unit == 3) {
                  echo 'ml (milliliter)';
                } elseif ($material_pro->material_unit == 4) {
                  echo 'Hộp';
                } elseif ($material_pro->material_unit == 5) {
                  echo 'chai';
                } elseif ($material_pro->material_unit == 6) {
                  echo 'trái';
                }
              ?>
            </td>
            <td><span class="text-ellipsis">
                <?php
                if ($material_pro->material_status == 0) {
                ?>
                  <a href="{{URL::to('/unactive-material',$material_pro->material_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                } else {
                ?>
                  <a href="{{URL::to('/active-material',$material_pro->material_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span></td>
            <td>
              <a href="{{URL::to('/edit-material/'.$material_pro->material_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              </br>
              <a onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')" href="{{URL::to('/delete-material/'.$material_pro->material_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection
