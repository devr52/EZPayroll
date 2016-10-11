<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class signUpRequest extends Request
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
            'full_name'=> 'required|regex:/^[\pL\s\-]+$/u',
            'email'=> 'required|unique:companies',
            'company_name'=> 'required',
            'info_source'=> 'required',
        ];


        //|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
    }


}
