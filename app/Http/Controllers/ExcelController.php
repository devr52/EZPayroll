<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Excel;
use App\Company;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;





class ExcelController extends Controller
{

    var $company;

    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users', 'employees');
        }
    }


    function getImport(){
    	return view('dashboard.multi_insert');
    }

    public function postExport(Request $request){

        $data=array();

        if($request->type=='update'){
            $employees=DB::table('employees')->select('id as EID','emp_num as Employee-ID','Last_name as Last-Name','First_name as First-Name', 'Gender' , 'email as Employee-Email', 'contact_num as Contact-Number','Position','Employee_Type as Employee-Type','Employment_Date as Employment-Date', 'emergency_number as Emergency-Contact-Number', 'system_permission as System-Permission')
                ->where('system_permission' ,'!=','Account Owner')
                ->where('company_id' , $this->company->id)->get();

            foreach ($employees as $employee) {
                $data[]=(array)$employee;
            }

        }
        else{
            $data[]=[
                'Employee-ID' => null,
                'Last-Name' => null,
                'First-Name' => null,
                'Gender' => null,
                'Employee-Email' => null,
                'Contact-Number' => null,
                'Position' => null,
                'Employee-Type' => null,
                'Employment-Date' => null,
                'Emergency-Contact-Number' => null,
                'System-Permission' => null,
            ];
        }


    	 Excel::create('employees', function($excel) use($data){
            $excel->setTitle('Update-Employees');
            $excel->setCreator('EZP')->setCompany('EZ Payroll');
            $excel->setDescription('Employee file');

    	 	$excel->sheet('Sheet 1' , function($sheet) use($data) {
    	 		$sheet->fromArray($data);
    	 	});

    	 })->setFilename('_employees')->export('xls');
    }



    public function postInsert(Request $request, Company $company){
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

                if($request->hidden_type=='create'){
                    if(!empty($data) && $data->count()){
                        foreach ($data as $key => $value) {
                            if(!$value->employee_id || !$value->last_name || !$value->first_name) continue;
                            $insert[] = [
                                'company_id'        =>  $company->id,
                                'emp_num'           =>  $value->employee_id,
                                'last_name'         =>  ucwords(strtolower($value->last_name)),
                                'first_name'        =>  ucwords(strtolower($value->first_name)),
                                'gender'            =>  ucwords(strtolower($value->gender)),
                                'email'             =>  $value->employee_email,
                                'contact_num'       =>  $value->contact_number,
                                'position'          =>  ucwords(strtolower($value->position)),
                                'employee_type'     =>  ucwords(strtolower($value->employee_type)),
                                'employment_date'   =>  $value->employment_date,
                                'emergency_number'  =>  $value->emergency_contact_number,
                                'system_permission' =>  ucwords($value->system_permission)
                            ];
                        }
                        if(!empty($insert)){
                            $insert = Employee::insert($insert);

                            if($insert) $success = 1;
                        }
                    }
                }

                else{
                    //UPDATE HERE

                    if(!empty($data) && $data->count()){
                        foreach ($data as $key => $value) {
                            if(!$value->eid) continue;

                            $update = [
                                'emp_num'           =>  $value->employee_id,
                                'last_name'         =>  ucwords(strtolower($value->last_name)),
                                'first_name'        =>  ucwords(strtolower($value->first_name)),
                                'gender'            =>  ucwords(strtolower($value->gender)),
                                'email'             =>  $value->employee_email,
                                'contact_num'       =>  $value->contact_number,
                                'position'          =>  ucwords(strtolower($value->position)),
                                'employee_type'     =>  ucwords(strtolower($value->employee_type)),
                                'employment_date'   =>  $value->employment_date,
                                'emergency_number'  =>  $value->emergency_contact_number,
                                'system_permission' =>  ucwords($value->system_permission)
                            ];

                            if(!empty($update)){
                                $update = Employee::where('id', $value->eid)->update($update);

                                if($update) $success = 1;
                            }
                        }


                    }

                    //UPDATE HERE
                }
        }


        return redirect('multi-insert')->with('success',$success);
    }

}
