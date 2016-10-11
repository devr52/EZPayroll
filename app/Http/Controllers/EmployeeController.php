<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Employee;
use App\Company;

use Illuminate\Http\Request;
use App\Http\Requests\addEmployeeRequest;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    var $company;


    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('demo');

        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users','employees');
        }
    }

    public function index(){
        $employees = $this->company->employees()->where('system_permission' ,'!=', 'Account Owner')->paginate(7);

        return view('dashboard.employee.view_emp',compact('employees'));
    }

    public function show(){

    }

    public function create(){
        $company=$this->company;

        return view('dashboard.employee.new_emp', compact('company'));
    }


    public function edit(Employee $employee){

        return view('dashboard.employee.edit_emp',compact('employee'));
    }


    public function addEmployee(addEmployeeRequest $request, Company $company){

        $date = $request->employment_date;
        $date = date('Y-m-d',strtotime($date));

        $company->employees()->create([
            'emp_num'           =>  $request->emp_num,
            'last_name'         =>  ucwords(strtolower($request->last_name)),
            'first_name'        =>  ucwords(strtolower($request->first_name)),
            'gender'            =>  $request->gender,
            'email'             =>  $request->email,
            'contact_num'       =>  $request->contact_num,
            'position'          =>  ucwords(strtolower($request->position)),
            'employee_type'     =>  $request->employee_type,
            'emergency_number'  =>  $request->emergency_number,
            'employment_date'   =>  $date,
            'system_permission' =>  $request->system_permission
        ]);

        // $user= new User;
        // $user->company()->associate($company);
        // $user->employee()->associate($company->employees->where('id',$we->id)->first());
        // $user->username = 'test';
        // $user->password = Crypt::encrypt('password');
        // $user->system_permission = $request->system_permission;
        // $user->save();

        return redirect('/employee/create')->with('success','success');
    }

    public function update(Request $request, Employee $employee){
        $date = $request->employment_date;
        $date = date('Y-m-d',strtotime($date));

        $employee->update([
            'emp_num'           =>  $request->emp_num,
            'last_name'         =>  ucwords(strtolower($request->last_name)),
            'first_name'        =>  ucwords(strtolower($request->first_name)),
            'gender'            =>  $request->gender,
            'email'             =>  $request->email,
            'contact_num'       =>  $request->contact_num,
            'position'          =>  ucwords(strtolower($request->position)),
            'employee_type'     =>  $request->employee_type,
            'emergency_number'  =>  $request->emergency_number,
            'employment_date'   =>  $date,
            'system_permission' =>  $request->system_permission
        ]);

        return redirect($request->path().'/edit')->with('success', 'Success!!');
    }
}
