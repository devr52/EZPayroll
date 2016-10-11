@extends('dashboard.layouts.master')

@section('c-header', ' Employee Payments' )
@section('description', 'Import Employee Specific Payments')


@section('breadcrumb')
		<li><a href="#">Payroll</a></li>
		<li class="active">Employee Payments</li>
@endsection

@section('content')

    @if(session('success'))
    <div class="alert alert-success fade in" id="success-alert" style="margin-bottom:10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success! Employee Data imported successfully!</strong>
     </div>
    @endif

<div class="box box-solid box-info">
	<div class="box-header">
		<h3 class="box-title">Instructions</h3>
	</div>

	<div class="box-body">
		<ol>
			<li>Choose the pay period.</li>
			<li>Download CSV file with all current employee data using the button below</li>
			<li>Add employee specific payments</li>
			<li>Do not change the EID of any employee</li>
			<li>Choose your updateD CSV file using the "browse" button.</li>
			<li>Hit submit!</li>
			<li>You're done!</li>
		</ol>

			<div class="col-sm-4">
			<form name="export" method="post" action="{{ route('ep-download') }}">
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
				<h3>Step 2</h3>
				<button type="submit" class="btn btn-info">Download Update File</button>
				</form>
			</div>

			<div class="form-group">
				<h3>Step 3</h3>

				{{ Form::open(['route'=> ['ep-upload', $company->id ], 'method' => 'post', 'files'=>true]) }}

				     <input type="hidden" name="_token" value="{{ csrf_token() }}">
				     <input type="hidden" value="" id="hidden_type" name="hidden_type">
{{-- 				     <input type="file" name="import_file"><br> --}}
		            <div class="input-group">
		                <label class="input-group-btn">
		                    <span class="btn btn-primary">
		                        Browse&hellip; <input name="import_file" type="file" style="display: none;" multiple>
		                    </span>
		                </label>
		                <input type="text" class="form-control" readonly>
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
