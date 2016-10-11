<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ $payment->start_date .'-'.$payment->end_date.'@'.$payment->employee->emp_num }}</title>
  <meta charset="utf-8">
  <style>
	   *{
      font-family: courier;
      font-size:11px;
      font-weight: 500;
     }


     .table{
     	width: 100%;
     	border-top:1.7px dashed black;
      border-bottom:1.7px dashed black;
      border-left:1px dashed black;
      border-right:1px dashed black;
     	border-collapse: collapse;
     }

      tr>td:first-child{
        padding-left: 10px;
      }

      tr>td:last-child{
        padding-right: 10px;
      }

      table tr:first-child td{
        padding-top:7px;
      }

      table tr:last-child > td{
        padding-bottom:7px;
      }

      .header td:last-child{
         text-align: right;
      }

     .body td{
        padding-top: 10px;
     }

      .bodyside td:nth-child(3){
          border-right:1px dashed black;
           text-align:right;
           padding-right:7px;"
      }


      .bodyside td:nth-child(4){
        padding-left: 7px;
      }

      .bodyside td:nth-child(2){
        text-align: center;
      }

      .bodyside td:nth-child(5){
        text-align:right;
        padding-right:7px;
      }

      .body-top td{
        padding-top: 12px;
      }

      .body-bottom td{
        padding-top: 68px;
        padding-bottom: 7px;
      }

      .adjustments td{
        padding-top:7px;
      }

      .ER td{
        border-top: 1.7px dashed black;
        padding-top:7px;
        padding-bottom: 7px;
      }

      .ER-end td{
        padding-bottom: 10px;
      }


      .bank td:nth-child(1),.bank td:nth-child(2),.bank td:nth-child(3){
        border-top: 1.7px dashed black;
        padding-top: 10px;
        padding-bottom: 5px;
      }

      .bank-end td{
        padding-bottom: 50px;
      }




  </style>
</head>
<body>

<div class="container">
  <table class="table table-bordered">
    <tbody>
      <tr class="header">
        <td colspan="3">PAY ADVICE</td>
        <td colspan="2">Pay Period:{{ str_replace('-','/',$payment->start_date) .'-' .str_replace('-','/',$payment->end_date) }}</td>
      </tr>
      <tr class="header">
        <td colspan="3">EID: {{ $payment->employee->emp_num}}</td>
        <td colspan="2">Pay Date: {{ date('Y-m-d')}}</td>
      </tr>

      <tr class="header">
        <td colspan="3">Company: {{ $payment->company->company_name }} </td>
        <td colspan="2">Monthly Salary: {{ $ms }}</td>
      </tr>

      <tr class="header">
        <td colspan="3" style="padding-bottom:10px;">Employee: {{ $payment->employee->first_name.' '.$payment->employee->last_name}}</td>
        <td colspan="2" style="padding-bottom:10px;">Daily Rate: {{ round($payment->employee->pay_info->daily_rate,2) }}</td>
      </tr>

      <tr>
        <td colspan="5" style="padding:9px; border-top:1.7px dashed black; border-bottom:1.7px dashed black;text-align:center">COMMENT: THIS IS A SYSTEM-GENERATED PAYSLIP; NO SIGNATURE REQUIRED.</td>
      </tr>

      <tr class="body bodyside">
        <td>EARNINGS & ALLOWANCES</td>
        <td>UNITS</td>
        <td >PHP</td>
        <td style="padding-left:7px;">DEDUCTIONS</td>
        <td style="text-align:right;padding-right:7px;">PHP</td>
      </tr>

      <tr class="bodyside body-top">
        <td>Basic Pay</td>
        <td>{{ $attendance->hours_worked }}</td>
        <td>{{ $payment->basic_pay }}</td>
        <td>Loan Deductions</td>
        <td>{{ $payment->loan_deduction }}</td>
      </tr>

      <tr class="bodyside">
        <td>Overtime Pay</td>
        <td>{{ $attendance->ot_hours }}</td>
        <td>{{ $payment->overtime_pay }}</td>
        <td>Other Deductions</td>
        <td >{{ $payment->other_deduction }}</td>
      </tr>

      <tr class="bodyside">
        <td>Night Differential</td>
        <td>{{ $attendance->nd_hours }}</td>
        <td>{{ $payment->nightdiff_pay }}</td>
        <td></td>
        <td ></td>
      </tr>

      @if($payment->restday_pay != 0.00)
        <tr class="bodyside">
          <td>Rest Day Pay</td>
          <td>{{ $attendance->rd }}</td>
          <td>{{ $payment->restday_pay }}</td>
          <td></td>
          <td ></td>
        </tr>
      @endif

      @if($payment->holiday_pay != 0.00)
        <tr class="bodyside">
          <td>Holiday Pay</td>
          <td></td>
          <td>{{ $payment->holiday_pay }}</td>
          <td></td>
          <td ></td>
        </tr>
      @endif

      <tr class="bodyside">
        <td>Taxable Allowance</td>
        <td></td>
        <td>{{ $payment->taxable_allowance }}</td>
        <td></td>
        <td></td>
      </tr>

      <tr class="bodyside">
        <td>Non-Taxable Allowance</td>
        <td></td>
        <td>{{ $payment->non_taxable_allowance }}</td>
        <td></td>
        <td ></td>
      </tr>

      @if($payment->one_time_allowance != 0.00)
        <tr class="bodyside">
          <td>One-Time Allowance</td>
          <td></td>
          <td>{{ $payment->one_time_allowance }}</td>
          <td></td>
          <td ></td>
        </tr>
      @endif

      @if($payment->bonus != 0.00)
        <tr class="bodyside">
          <td>Bonus</td>
          <td></td>
          <td>{{ $payment->bonus }}</td>
          <td></td>
          <td></td>
        </tr>
      @endif

      @if($payment->cash_advance != 0.00)
        <tr class="bodyside">
          <td>Cash Advance</td>
          <td></td>
          <td>{{ $payment->cash_advance }}</td>
          <td></td>
          <td></td>
        </tr>
      @endif

      @if($payment->payroll_adjustments != 0.00)
        <tr class="bodyside adjustments">
          <td>Payroll Adjustments</td>
          <td></td>
          <td>{{ $payment->payroll_adjustments }}</td>
          <td></td>
          <td></td>
        </tr>
      @endif

      <tr class="bodyside body-bottom">
        <td>*Units in hours.</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr class="bodyside ER">
        <td>ER Contribution</td>
        <td>Details</td>
        <td>PHP</td>
        <td>PAY SUMMARY</td>
        <td>PHP</td>
      </tr>

      <tr class="bodyside">
        <td>SSS</td>
        <td>{{ $enrollment->sss_n }}</td>
        <td>{{ $payment->sss_deduction }}</td>
        <td>Total Earnings</td>
        <td>{{ $payment->gross_pay }}</td>
      </tr>

      <tr class="bodyside">
        <td>HDMF</td>
        <td>{{ $enrollment->hdmf_n }}</td>
        <td>{{ $payment->hdmf_deduction }}</td>
        <td>Taxable Gross</td>
        <td>{{ $payment->taxable_income }}</td>
      </tr>

      <tr class="bodyside">
        <td>PHIC</td>
        <td>{{ $enrollment->phic_n }}</td>
        <td>{{ $payment->phic_deduction }}</td>
        <td>TAX</td>
        <td>{{ $payment->withholding_tax }}</td>
      </tr>

      <tr class="bodyside">
        <td></td>
        <td></td>
        <td></td>
        <td>Less:Deduction</td>
        <td>{{ number_format($payment->other_deduction+$payment->loan_deduction,2)}}</td>
      </tr>

      <tr class="bodyside ER-end">
        <td></td>
        <td></td>
        <td></td>
        <td>Amount Paid</td>
        <td>{{ $payment->net_pay }}</td>
      </tr>

      <tr class="bodyside bank">
        <td>BANK ACCOUNTS</td>
        <td></td>
        <td>PHP</td>
        <td></td>
        <td></td>
      </tr>

      <tr class="bodyside">
        <td>{{ $enrollment->bank_account_n }}</td>
        <td></td>
        <td>{{ $payment->net_pay }}</td>
        <td>YTD Gross</td>
        <td></td>
      </tr>

      <tr class="bodyside bank-end">
        <td></td>
        <td></td>
        <td></td>
        <td>YTD Tax</td>
        <td></td>
      </tr>




    </tbody>
  </table>
</div>

</body>
</html>


