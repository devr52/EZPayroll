<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Payment;
use App\Http\Requests;


class PDFController extends Controller
{


    public function stream(Payment $payment){
     	$payment = $payment->load('employee', 'company');
     	$enrollment = $payment->employee->enrollment;
     	$attendance = $payment->employee->attendance->where('start_date', $payment->start_date)->where('end_date', $payment->end_date)->first();


     	if($payment->employee->pay_info->payment_type == 'Semi-Monthly')
     		$ms = $payment->employee->pay_info->basic_pay * 2;
     	else if($payment->employee->pay_info->payment_type == 'Weekly')
     		$ms = $payment->employee->pay_info->basic_pay * 4;
     	else $ms = $payment->employee->pay_info->basic_pay;


   		$pdf = PDF::loadView('dashboard.PDF.payslip',['payment' => $payment, 'enrollment' => $enrollment, 'attendance' => $attendance, 'ms' => $ms]);
    	return $pdf->stream();
    }

}
