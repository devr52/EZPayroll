<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Company extends Model
{
    protected $table = "companies";
    public $timestamps = false;
    protected $guarded = ['id'];


    public function employees(){
    	return $this->hasMany('App\Employee', 'company_id');
    }

    public function users(){
    	return $this->hasMany('App\User');
    }

    public function pay_infos(){
        return $this->hasMany('App\PayrollInfo');
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

    public function sendConfirmation($data){
		Mail::send('emails.email_confirmation',$data,function($message) use ($data) {
         $message->from('donotreply@ezp.dev', 'EZ-Payroll');
         $message->to($data['email'],$data['full_name'])->subject('[EZ-Payroll] Email Confirmation');
      	});
    }

    public function sendActivation($data){

	Mail::send('emails.email_activation',$data,function($message) use ($data)  {
         $message->from('donotreply@ezp.dev', 'EZ-Payroll');
         $message->to($data['email'],$data['full_name'])->subject('[EZ-Payroll] Confirmed Account to EZ-Payroll');
        });
    }

}
