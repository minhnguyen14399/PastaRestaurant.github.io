@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    
    <div class="table-responsive">
        <?php
            use Illuminate\Support\Facades\Session;
            use Illuminate\Support\Facades\Crypt;
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                Session::put('message',null);
            }
            
        ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên sản phẩm</th>
            <th>Số lượng tồn</th>
            <th>Giá</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $pro)
            <?php
              $pro_encryted = Crypt::encryptString((string)$pro->product_id);
            ?>
          <tr>
            <td><a href="{{URL::to('/material-details/'.$pro_encryted)}}">{{ $pro->product_name }}</a></td>
            <td>{{ $pro->product_quantity }}</td>
            <td>{{number_format($pro->product_price)}}</td>
            <td><img src="public/upload/product/{{ $pro->product_image }}" height="100" width="100"></td>
            <td>{{ $pro->category_name }}</td>
            <td><span class="text-ellipsis">
                <?php
                if($pro->product_status == 0){
                ?>
                    <a href="{{URL::to('/unactive-product',$pro_encryted)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }
                else{
                ?>
                    <a href="{{URL::to('/active-product',$pro_encryted)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro_encryted)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              </br>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$pro_encryted)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3"> <!-- IMPORT DATA -->
              <form action="{{url('import-product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx"><br>
                <input type="submit" value="Nhập Sản phẩm" name="import_csv" class="btn btn-warning">
              </form>
            </td>
            <td colspan="4"> <!-- EXPORT DATA -->
              <form action="{{url('export-product')}}" method="POST">
                @csrf
                <input type="submit" value="Xuất Sản phẩm" name="export_csv" class="btn btn-success">
              </form>
            </td>
        </tr>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection