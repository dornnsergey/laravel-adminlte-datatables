<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'photo'         => 'nullable|mimes:jpg,png|max:5120|dimensions:min_width=300,min_height=300',
            'name'          => 'required|min:2|max:256',
            'position_id'   => 'required|exists:positions,id',
            'head'          => 'nullable',
            'employment_at' => 'required|date_format:d.m.y|before_or_equal:today',
            'phone'         => ['required', 'regex:#^\+380 \((50|63|66|67|68|73|9[1-9])\) [\d]{3} [\d]{2} [\d]{2}$#'],
            'email'         => 'required|email:rfc,dns|unique:employees,email',
            'salary'        => 'required|numeric|min:0|max:500000',
        ];
    }
}
