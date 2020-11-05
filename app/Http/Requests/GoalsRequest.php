<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalsRequest extends FormRequest
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
            'gol' => 'required_without:id|mimes:jpg,jpeg,png',
            'gol.*.name' => 'required|string|max:100',
            'gol.*.text' => 'required|string|max:100',
            'gol.*.active' => 'required',
            'gol.*.abbr' => 'required',
        ];
    }
}
