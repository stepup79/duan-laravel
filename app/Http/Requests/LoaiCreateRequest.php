<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Tạm thời chưa phân quyền return true
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
            'l_ten' =>  'required|min:3|max:50|unique:pal_loai'
        ];
    }
    public function messages()
    {
        return [
            'l_ten.required' => 'Vui lòng nhập tên loại',
            'l_ten.min' => 'Tên loại phải nhập trên 3 kí tự',
            'l_ten.max' => 'Tên loại phải nhập ít hơn 50 kí tự',
            'l_ten.unique' => 'Tên loại vừa nhập đã bị trùng vui lòng nhập tên khác'
        ];
    }
}
