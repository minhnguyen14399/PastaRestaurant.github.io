@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nguyên vật liệu
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
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-material')}}" method="post">
                                {{ csrf_field() }}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Lỗi!</strong> Kiểm tra lại thông tin đã nhập!.
                                    <br />
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nguyên vật liệu</label>
                                    <input type="text" name="material_name" class="form-control" id="exampleInputEmail1">
                                    @error('material_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn</label>
                                    <input type="text" name="material_qty" class="form-control" id="exampleInputEmail1" >
                                    @error('material_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn vị đo</label>
                                    <select name="material_unit" class="form-control input-sm m-bot15">
                                        
                                        <option value="0">Kg (Kilogram)</option>
                                        <option value="1">g (gram)</option>
                                        <option value="2">L (liter)</option>
                                        <option value="3">ml (millilit)</option>
                                        <option value="4">Hộp</option>
                                        <option value="5">chai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="material_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_material" class="btn btn-info">Thêm nguyên vật liệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection