<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollInfo extends Model
{
    //
   	protected $table = 'payroll_infos';

    protected $guarded=['id','company_id','employee_id'];

    protected $touches = ['company', 'employee'];


   	public function employee(){
    	return $this->belongsTo('App\Employee');
    }

    public function company(){
    	return $this->belongsTo('App\Company');
    }

    public function enrollment(){
    	return $this->hasOne('App\enrollment', 'employee_id');
    }

    public function payments(){
        return $this->hasMany('App\Payment','employee_id');
    }
}
