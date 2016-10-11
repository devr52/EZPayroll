<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use PDF;
use Auth;
use App\Payment;
use App\Employee;
use App\Http\Requests;
use App\Repositories\Computations;
use Illuminate\Support\Facades\Mail;

class PayrollController extends Controller
{
    //
	var $company;
    var $employee;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('demo');

        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users', 'employees');
        }
    }

    public function index(){

    	return view('dashboard.payroll.generate_payroll', compact('employees','paginate'));
    }

    public function view_all($sd,$ed){
        $employees = $this->company->employees()->where('system_permission' ,'!=', 'Account Owner')->get();

        $paginate=0;

        return view('dashboard.payroll.generate_payroll', compact('employees', 'paginate','sd','ed'));
    }




    public function generate_payroll(Request $request, Computations $compute ,$sd,$ed){
        // if(!$request->emp) return back();

        $employees = $this->company->employees()->with(['pay_info',
            'attendance' => function($q) use($sd,$ed){
                $q->where('start_date',$sd)->where('end_date', $ed);
            },
            'payment_specifics' => function($q) use($sd,$ed){
                $q->where('start_date',$sd)->where('end_date', $ed);
            }])->whereIn('id',$request->emp)->get();







        foreach ($employees as $employee) {

            /*
            --------------------
                   LEGEND
            --------------------

            $PI -> PAYROLL DETAILS/INFO
            $PS -> EMPLOYEE PAYMENT SPECIFIC
            $ATT -> ATTENDANCE OF EACH EMPLOYEE

            */

           $PI  = $employee->pay_info->toArray();
           $ATT = $employee->attendance->toArray();

           if(count($employee->payment_specifics)){ //check if collection is not empty
                $PS = $employee->payment_specifics->toArray();
            }
           else {
                $PS[0]=[
                    'bonus'                 => 0,
                    'cash_advance'          => 0,
                    'loan_deduction'        => 0,
                    'payroll_adjustments'   => 0,
                    'one_time_allowance'    => 0,
                    'other_deductions'      => 0
                ];
           }

           // $COLA = 10 * ($ATT['hours_worked'] / 8);

           $OT_RATE = $PI['hourly_rate'] * 1.25;
           $ND_RATE = $PI['hourly_rate'] * 0.10;

           $OTP = $OT_RATE * $ATT[0]['ot_hours'];
           $NDP = $OT_RATE * $ATT[0]['nd_hours'];
           $HDP = 0;
           $RDP = 0;
           $ADJ = $PS[0]['payroll_adjustments'];


           if($ATT[0]['RD']) $RDP += ($PI['hourly_rate'] * 0.3) * ($ATT[0]['RD'] * 8);
           if($ATT[0]['SH']) $HDP += ($PI['hourly_rate'] * 0.3) * ($ATT[0]['SH'] * 8);
           if($ATT[0]['RH']) $HDP += ($PI['hourly_rate'] * 1) * ($ATT[0]['RH'] * 8);
           if($ATT[0]['DH']) $HDP += ($PI['hourly_rate'] * 2) * ($ATT[0]['DH'] * 8);
           if($ATT[0]['RH_RD']) $HDP += ($PI['hourly_rate'] * 1.3) * ($ATT[0]['RH_RD'] * 8);
           if($ATT[0]['SH_RD']) $HDP += ($PI['hourly_rate'] * 0.5) * ($ATT[0]['SH_RD'] * 8);
           if($ATT[0]['DH_RD']) $HDP += ($PI['hourly_rate'] * 2) * ($ATT[0]['DH_RD'] * 8);

           $basicpay = $PI['hourly_rate'] * $ATT[0]['hours_worked'];

           /*---------------------------------------------
                COMPUTES DEDUCTION BASED ON PAYMENT TYPE
            ----------------------------------------------
           */
           if($PI['payment_type'] == 'Semi-Monthly'){
              $PI['taxable_allowance'] = $PI['taxable_allowance']/2;
              $PI['non_taxable_allowance'] = $PI['non_taxable_allowance']/2;
              $PI['sss_d'] = $PI['sss_d']/2;
              $PI['hdmf_d'] = $PI['hdmf_d']/2;
              $PI['phic_d'] = $PI['phic_d']/2;
           }
           elseif($PI['payment_type'] == 'Weekly'){
              $PI['taxable_allowance'] = $PI['taxable_allowance']/4;
              $PI['non_taxable_allowance'] = $PI['non_taxable_allowance']/4;
              $PI['sss_d'] = $PI['sss_d']/4;
              $PI['hdmf_d'] = $PI['hdmf_d']/4;
              $PI['phic_d'] = $PI['phic_d']/4;
           }


           $gross_pay = $basicpay + $OTP + $NDP + $RDP + $HDP + $ADJ + $PI['taxable_allowance']; //GROSSPAY
           $taxable_income = $gross_pay - ($PI['sss_d'] +  $PI['hdmf_d'] + $PI['phic_d']);
           $withholding_tax = 0;

           // dd($taxable_income);

           if ($PI['daily_rate'] > 481) {

                $withholding_tax = $compute->get_tax_payables($PI, $taxable_income);

           }

            $net_pay = $gross_pay + $PS[0]['bonus'] + $PI['non_taxable_allowance'] +$PS[0]['one_time_allowance'] + $PS[0]['cash_advance'] - ($withholding_tax + $PI['sss_d'] +  $PI['hdmf_d'] + $PI['phic_d'] + $PS[0]['other_deductions'] + $PS[0]['loan_deduction']);


           // echo "<Br>Basic Pay: ".$basicpay."<Br>";
           // echo "Hours Worked: ".$ATT[0]['hours_worked']."<br>";
           // echo "Overtime Pay: ".$OTP."<Br>";
           // echo "Night Diff Pay: ".$NDP."<Br>";
           // echo "Rest Day Pay: ".$RDP."<Br>";
           // echo "Holiday Pay: ".$HDP."<Br>";
           // echo "Adjustments: ".$ADJ."<Br>";
           // echo "Taxable Allowance:" .$PI['taxable_allowance']."<br>";
           // echo "Non-Taxable Allowance:" .$PI['non_taxable_allowance']."<br>";
           // echo "One Time Allowance:" .$PS[0]['one_time_allowance']."<br><BR>";

           // echo "DEDUCTIONS:<bR>";
           // echo "SSS: ".$PI['sss_d']."<Br>";
           // echo "PAGIBIG: ".$PI['hdmf_d']."<Br>";
           // echo "PHILHEALTH: ".$PI['phic_d']."<Br><bR>";

           // echo "ADDS:<bR>";
           // echo "Cash Advance:".$PS[0]['cash_advance']."<br>";
           // echo "Bonus:".$PS[0]['bonus']."<br><br>";


           // echo "Gross Pay: ".$gross_pay."<Br>";
           // echo "Taxable Income: ".$taxable_income."<Br>";
           // echo "Tax Payables: ".$withholding_tax."<Br>";
           // echo "Net Pay: ".$net_pay."<Br>";

           $insert[]=[
                'company_id'            => $employee->company_id,
                'employee_id'           => $employee->id,
                'start_date'            => $sd,
                'end_date'              => $ed,
                'basic_pay'             => $basicpay,
                'overtime_pay'          => $OTP,
                'nightdiff_pay'         => $NDP,
                'restday_pay'           => $RDP,
                'holiday_pay'           => $HDP,
                'taxable_allowance'     => $PI['taxable_allowance'],
                'non_taxable_allowance' => $PI['non_taxable_allowance'],
                'one_time_allowance'    => $PS[0]['one_time_allowance'],
                'bonus'                 => $PS[0]['bonus'],
                'cash_advance'          => $PS[0]['cash_advance'],
                'payroll_adjustments'   => $PS[0]['payroll_adjustments'],
                'sss_deduction'         => $PI['sss_d'],
                'hdmf_deduction'        => $PI['hdmf_d'],
                'phic_deduction'        => $PI['phic_d'],
                'loan_deduction'        => $PS[0]['loan_deduction'],
                'other_deduction'       => $PS[0]['other_deductions'],
                'taxable_income'        => $taxable_income,
                'withholding_tax'       => $withholding_tax,
                'gross_pay'             => $gross_pay,
                'net_pay'               => $net_pay,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
           ];


    }

        if(!empty($insert)){
            Payment::insert($insert);
            'Insert Record successfully.';
        }

        return redirect()->route('gen-rep',['sd' => $sd , 'ed' => $ed]);

    }

    public function generation_report($sd , $ed){

        $payments = $this->company->payments()->where('start_date' , $sd)->where('end_date' , $ed)->with('employee')->get();
        return view('dashboard.payroll.done' ,compact('payments','sd','ed'));
    }


    public function chooseperiod(){

      return view('dashboard.payroll.selectpayperiod');
    }

    public function redirect(Request $request){
        $sd = $request->start_date;
        $ed = $request->end_date;
        $sd = date('Y-m-d',strtotime($sd));
        $ed = date('Y-m-d',strtotime($ed));

          $employees = $this->company->employees()->with(['pay_info','attendance' => function($q) use($sd,$ed){
            $q->where('start_date' , $sd)->where('end_date', $ed);
          },'payments' => function($q) use($sd,$ed){
            $q->where('start_date' , $sd)->where('end_date', $ed);
          }])->where('system_permission' ,'!=', 'Account Owner')->paginate(10);

        $paginate=1;

        return view('dashboard.payroll.generate_payroll', compact('employees', 'paginate','sd','ed'));
    }


    public function send_payslip($sd,$ed){
         $payments = $this->company->payments()->where('start_date' , $sd)->where('end_date' , $ed)->with('employee','company')->get();


         foreach ($payments as $payment) {
            $enrollment = $payment->employee->enrollment;
            $attendance = $payment->employee->attendance->where('start_date', $payment->start_date)->where('end_date', $payment->end_date)->first();


          if($payment->employee->pay_info->payment_type == 'Semi-Monthly')
            $ms = $payment->employee->pay_info->basic_pay * 2;
          else if($payment->employee->pay_info->payment_type == 'Weekly')
            $ms = $payment->employee->pay_info->basic_pay * 4;
          else $ms = $payment->employee->pay_info->basic_pay;


          $fileName = 'payslip.pdf';
          $path = '../app/Storage/';

          $pdf = PDF::loadView('dashboard.PDF.payslip',['payment' => $payment, 'enrollment' => $enrollment, 'attendance' => $attendance, 'ms' => $ms])->save($path.$fileName);;

          $mailAttachment = $path.$fileName;
          // dd($mailAttachment);

          $data = [
            'first_name'    => $payment->employee->first_name,
            'company_name'  => $payment->company->company_name,
            'email'         => $payment->employee->email
          ];

          if(!$data['email']) {
            unlink($path.$fileName);
            continue;
          }

          $subject = '[Payslip] '.$data['company_name'].': '.$sd.' - '.$ed;

          Mail::send('emails.employee_payslip', $data, function ($message) use($data,$mailAttachment,$sd,$ed,$subject) {
    //
              $message->from('donotreply@ezp.dev', $data['company_name']);
              $message->to($data['email'], $data['first_name'])->subject($subject);
              $message->attach($mailAttachment);
          });

          unlink($path.$fileName);
    }

      $success = 1;

      return view('dashboard.payroll.done' ,compact('payments','sd','ed','success'));
  }






}





