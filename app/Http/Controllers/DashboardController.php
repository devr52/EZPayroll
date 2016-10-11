<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Schema\Blueprint;


class DashboardController extends Controller
{

    var $company;
    var $employee;

    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::check()){
            $this->employee = Auth::user()->employee;
            $this->employee->load('users');

            $this->company = Auth::user()->company;
            $this->company->load('users', 'employees');
        }
    }

    public function index(){
        $employee=$this->employee;
        $company=$this->company;

        return view('dashboard.index',compact('employee','company','links'));
    }




    public function get_demo(Company $company){

        $company->update([
            'sub_expire' => time()+2.592e+6,
            'subscription' => '30 DAY TRIAL'
        ]);

        return redirect()->action('DashboardController@index');
    }

    public function get_multi_insert(){
        $company= $this->company;

        return view('dashboard.employee.multi_insert',compact('company'));
    }

}
