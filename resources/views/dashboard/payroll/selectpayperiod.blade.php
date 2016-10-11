@extends('dashboard.layouts.master')

@section('c-header', "Choose Pay Period")


@section('breadcrumb')
		<li><a href="#">Payroll</a></li>
		<li>Generate Payroll</li>
		<li class="active">Choose Pay Period</li>
@endsection

@section('content')


    <div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">Instructions</h3>
    </div>

    <div class="box-body">
        <ul>
            <li>Before generating payroll. Make sure the attendance and necessary payments are already resolved. </li>
            <li>SALARAY INFO UNAVAILABLE - Employee Salary has not been set</li>
            <li>ATTENDANCE NOT READY - Employee attendance is not yet resolved on the specific pay period</li>
            <li>READY - Employee payroll is ready to be generated!</li>
            <li>PAYMENT DONE - Employee payroll is already generated for the specific pay period.</li>
        </ul>

            <div class="col-sm-4">
            <form name="export" method="post" action="{{ route('redirect') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        {{ Form::label('datepicker', 'Start Date') }}
                        <div class="input-group date">
                            <div class="input-group-addon" style="background-color:#d2d2d2">
                            <i class="fa fa-calendar"></i></div>
                                {{ Form::text('start_date',null,['class' => 'form-control pull-right', 'id' => 'datepicker'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('datepicker2', 'End Date') }}
                        <div class="input-group date">
                            <div class="input-group-addon" style="background-color:#d2d2d2">
                            <i class="fa fa-calendar"></i></div>
                                {{ Form::text('end_date',null,['class' => 'form-control pull-right', 'id' => 'datepicker2'])}}
                        </div>
                    </div>


            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
            </div>
    </div>
</div>

@endsection


