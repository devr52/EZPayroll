<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Excel;
use App\Company;
use App\PaymentSpecific;
use App\Http\Requests;


class PaymentSpecificController extends Controller
{
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

    	return view('dashboard.payroll.employee_payments', compact('company'));
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
                'Start-Date'          => $start_date,
                'End-Date'            => $end_date,
                'Bonus'     	      => null,
                'Cash-Advance'   	  => null,
                'Loan-Deduction' 	  => null,
                'Payroll-Adjustments' => null,
                'One-Time-Allowance'  => null,
                'Other-Deductions'    => null
            ];

            $r_data = array_merge((array)$employee,$column);

            $data[]=$r_data;
        }


         Excel::create('employees', function($excel) use($data){
            $excel->setTitle('Payment Specifics');
            $excel->setCreator('EZP')->setCompany('EZ Payroll');
            $excel->setDescription('Employee Payment Sheet');

            $excel->sheet('Sheet 1' , function($sheet) use($data) {
                $sheet->fromArray($data);
            });

         })->setFilename('employees')->export('xls');
    }

    public function upload(Request $request, Company $company){
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if(!$value->eid || !$value->start_date || !$value->end_date ) continue;

                        if(!$value->bonus && !$value->cash_advance && !$value->loan_deduction && !$value->payroll_adjustments && !$value->one_time_allowance && !$value->other_deductions) continue;

                        $insert[] = [
                            'company_id'          =>  $company->id,
                            'employee_id'         =>  $value->eid,
                            'start_date'          =>  $value->start_date,
                            'end_date'            =>  $value->end_date,
                            'bonus'      		  =>  $value->bonus,
                            'cash_advance'        =>  $value->cash_advance,
                            'loan_deduction'      =>  $value->loan_deduction,
                            'payroll_adjustments' =>  $value->payroll_adjustments,
                            'one_time_allowance'  =>  $value->one_time_allowance,
                            'other_deductions'    =>  $value->other_deductions
                        ];
                    }
                    if(!empty($insert)){
                        $payment = PaymentSpecific::insert($insert);
                        if($payment) $success = 1;
                    }
                }
        }

        return back()->with('success' , $success);
    }
}
