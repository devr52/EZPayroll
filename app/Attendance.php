<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

	protected $table = 'attendance';
    protected $touches = ['company','employee','payment'];


     public function employee(){
    	return $this->belongsTo('App\Employee');
    }

    public function company(){
    	return $this->belongsTo('App\Company');
    }

    public function payment(){
    	return $this->belongsTo('App\Payment');
    }
}
