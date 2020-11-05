<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisionsRequest extends FormRequest
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
            'visn.*.name' => 'required|string|max:100',
            'visn.*.text' => 'required|string|max:100',
            'visn.*.active' => 'required',
            'visn.*.abbr' => 'required',
        ];
    }
}
