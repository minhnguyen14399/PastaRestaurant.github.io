@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
              <?php
                 use Illuminate\Support\Facades\Session;
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                        Session::put('message',null);
                    }
              ?>
        <div class="panel panel-default">
            <div class="panel-heading">
            Thông tin sản phẩm
            </div>  
            <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Tên Sản phẩm</th>
                    <th>Giá</th>
                    <th>Hình sản phẩm</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->product_price }}</td>
                    <td><img src="../public/upload/product/{{ $product->product_image }}" height="100" width="100"></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nguyên vật liệu
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên nguyên vật liệu</th>
            <th>Số lượng dùng</th>
            <th>Đơn vị đo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($material_details as $key => $deta)
          <tr>
            <td>{{ $deta->material_name}}</td>
            <td>{{ $deta->material_details_qty }}</td>
            <td>
              <?php
                if ($deta->material_details_unit == 0) {
                  echo 'Kg (Kilogram)';
                } elseif ($deta->material_details_unit == 1) {
                  echo 'g (gram)';
                } elseif ($deta->material_details_unit == 2) {
                  echo 'L (liter)';
                } elseif ($deta->material_details_unit == 3) {
                  echo 'ml (milliliter)';
                } elseif ($deta->material_details_unit == 4) {
                  echo 'Hộp';
                } elseif ($deta->material_details_unit == 5) {
                  echo 'chai';
                } elseif ($deta->material_details_unit == 6) {
                  echo 'trái';
                }
              ?>
            </td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa nguyên vật liệu này này không?')" href="{{URL::to('/delete-details/'.$deta->material_details_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">
              <a class="btn btn-success" href="{{URL::to('/add-material-details')}}">Thêm chi tiết sản phẩm</a>
            </td>
          </tr>
        </tbody>
        
      </table>
    </div>
  </div>
</div>
@endsection