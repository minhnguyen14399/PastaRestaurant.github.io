<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;

class DeliveryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function delivery(Request $request)
    {
        $this->AuthLogin();
        $city = City::orderby('matp', 'ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function all_delivery(){
        $this->AuthLogin();
        $delivery = Feeship::orderby('fee_id','ASC')->get();
        return view('admin.delivery.all_delivery')->with('delivery',$delivery);
    }
    public function delete_delivery($fee_id){
        $this->AuthLogin();
        $delivery = Feeship::find($fee_id);
        $delivery->delete();
        Session::put('message','Xóa phí vận chuyển thành công');
        return Redirect::to('all-delivery');
    }
    public function select_delivery(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận/huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã/phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }
    public function select_feeship()
    {
        $this->AuthLogin();
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">  
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';

                foreach ($feeship as $key => $fee) {
                    $name_city = City::where('matp',$fee->fee_matp)->first();
                    $name_province = Province::where('maqh',$fee->fee_maqh)->first();
                    $name_wards = Wards::where('xaid',$fee->fee_xaid)->first();
                    
                    $output .= '
                            <tr>
                                <td> ok </td>
                                <td> ok </td>
                                <td> ok </td>
                                <td contenteditable data-feeship_id="' . $fee->fee_id . '" class="fee_feeship_edit">' . number_format($fee->fee_feeship, 0, ',', '.') . '</td>
                            </tr>
                            ';
                }

        $output .= '		
				</tbody>
				</table></div>
				';
        echo $output;

    }
    public function update_delivery(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
