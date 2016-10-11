
@extends('dashboard.layouts.master')


@section('c-header', 'Edit Employee' )
@section('description', 'Edit employee')


@section('breadcrumb')
		<li><a href="#">Employee</a></li>
		<li><a href="{{ route('employee.index') }}">View Employee</a></li>
		<li class="active">Edit {{$employee->first_name}}</li>
@endsection


@section('content')
		@include('errors.list')


		@if(session('success'))
			<div class="alert alert-success fade in" id="success-alert">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Success!</strong> Employee Updated.
			 </div>
		@endif

		<div class="row">
			<div class="col-sm-6">
				<div class="box box-primary" style="height:518px;">
					<div class="box-header with-border"><h2 class="box-title" style="color:teal"><strong>Employee Info</strong></h2></div>
						{{ Form::model($employee, ['route' => ['employee.update', $employee->id],'method' => 'PATCH']) }}





							@include('dashboard.employee.form');





			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary btn-lg btn-block"><strong>UPDATE EMPLOYEE</strong></button>
			</div>

		</div>
		{{ Form::close() }}

@endsection





