@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>

  </div>
  <div class="table-responsive">
    <?php

    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Crypt;

    $message = Session::get('message');
    if ($message) {
      echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
      Session::put('message', null);
    }
    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th>Tên danh mục</th>
          <th>Hiển thị</th>
          <th>Ngày thêm</th>
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($all_category_product as $key => $cate_pro)
        <?php
        $cate_encrypted = Crypt::encryptString((string)$cate_pro->category_id);
        ?>
        <tr>
          <td>{{ $cate_pro->category_name }}</td>
          <td><span class="text-ellipsis">
              <?php
              if ($cate_pro->category_status == 0) {
              ?>
                <a href="{{URL::to('/active-category-product',$cate_encrypted)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
              } else {
              ?>
                <a href="{{URL::to('/unactive-category-product',$cate_encrypted)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?>
            </span></td>
          <td>
            <a href="{{URL::to('/edit-category-product/'.$cate_encrypted)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </br>
            <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" href="{{URL::to('/delete-category-product/'.$cate_encrypted)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-times text-danger text"></i></a>
          </td>
        </tr>
        @endforeach
        <tr>
            <td> <!-- IMPORT DATA -->
              <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" accept=".xlsx"><br>
                <input type="submit" value="Nhập danh mục sản phẩm" name="import_csv" class="btn btn-warning">
              </form>
            </td>
            <td> <!-- EXPORT DATA -->
              <form action="{{url('export-csv')}}" method="POST">
                @csrf
                <input type="submit" value="Xuất danh mục sản phẩm" name="export_csv" class="btn btn-success">
              </form>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
  @endsection