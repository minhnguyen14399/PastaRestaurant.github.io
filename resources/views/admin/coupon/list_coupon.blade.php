@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
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
          
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Điều kiện giảm</th>
            <th>Số giảm</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
            
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td>
              <?php
                if ($cou->coupon_condition == 1) {
                  echo 'Giảm theo %';
                } elseif ($cou->coupon_condition == 2) {
                  echo 'Giảm theo tiền';
                }
              ?>
            </td>
            <td>
            <?php
                if ($cou->coupon_condition == 1) {
                  echo 'Giảm '.$cou->coupon_number.' %';
                } elseif ($cou->coupon_condition == 2) {
                  echo 'Giảm '.$cou->coupon_number.' vnđ';
                }
              ?>
            </td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa mã này không?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
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