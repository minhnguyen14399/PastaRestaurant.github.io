@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                use Illuminate\Support\Facades\Session;
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert" style="width: auto;font-size: 17px;color: #D81B60;">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                            @foreach($edit_material as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-material/'.$edit_value->material_id)}}" method="post">
                                {{ csrf_field() }}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                                    <br />
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nguyên vật liệu</label>
                                    <input type="text" value="{{$edit_value->material_name}}" name="material_name" class="form-control" id="exampleInputEmail1" 
                                    placeholder="Tên thương hiệu">
                                    @error('material_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng tồn</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="material_qty" 
                                    id="exampleInputPassword1" >{{$edit_value->material_qty}}</textarea>
                                    @error('material_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn vị đo</label>
                                    <select name="material_unit" class="form-control input-sm m-bot15">
                                        <option value="{{$edit_value->material_unit}}">
                                        <?php
                                            if ($edit_value->material_unit == 0) {
                                                echo 'Kg (Kilogram)';
                                            } elseif($edit_value->material_unit == 1) {
                                                echo 'g (gram)';
                                            } elseif($edit_value->material_unit == 2) {
                                                echo 'L (liter)';
                                            } elseif($edit_value->material_unit == 3) {
                                                echo 'ml (milliliter)';
                                            } elseif($edit_value->material_unit == 4) {
                                                echo 'Hộp';
                                            } elseif($edit_value->material_unit == 5) {
                                                echo 'chai';
                                            } elseif($edit_value->material_unit == 6) {
                                                echo 'trái';
                                            }
                                        ?>
                                        </option>
                                        <option value="0">Kg (Kilogram)</option>
                                        <option value="1">g (gram)</option>
                                        <option value="2">L (liter)</option>
                                        <option value="3">ml (milliliter)</option>
                                        <option value="4">Hộp</option>
                                        <option value="5">chai</option>
                                        <option value="6">trái</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_material" class="btn btn-info">Cập nhật nguyên vật liệu</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>

@endsection