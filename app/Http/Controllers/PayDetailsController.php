<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use App\Employee;
use App\Enrollment;
use App\PayrollInfo;
use App\Http\Requests\addSalaryRequest;
use App\Repositories\TaskRepository as Task;

class PayDetailsController extends Controller {
    var $company;

    public function __construct() {
        $this->middleware('admin');
        $this->middleware('demo');

        if(Auth::check()){
            $this->company = Auth::user()->company;
            $this->company->load('users','employees');
        }
    }

    public function index() {
        $employees = $this->company->employees()->where('system_permission' ,'!=', 'Account Owner')->with('pay_info')->paginate(7);

        return view('dashboard.salary.index', compact('employees'));
    }


    public function set_sal(Employee $employee) {

        $company = $this->company;

        return view('dashboard.salary.set_sal', compact('company','employee'));
    }

    public function store_sal(addSalaryRequest $request, Employee $employee) {

        $task = new Task($request);

        $dsr    = $task->get_dsr();
        $hsr    = $task->get_hsr();

        $sss_d  = $task->get_sss();
        $hdmf_d = $task->get_hdmf();
        $phic_d = $task->get_phic();

        $p_info = new PayrollInfo;

        $p_info->company()->associate($this->company);
        $p_info->employee()->associate($employee);
        $p_info->payment_type           = $request->payment_type;
        $p_info->marital_status         = $request->marital_status;
        $p_info->schedule               = $request->schedule;
        $p_info->basic_pay              = $request->basic_pay;
        $p_info->taxable_allowance      = $request->taxable_allowance;
        $p_info->non_taxable_allowance  = $request->non_taxable_allowance;
        $p_info->sss_d                  = $sss_d;
        $p_info->hdmf_d                 = $hdmf_d;
        $p_info->phic_d                 = $phic_d;
        $p_info->daily_rate             = $dsr;
        $p_info->hourly_rate            = $hsr;
        $p_info->dependents             = $request->dependents;
        $p_info->leave_eligibility      = $request->leave_eligibility;

        $p_info->save();

        $enrollments = new Enrollment;

        $enrollments->company()->associate($this->company);
        $enrollments->employee()->associate($employee);
        $enrollments->sss_n           = $request->sss_n;
        $enrollments->hdmf_n          = $request->hdmf_n;
        $enrollments->phic_n          = $request->phic_n;
        $enrollments->bank_account_n  = $request->bank_account_n;

        $enrollments->save();

        $success=$employee->first_name.'\'s salary has been added.';

        return redirect()->route('salary.index')->with('success' , $success);

    }


    public function show($id) {
        //
    }

    public function edit(PayrollInfo $salary) {


        $employee = Employee::where('id', $salary->employee_id)->first();

        $enrollment = Enrollment::where('employee_id' ,$salary->employee_id)->first();

        return view('dashboard.salary.edit_sal' , compact('salary' , 'employee','enrollment'));
    }


    public function update(addSalaryRequest $request, PayrollInfo $salary) {
        $task = new Task($request);

        $dsr    = $task->get_dsr();
        $hsr    = $task->get_hsr();

        $sss_d  = $task->get_sss();
        $hdmf_d = $task->get_hdmf();
        $phic_d = $task->get_phic();

         $salary->update([
            'payment_type'           =>  $request->payment_type,
            'marital_status'         =>  $request->marital_status,
            'schedule'               =>  $request->schedule,
            'basic_pay'              =>  $request->basic_pay,
            'taxable_allowance'      =>  $request->taxable_allowance,
            'non_taxable_allowance'  =>  $request->non_taxable_allowance,
            'daily_rate'             =>  $dsr,
            'hourly_rate'            =>  $hsr,
            'sss_d'                  =>  $sss_d,
            'hdmf_d'                 =>  $hdmf_d,
            'phic_d'                 =>  $phic_d,
            'dependents'             =>  $request->dependents,
            'leave_eligibility'      =>  $request->leave_eligibility
        ]);


        Enrollment::where('employee_id', $salary->employee_id)->update([
            'sss_n'           => $request->sss_n,
            'hdmf_n'          => $request->hdmf_n,
            'phic_n'          => $request->phic_n,
            'bank_account_n'  => $request->bank_account_n,
        ]);

        return redirect($request->path().'/edit')->with('success', 'Success!!');

    }

    public function destroy($id) {
        //
    }
}



// $emp = App\Employee::with(['pay_info',
//     'attendance' => function($q) use($sd,$ed){
//         $q->where('start_date',$sd)->where('end_date', $ed);
//     },
//     'payment_specifics' => function($q) use($sd,$ed){
//         $q->where('start_date',$sd)->where('end_date', $ed);
//     }])->whereIn('id',['2','3'])->get();


// $emp = App\Employee::with(['attendance' , 'payment_specifics' => function($q) use($sd,$ed){
//     $q->where('start_date',$sd)->where('end_date', $ed);
// }, 'pay_info'])->whereIn('id',['2','3'])->get();

