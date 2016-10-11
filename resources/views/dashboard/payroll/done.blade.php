@extends('dashboard.layouts.master')

@section('c-header', "Payroll [ $sd - $ed ]")


@section('breadcrumb')
		<li><a href="#">Payroll</a></li>
		<li>Generate Payroll</li>
		<li class="active">Generation Report</li>
@endsection

@section('content')
    <div class="row" style="margin-bottom: 10px;">
    <div class="col-xs-8 col-xs-offset-2 pull-right">
        {{ Form::open(['route' => ['payslip_search', $sd, $ed]])}}
        <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">@if(isset($search_param)) {{ $search_param }} @else {{ 'Search By' }}  @endif </span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#Employee ID">Employee ID</a></li>
                      <li><a href="#Last Name">Last Name</a></li>
                      <li class="divider"></li>
                      <li><a href="#All">All</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="{{ $search_param or 'Search By' }}" id="search_param">
                <input type="text" class="form-control" value="{{ old('keyword') }}" name="keyword" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
        </div>
        {{ Form::close() }}
    </div>
</div>

@if(isset($success))
    <div class="alert alert-success fade in" id="success-alert" style="margin-bottom:10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! Employee Payslips emailed successfully!</strong>
     </div>
@endif

<div class="panel panel-primary" style="margin-top:20px">
    <div class="panel-heading">
        Employee List&nbsp&nbsp-&nbsp&nbspView
    </div>

    @if(!count($payments))
        <div class="alert alert-warning alert-dismissible" style="margin-bottom:0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-warning"></i>No Record Found.</h4>
        </div>
    @endif

    @if(isset($records) && count($payments))
        <div class="alert alert-success alert-dismissible" style="margin-bottom:0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>{!! $records !!}</h4>
        </div>
    @endif



    <div style="overflow-x:auto;">

    <table class="table table-striped table-hover">

        @foreach($payments as $payment )

            <tr>
                <td class="col-xs-1">
                    @if($payment->employee->gender == 'Female')
                        <a href="#"><img class="avatar" src="{{asset('dist/img/user7-128x128.jpg')}}"></a>
                    @else
                        <a href="#"><img class="avatar" src="{{asset('dist/img/user8-128x128.jpg')}}"></a>
                    @endif
                </td>
                <td class="col-xs-4">
                    <h4>
                        <strong><a style="color:#474747" href="#">{{ $payment->employee->last_name. " " . $payment->employee->first_name }} </a></strong> <br>
                            <small style="color:teal">{{ $payment->employee->email }}</small> <br>
                            <small>{{ $payment->employee->contact_num }}</small>
                    </h4>
                </td>

                <td class="col-xs-4" style="vertical-align:middle">
                    {!! '<strong>Position:</strong> '.$payment->employee->position !!}               <br>
                    {!! '<strong>Employee Type:</strong>'.$payment->employee->employee_type  !!}
                </td>

                    <td class="text-center col-xs-3"  style="vertical-align:middle"><a href="{{ route('pdf-view', $payment->id) }}" data-toggle="tooltip" data-placement="bottom" title="{{$sd.'-'.$ed .'@' .$payment->employee->emp_num.'.pdf'}}" target="_blank"><img src="{{asset('assets/images/pdf.png')}}"></a></td>

            </tr>

        @endforeach

    </table>
    </div>

</div>

<div class="pull-right" style="margin-top: 20px;"><a href="" class="btn btn-primary">FINALIZE</a></div><div class="pull-right" style="margin-top: 20px;margin-right: 10px;"><a href="{{ route('send-payslip',[$sd,$ed])}}" class="btn btn-success">SEND TO EMPLOYEES</a></div>

@endsection


