<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgoaldsRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'gold.*.name' => 'required|string|max:100',
            'gold.*.text' => 'required|string|max:100',
            'gold.*.active' => 'required',
            'gold.*.abbr' => 'required',
        ];
    }
}
