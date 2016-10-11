<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=['id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $touches = ['company', 'employee'];

    public function company(){
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function isEmployee(){
        if(Auth::user()->system_permission == 'Regular Employee'){
            return true;
        }


    }
}
