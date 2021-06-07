@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm chi tiết sản phẩm
            </header>
            <div class="panel-body">
                <?php

                use Illuminate\Support\Facades\Session;

                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-material-details')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                            <br />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên sản phẩm</label>
                            <select name="product_id" class="form-control input-sm m-bot15">
                                @foreach($product as $key => $pro)
                                <option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tên nguyên vật liệu</label>
                            <select name="material_id" class="form-control input-sm m-bot15">
                                @foreach($material as $key => $mate)
                                <option value="{{$mate->material_id}}">{{$mate->material_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng tồn</label>
                            <input type="text" name="material_qty" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            @error('material_qty')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Đơn vị đo</label>
                            <select name="material_unit" class="form-control input-sm m-bot15">
                                <option></option>
                                <option value="0">Kg (Kilogram)</option>
                                <option value="1">g (gram)</option>
                                <option value="2">L (liter)</option>
                                <option value="3">ml (millilit)</option>
                                <option value="4">Hộp</option>
                                <option value="5">chai</option>
                            </select>
                        </div>
                        <button type="submit" name="add_material_details" class="btn btn-info">Thêm chi tiết sản phẩm </button>
                    </form>
                </div>

            </div>
        </section>

    </div>

    @endsection