<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class addEmployeeRequest extends Request
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
     * @return arrayS
     */
    public function rules()
    {
        return [
            'emp_num' => 'required',
            'last_name'=> 'required|regex:/^[\pL\s\-]+$/u',
            'first_name'=> 'required|regex:/^[\pL\s\-]+$/u',
            'email'=> 'required|unique:employees',
            'system_permission' => 'required'
        ];
    }

    public function messages()
{
    return [
        'emp_num.required' => 'The employee number field is required',
    ];
}
}
