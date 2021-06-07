<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_name'=>'required',
            'coupon_code'=>'required|alpha_num|min:8|max:8',
            'coupon_time'=>'required|numeric|min:1',
            'coupon_number'=>'required|numeric|min:1',
            
        ];
    }
    public function messages()
    {
        return[
            'coupon_name.required'=>'Thông tin bắt buộc điền',
            'coupon_code.alpha_num'=>'Không được có ký tự đặc biệt',
            'coupon_code.required'=>'Thông tin bắt buộc điền',
            'coupon_code.min'=>'Phải đủ 8 ký tự',
            'coupon_code.max'=>'Phải đủ 8 ký tự',
            'coupon_time.required'=>'Thông tin bắt buộc điền',
            'coupon_time.numeric'=>'Phải là số',
            'coupon_time.min'=>'Phải lớn hơn 0',
            'coupon_number.required'=>'Thông tin bắt buộc điền',
            'coupon_number.numeric'=>'Phải là số',
            'coupon_number.min'=>'Phải lớn hơn 0',
        ];
    }
}
