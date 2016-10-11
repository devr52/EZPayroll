@extends('dashboard.layouts.master')


@section('c-header', 'Insert Mass Update' )
@section('description', 'Add or Update multiple employees')


@section('breadcrumb')
		<li><a href="#">Employee</a></li>
		<li class="active">Multi Insert Tool</li>
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
			<li>Choose the type of Update</li>
			<li>Download CSV file with all current employee data using the button below</li>
			<li>Update or add employee.</li>
			<li>Do not change the emp_id or name information of any employee</li>
			<li>Upload your update CSV file using the "upload" button</li>
			<li>You're done!</li>
		</ol>

			<div class="col-sm-4">
			<form name="export" method="post" action="{{ route('download') }}">

			<div class="form-group">
				<h3>Step 1</h3>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<select name="type" onChange="getType()" id="type" class="form-control">
						<option selected>Select Action</option>
						<option value="create">Employee Create</option>
						<option value="update">Employee Update </option>
						<option value="s-crate">Employee Salary Create</option>
						<option value="s-update">Employee Salary Update </option>
						<option value="e-update">Employee Enrollment Update</option>
					</select>
			</div>

			<div class="form-group">
				<h3>Step 2</h3>
				<button type="submit" class="btn btn-info">Download Update File</button>
				</form>
			</div>

			<div class="form-group">
				<h3>Step 3</h3>

				{{ Form::open(['route'=> ['upload', $company->id ], 'method' => 'post', 'files'=>true]) }}

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


