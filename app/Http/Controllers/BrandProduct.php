<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// session_start();
class MaterialProduct extends Controller
{
    public function add_material(){
        return view('admin.add_material');
    }
    public function all_material(){
        $all_material = DB::table('tbl_material')->get();
        $manager_material = view('admin.all_material')->with('all_material',$all_material);
        return view('admin_layout')->with('admin.all_material',$manager_material);
    }
    public function save_material(Request $request){
        $data = array();
        $data['material_name'] = $request->material_name;
        $data['material_qty'] = $request->material_qty;
        $data['material_unit'] = $request->material_unit;
        $data['material_status'] = $request->material_status;
        DB::table('tbl_material')->insert($data);
        Session::put('message','Thêm nguyên vật liệu thành công');
        return Redirect::to('add-material');
    }
    public function unactive_material($material_id){
        DB::table('tbl_material')->where('material_id',$material_id)->update(['material_status'=>1]);
        Session::put('message','Không kích hoạt nguyên vật liệu thành công');
        return Redirect::to('all-material');
    }
    public function active_material($material_id){
        DB::table('tbl_material')->where('material_id',$material_id)->update(['material_status'=>0]);
        Session::put('message','Kích hoạt nguyên vật liệu thành công');
        return Redirect::to('all-material');
    }
    public function edit_material($material_id){
        $edit_material = DB::table('tbl_material')->where('material_id',$material_id)->get();
        $manager_material = view('admin.edit_material')->with('edit_material',$edit_material);
        return view('admin_layout')->with('admin.edit_material',$manager_material);
    }
    public function update_material(Request $request,$material_id){
        $data = array();
        $data['material_name'] = $request->material_name;
        $data['material_qty'] = $request->material_qty;
        $data['material_unit'] = $request->material_unit;

        DB::table('tbl_material')->where('material_id',$material_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm  thành công');
        return Redirect::to('all-material');
    }
    public function delete_material($material_id){
        DB::table('tbl_material')->where('material_id',$material_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm  thành công');
        return Redirect::to('all-material');  
    }
}
