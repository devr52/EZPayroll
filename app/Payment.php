<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

	protected $touches = ['company', 'employee','pay_info'];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }

    public function company(){
    	return $this->belongsTo('App\Company');
    }

    public function pay_info(){
    	return $this->belongsTo('App\PayrollInfo' , 'employee_id');
    }
}
