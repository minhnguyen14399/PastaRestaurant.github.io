<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'fee_ship'=>'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return[
            'fee_ship.required'=>'Thông tin bắt buộc điền',
            'fee_ship.numeric'=>'Phải là số',
            'fee_ship.min'=>'Phải lớn hơn hoặc bằng 0',
        ];
    }
}
