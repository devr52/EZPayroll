<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $touches = ['company'];


    public function company(){
    	return $this->belongsTo('App\Company');
    }

    public function users(){
    	return $this->hasOne('App\User');
    }

    public function pay_info(){
    	return $this->hasOne('App\PayrollInfo');
    }

    public function enrollment(){
        return $this->hasOne('App\Enrollment');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function payment_specifics(){
        return $this->hasMany('App\PaymentSpecific');
    }

    public function attendance(){
        return $this->hasMany('App\Attendance');
    }

}
