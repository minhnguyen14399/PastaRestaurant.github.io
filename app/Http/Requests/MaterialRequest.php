<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'material_name'=>'required',
            'material_qty'=>'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return[
            'material_name.required'=>'Thông tin bắt buộc điền',
            'material_qty.required'=>'Thông tin bắt buộc điền',
            'material_qty.numeric'=>'Phải là số',
            'material_qty.min'=>'Phải lơn hơn hoặc bằng 0',
        ];
    }
}
