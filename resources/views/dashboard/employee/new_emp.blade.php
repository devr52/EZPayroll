@extends('dashboard.layouts.master')


@section('c-header', 'New Employee' )
@section('description', 'Adds new employee')


@section('breadcrumb')
		<li><a href="#">Employee</a></li>
		<li class="active">New Employee</li>
@endsection


@section('content')
		@include('errors.list')


		@if(session('success'))
			<div class="alert alert-success fade in" id="success-alert">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Success!</strong> Employee Added.
			 </div>
		@endif

		<div class="row">
			<div class="col-sm-6">
				<div class="box box-primary" style="height:518px;">
					<div class="box-header with-border"><h2 class="box-title" style="color:teal"><strong>Employee Info</strong></h2></div>

						{{ Form::open(['route' => ['addEmp',$company]])}}




							@include('dashboard.employee.form');





			<div class="col-sm-12">
				<button type="submit" class="btn btn-success btn-lg btn-block"><strong>ADD EMPLOYEE</strong></button>
			</div>

			{{ Form::close() }}
		</div>




@endsection
