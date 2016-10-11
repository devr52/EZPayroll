@extends('dashboard.layouts.master')


@section('c-header', 'Set Salary' )
@section('description', 'Adds employee\' pay details')


@section('breadcrumb')
		<li><a href="#">Salary</a></li>
		<li><a href="#">View Employee</a></li>
		<li class="active">Set Salary for {{ $employee->first_name }} </li>
@endsection


@section('content')
		@include('errors.list')


		<div class="row">
			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header with-border"><h2 class="box-title" style="color:teal"><strong>Payroll Info</strong></h2></div>

						{{ Form::open(['route' => ['salary.store',$employee]])}}
							<div class="box-body">

								<div class="form-group">
									{{ Form::label('payment_type', 'Payment Type') }}

									<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-transgender"></i>
					                  </div>
						                  {{ Form::select('payment_type', [
										'Monthly' => 'Monthly',
										'Semi-Monthly' => 'Semi-Monthly',
										'Weekly' => 'Weekly'],null,[
										'class' => 'form-control',
										'placeholder' => 'Select Payment Type'
										])}}
					                </div>
								</div>

								<div class="form-group">
									{{ Form::label('marital_status', 'Marital Status') }}

									<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-transgender"></i>
					                  </div>
						                  {{ Form::select('marital_status', [
										'Single' => 'Single',
										'Married' => 'Married'],null,[
										'class' => 'form-control',
										'placeholder' => 'Select Marital Status'
										])}}
					                </div>
								</div>

								<div class="form-group">
									{{ Form::label('dependents', 'Number of Dependents')}}

									<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-user"></i>
					                  </div>
					                  {{ Form::text('dependents',null,['class' => 'form-control'])}}
					                </div>

								</div>

								<div class="form-group">
									<label class="checkbox-inline" for="leave_eligibility">

								 			{{ Form::checkbox('leave_eligibility',1,null,['id' => 'leave_eligibility']) }}
											<strong>ELIGIBLE FOR LEAVE </strong>

						 			</label>
								</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="box box-primary">
					<div class="box-header with-border"><h2 class="box-title" style="color:teal"><strong>Enrollments</strong></h2></div>
					<div class="box-body">

						<div class="form-group">
							{{ Form::label('sss_n', 'SSS Number')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-building"></i>
					                  </div>
							{{ Form::text('sss_n',null,['class' => 'form-control', 'placeholder' => 'AAA-GG-SSSS'])}}
					        </div>
						</div>

						<div class="form-group">
							{{ Form::label('phic_n', 'PHILHEALTH Number')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-building"></i>
					                  </div>
							{{ Form::text('phic_n',null,['class' => 'form-control','placeholder' => 'XXXX-XXXX-XXXX'])}}
					        </div>
						</div>

						<div class="form-group">
							{{ Form::label('hdmf_n', 'PAGIBIG Number')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-building"></i>
					                  </div>
							{{ Form::text('hdmf_n',null,['class' => 'form-control' ,'placeholder' => 'XXXX-XXXX-XX'])}}
					        </div>
						</div>

						<hr>

						<h3 class="box-title" style="font-size: 18px;color:#00b3b3;" ><strong>Bank Account Enrollment</strong></h3>

						<div class="form-group">
							{{ Form::label('bank_account_n', 'Account Number')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-building"></i>
					                  </div>
							{{ Form::text('bank_account_n',null,['class' => 'form-control'])}}
					        </div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-sm-6 adjust-top">
				<div class="box box-default">
					<div class="box-header with-border"><h2 class="box-title" style="color:teal"><strong>Salary Details</strong></h2></div>
					<div class="box-body">


						<div class="form-group">
							{{ Form::label('schedule', 'Schedule') }}


							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-plus-square"></i>
					                  </div>
							{{ Form::select('schedule', [
								'261' => '5 days / week',
								'313' => '6 days / week',
								'0'	  => 'Irregular'],null,[
								'class' => 'form-control',
								'placeholder' => 'Select Schedule'
							])}}
					        </div>

						</div>

						<div class="form-group">
							{{ Form::label('basic_pay', 'Basic Pay')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-phone-square"></i>
					                  </div>
							{{ Form::text('basic_pay',null,['class' => 'form-control'])}}
					        </div>

						</div>

						<div class="form-group">
							{{ Form::label('taxable_allowance', 'Taxable Allowance')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-phone-square"></i>
					                  </div>
							{{ Form::text('taxable_allowance',null,['class' => 'form-control'])}}
					        </div>

						</div>

						<div class="form-group">
							{{ Form::label('non_taxable_allowance', 'Non-Taxable Allowance')}}

							<div class="input-group">
					                  <div class="input-group-addon" style="background-color:#d2d2d2">
					                    <i class="fa fa-phone-square"></i>
					                  </div>
							{{ Form::text('non_taxable_allowance',null,['class' => 'form-control'])}}
					        </div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary active btn-lg btn-block"><strong>SAVE</strong></button>
			</div>

			{{ Form::close() }}
		</div>




@endsection
