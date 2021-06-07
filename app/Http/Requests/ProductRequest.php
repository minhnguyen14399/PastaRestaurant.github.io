<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=>'required',
            'product_price'=>'required|numeric|min:0',
            'product_quantity'=>'required|numeric|min:0',
            
            'product_desc'=>'required',
            'product_content'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'product_name.required'=>'Thông tin bắt buộc điền',
            'product_price.required'=>'Thông tin bắt buộc điền',
            'product_price.numberic'=>'Chỉ được điền số',
            'product_price.min'=>'Phải lớn hơn 0',
            'product_quantity.required'=>'Thông tin bắt buộc điền',
            'product_quantity.numberic'=>'Chỉ được điền số',
            'product_quantity.min'=>'Phải lớn hơn 0',
            'product_desc.required'=>'Thông tin bắt buộc điền',
            'product_content.required'=>'Thông tin bắt buộc điền',
            
        ];
    }
}
