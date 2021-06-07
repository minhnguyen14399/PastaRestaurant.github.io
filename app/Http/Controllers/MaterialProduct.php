<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialDetailsRequest;
use App\Http\Requests\MaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Material;
use App\MaterialDetails;
use App\Product;
use App\OrderDetails;

class MaterialProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_material()
    {
        $this->AuthLogin();
        return view('admin.add_material');
    }
    public function all_material()
    {
        $this->AuthLogin();
        $all_material = DB::table('tbl_material')->get();
        $manager_material = view('admin.all_material')->with('all_material', $all_material);
        return view('admin_layout')->with('admin.all_material', $manager_material);
    }
    public function save_material(MaterialRequest $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['material_name'] = $request->material_name;
        $data['material_qty'] = $request->material_qty;
        $data['material_unit'] = $request->material_unit;
        $data['material_status'] = $request->material_status;
        DB::table('tbl_material')->insert($data);
        Session::put('message', 'Thêm nguyên vật liệu thành công');
        return Redirect::to('add-material');
    }
    public function unactive_material($material_id)
    {
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id', $material_id)->update(['material_status' => 1]);
        Session::put('message', 'Không kích hoạt nguyên vật liệu thành công');
        return Redirect::to('all-material');
    }
    public function active_material($material_id)
    {
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id', $material_id)->update(['material_status' => 0]);
        Session::put('message', 'Kích hoạt nguyên vật liệu thành công');
        return Redirect::to('all-material');
    }
    public function edit_material($material_id)
    {
        $this->AuthLogin();
        $edit_material = DB::table('tbl_material')->where('material_id', $material_id)->get();
        $manager_material = view('admin.edit_material')->with('edit_material', $edit_material);
        return view('admin_layout')->with('admin.edit_material', $manager_material);
    }
    public function update_material(MaterialRequest $request, $material_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['material_name'] = $request->material_name;
        $data['material_qty'] = $request->material_qty;
        $data['material_unit'] = $request->material_unit;

        DB::table('tbl_material')->where('material_id', $material_id)->update($data);
        Session::put('message', 'Cập nhật nguyên vật liệu  thành công');
        return Redirect::to('all-material');
    }
    public function delete_material($material_id)
    {
        $this->AuthLogin();
        DB::table('tbl_material')->where('material_id', $material_id)->delete();
        Session::put('message', 'Xóa nguyên vật liệu thành công');
        return Redirect::to('all-material');
    }

    //////////MATERIAL DETAILS/////////////////////

    public function add_material_details()
    {
        $this->AuthLogin();
        $product = DB::table('tbl_product')->orderby('product_id', 'desc')->get();
        $material = DB::table('tbl_material')->orderby('material_id', 'desc')->get();
        return view('admin.add_material_details')->with('product', $product)->with('material', $material);
    }
    public function save_material_details(MaterialDetailsRequest $request)
    {
        $this->AuthLogin();
        $id_name = $request->material_id;
        $name = DB::table('tbl_material')->where('material_id', $id_name)->first();
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['material_id'] = $request->material_id;
        $data['material_name'] = $name->material_name;
        $data['material_details_qty'] = $request->material_qty;
        $data['material_details_unit'] = $request->material_unit;
        DB::table('tbl_material_details')->insert($data);
        Session::put('message', 'Thêm chi tiết sản phẩm thành công');
        return Redirect::to('add-material-details');
    }
    public function delete_details($material_details_id)
    {
        $this->AuthLogin();
        DB::table('tbl_material_details')->where('material_details_id', $material_details_id)->delete();
        Session::put('message', 'Xóa chi tiết vật liệu thành công');
        return Redirect::to('all-product');
    }
    public function material_details($pro_encryted)
    {
        $this->AuthLogin();
        $pro_decryted = Crypt::decryptString($pro_encryted);
        $material_details = MaterialDetails::where('product_id', $pro_decryted)->get();
        foreach ($material_details as $key => $mate) {
            $product_id = $mate->product_id;
            $material_id = $mate->material_id;
        }
        $product = Product::where('product_id', $product_id)->first();
        return view('admin.material_details')->with(compact('material_details', 'product'));
    }
    public function edit_material_details($material_id)
    {
        $this->AuthLogin();
        $edit_material = DB::table('tbl_material')->where('material_id', $material_id)->get();
        $manager_material = view('admin.edit_material')->with('edit_material', $edit_material);
        return view('admin_layout')->with('admin.edit_material', $manager_material);
    }
    public function show_material_details()
    {
        $this->AuthLogin();
        $material_details = MaterialDetails::orderby('material_details_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">  
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên món ăn</th>
                        <th>Hình ảnh</th>
						<th>Tên nguyên vật liệu</th> 
						<th>Số lượng</th>
						<th>Đơn vị đo</th>
					</tr>  
				</thread>
				<tbody>
				';

        foreach ($material_details as $key => $mate) {
            $name_pro = Product::where('product_id', $mate->product_id)->first();
            $unit = '';
            if ($mate->material_details_unit == 0) {
                $unit = 'Kg (Kilogram) -- 0';
            } elseif ($mate->material_details_unit == 1) {
                $unit = 'g (gram) -- 1';
            } elseif ($mate->material_details_unit == 2) {
                $unit = 'L (liter) -- 2';
            } elseif ($mate->material_details_unit == 3) {
                $unit = 'ml (milliliter) -- 3';
            } elseif ($mate->material_details_unit == 4) {
                $unit = 'Hộp -- 4';
            } elseif ($mate->material_details_unit == 5) {
                $unit = 'chai -- 5';
            } elseif ($mate->material_details_unit == 6) {
                $unit = 'trái -- 6';
            }
            $output .= '
					<tr>
						<td>' . $name_pro->product_name . '</td>
                        <td><img src="public/upload/product/' . $name_pro->product_image . '" height="50" width="50"></td>
						<td>' . $mate->material_name . '</td>
						<td contenteditable data-mate_details_id="' . $mate->material_details_id . '" class="mate_details_edit">' .
                number_format($mate->material_details_qty, 0, ',', '.') . '</td>
						<td>' . $unit . '</td>
					</tr>
					';
        }

        $output .= '		
				</tbody>
				</table></div>
				';

        echo $output;
    }
    public function update_material_details(MaterialDetailsRequest $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $mate_details = MaterialDetails::find($data['mate_details_id']);
        $mate_details_qty = rtrim($data['mate_details_qty'], '.');
        $mate_details->material_details_qty = $mate_details_qty;
        $mate_details->save();
    }
}
