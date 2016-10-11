<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSpecific extends Model
{

	protected $table = 'payment_specifics';
	protected $touches = ['company', 'employee'];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }

    public function company(){
    	return $this->belongsTo('App\Company');
    }

}
