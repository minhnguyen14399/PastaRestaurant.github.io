@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách phí vận chuyển
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
          
            <th>STT</th>
            <th>Tỉnh/Thành phố</th>
            <th>Quận/Huyện</th>
            <th>Xã</th>
            <th>Phí</th>
            
          </tr>
        </thead>
        <?php
            use App\City;
            use App\Province;
            use App\Wards;
            $i = 0;
        ?>
        <tbody>
            @foreach($all_delivery as $key => $deli)
            <?php
            $i++;
            ?>
          <tr>
            <td>{{ $i }}</td>
            <td>ok</td>
            <td>ok</td>
            <td>ok</td>
            <td> vnđ</td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa phí vận chuyển này không?')" href="{{URL::to('/delete-delivery/')}}" class="active styling-edit" ui-toggle-class="">
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
