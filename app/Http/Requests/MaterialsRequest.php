<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialsRequest extends FormRequest
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
            'material' => 'required_without:id|mimes:jpg,jpeg,png,pdf',
            'mater' => 'required|array|min:1',
            'mater.*.name_id' => 'required',
            'mater.*.group_id' => 'required',
            'mater.*.major_id' => 'required',
            'mater.*.teacher_id' => 'required',
            'mater.*.abbr' => 'required',

           
        ];
    }
}


