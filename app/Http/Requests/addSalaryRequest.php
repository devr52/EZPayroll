<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class addSalaryRequest extends Request
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
            'payment_type' => 'required',
            'marital_status'=> 'required',
            'dependents'=> 'numeric',
            'schedule' => 'required',
            'basic_pay' => 'numeric|required',
            'allowances' => 'numeric'
        ];
    }

    public function messages(){
        return [
            'basic_pay.numeric' => 'Invalid entry on basic pay field. Must only contain numbers.',
            'dependents.numeric' => 'Invalid entry on dependents pay field. Must only contain numbers.',
            'allowances.numeric' => 'Invalid entry on allowance field. Must only contain numbers.'
        ];
    }
}


