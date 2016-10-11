<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Excel;
use App\Company;
use App\Attendance;
use App\Http\Requests;


class AttendanceController extends Controller
{
    //
	var $company;
    var $employee;

    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users', 'employees');
        }
    }

    public function index(){
    	$company = $this->company;

    	return view('dashboard.attendance.attendance',compact('company'));
    }

    public function download(Request $request){

        $employees=DB::table('employees')->select('id as EID','Last_name as Last-Name','First_name as First-Name','emp_num as Employee-ID')
            ->where('system_permission' ,'!=','Account Owner')
            ->where('company_id' , $this->company->id)->get();


        $start_date = $request->start_date;
        $start_date = date('Y-m-d',strtotime($start_date));

        $end_date = $request->end_date;
        $end_date = date('Y-m-d',strtotime($end_date));

        foreach ($employees as $employee) {
            $column = [
                'Start-Date'        => $start_date,
                'End-Date'         => $end_date,
                'Hours-Worked'     => null,
                'Overtime-Hours'   => null,
                'Night-Diff-Hours' => null,
                'RD'               => null,
                'SH'               => null,
                'RH'               => null,
                'DH'               => null,
                'RH_RD'            => null,
                'SH_RD'            => null,
                'DH_RD'            => null
            ];

            $r_data = array_merge((array)$employee,$column);

            $data[]=$r_data;
        }


         Excel::create('employees', function($excel) use($data){
            $excel->setTitle('Update-Employees');
            $excel->setCreator('EZP')->setCompany('EZ Payroll');
            $excel->setDescription('Attendance Sheet');

            $excel->sheet('Sheet 1' , function($sheet) use($data) {
                $sheet->fromArray($data);
            });

         })->setFilename('_employees')->export('xls');
    }

    public function upload(Request $request, Company $company){
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();



                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if(!$value->eid || !$value->start_date || !$value->end_date || !$value->hours_worked) continue;

                        $insert[] = [
                            'company_id'        =>  $company->id,
                            'employee_id'       =>  $value->eid,
                            'start_date'        =>  $value->start_date,
                            'end_date'          =>  $value->end_date,
                            'hours_worked'      =>  $value->hours_worked,
                            'ot_hours'          =>  $value->overtime_hours,
                            'nd_hours'          =>  $value->night_diff_hours,
                            'RD'                =>  $value->rd,
                            'SH'                =>  $value->sh,
                            'RH'                =>  $value->rh,
                            'DH'                =>  $value->dh,
                            'RH_RD'             =>  $value->rh_rd,
                            'SH_RD'             =>  $value->sh_rd,
                            'DH_RD'             =>  $value->dh_rd
                        ];
                    }
                    if(!empty($insert)){
                        $att = Attendance::insert($insert);
                        if($att) $success = 1;
                    }
                }
        }

        return redirect('attendance/resolve-attendance')->with('success',$success);
    }
}
