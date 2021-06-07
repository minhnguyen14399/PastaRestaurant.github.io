@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Banner
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
            
            <th>Tên Banner</th>
            <th>Hình ảnh</th>
            <th>Nội dung</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_banner as $key => $banner)
          <tr>
            
            <td>{{ $banner->banner_name }}</td>
            <td><img src="public/upload/banner/{{ $banner->banner_image }}" height="100" width="100"></td>
            <td>{{$banner->banner_desc}}</td>
            <td><span class="text-ellipsis">
                <?php
                if ($banner->banner_status == 0) {
                ?>
                  <a href="{{URL::to('/unactive-banner',$banner->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                } else {
                ?>
                  <a href="{{URL::to('/active-banner',$banner->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span></td>
            <td>
              <a href="{{URL::to('/edit-banner/'.$banner->banner_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              </br>
              <a onclick="return confirm('Bạn có chắc muốn xóa banner này không?')" href="{{URL::to('/delete-banner/'.$banner->banner_id)}}" class="active styling-edit" ui-toggle-class="">
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