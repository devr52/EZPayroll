<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends Controller
{


	var $company;

     public function __construct()
    {
        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users','employees');
        }
    }



	public function edit_search(Request $request){

		if($request->search_param == 'Last Name'){
			$employees = $this->company->employees()->where('last_name',ucwords(strtolower($request->keyword)))
													->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
		}
		else if($request->search_param == 'Employee ID')
			$employees = $this->company->employees()->where('emp_num',ucwords(strtolower($request->keyword)))
													->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
		else
			$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->paginate(10);


		$request->flash();
		$search_param = $request->search_param;

		if(count($employees)>1) $records=count($employees).' Records Found.';
		else $records=count($employees).' Record Found';

		return view('dashboard.employee.view_emp', compact('employees','search_param', 'records'));
	}

	public function setSal_search(Request $request){

		if($request->search_param == 'Last Name'){
			$employees = $this->company->employees()->where('last_name',ucwords(strtolower($request->keyword)))
													->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
		}
		else if($request->search_param == 'Employee ID')
			$employees = $this->company->employees()->where('emp_num',ucwords(strtolower($request->search_param)))
													->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
		else
			$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->paginate(10);

		$request->flash();

		$search_param = $request->search_param;

		if(count($employees)>1) $records=count($employees).' Records Found.';
		else $records=count($employees).' Record Found';

		return view('dashboard.salary.index', compact('employees','search_param', 'records'));
	}

	public function payroll_search(Request $request, $sd,$ed){
		$paginate = 0;

		if($request->search_param == 'Last Name'){
			$employees = $this->company->employees()->where('last_name',ucwords(strtolower($request->keyword)))
													->where('system_permission' , '!=' , 'Account Owner')->get();
		}
		else if($request->search_param == 'Employee ID')
			$employees = $this->company->employees()->where('emp_num',ucwords(strtolower($request->search_param)))
													->where('system_permission' , '!=' , 'Account Owner')->get();
		else if($request->search_param == 'Position')
			$employees = $this->company->employees()->where('position',ucwords(strtolower($request->search_param)))
													->where('system_permission' , '!=' , 'Account Owner')->get();
		else if($request->search_param == 'All')
			$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->get();
		else {
			$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
			$paginate=1;
		}

		$request->flash();

		$search_param = $request->search_param;

		if(count($employees)>1) $records=count($employees).' Records Found.';
		else $records=count($employees).' Record Found';

		return view('dashboard.payroll.generate_payroll', compact('employees','search_param', 'records','paginate', 'sd' ,'ed'));
	}

	// public function payslip_search(Request $request, $sd, $ed){
	// 	$paginate = 0;

	// 	if($request->search_param == 'Last Name'){
	// 		$employees = $this->company->employees()->where('last_name',ucwords(strtolower($request->keyword)))
	// 												->where('system_permission' , '!=' , 'Account Owner')->get();
	// 	}
	// 	else if($request->search_param == 'Employee ID')
	// 		$employees = $this->company->employees()->where('emp_num',ucwords(strtolower($request->search_param)))
	// 												->where('system_permission' , '!=' , 'Account Owner')->get();
	// 	else if($request->search_param == 'Position')
	// 		$employees = $this->company->employees()->where('position',ucwords(strtolower($request->search_param)))
	// 												->where('system_permission' , '!=' , 'Account Owner')->get();
	// 	else if($request->search_param == 'All')
	// 		$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->get();
	// 	else {
	// 		$employees = $this->company->employees()->where('system_permission' , '!=' , 'Account Owner')->paginate(10);
	// 		$paginate=1;
	// 	}

	// 	$request->flash();

	// 	$search_param = $request->search_param;

	// 	if(count($employees)>1) $records=count($employees).' Records Found.';
	// 	else $records=count($employees).' Record Found';

	// 	return view('dashboard.payroll.generate_payroll', compact('employees','search_param', 'records','paginate'));
	// }
}
