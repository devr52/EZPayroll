<div class="box-body">
	<div class="form-group">
		{{ Form::label('emp_num' ,'Employee Number')}}

		<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-users"></i>
          </div>
          {{ Form::text('emp_num',null,['class' => 'form-control']) }}
        </div>

	</div>

	<div class="form-group">
		{{ Form::label('last_name', 'Last Name')}}

		<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-user"></i>
          </div>
          {{ Form::text('last_name',null,['class' => 'form-control']) }}
        </div>

	</div>

	<div class="form-group">
		{{ Form::label('first_name', 'First Name')}}

		<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-user"></i>
          </div>
          {{ Form::text('first_name',null,['class' => 'form-control'])}}
        </div>

	</div>

	<div class="form-group">
		{{ Form::label('gender', 'Gender') }}

		<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-transgender"></i>
          </div>
              {{ Form::select('gender', [
			'Female' => 'Female',
			'Male' => 'Male'],null,[
			'class' => 'form-control',
			'placeholder' => 'Select Gender'
			])}}
        </div>


	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email Address')}}

			<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-envelope"></i>
          </div>
			{{ Form::email('email',null,['class' => 'form-control'])}}
        </div>
	</div>


	<div class="form-group">
		{{ Form::label('contact_num', 'Contact No.')}}

		<div class="input-group">
          <div class="input-group-addon" style="background-color:#d2d2d2">
            <i class="fa fa-mobile"></i>
          </div>
			{{ Form::text('contact_num',null,['class' => 'form-control'])}}
        </div>

	</div>
</div>
	</div>
	</div>

	<div class="col-sm-6">
	<div class="box box-primary">
		<div class="box-header with-border"><h2 class="box-title"style="color:teal"><strong>Employment Details</strong></h2></div>
		<div class="box-body">
			<div class="form-group">
				{{ Form::label('position', 'Position')}}

				<div class="input-group">
		                  <div class="input-group-addon" style="background-color:#d2d2d2">
		                    <i class="fa fa-building"></i>
		                  </div
	>							{{ Form::text('position',null,['class' => 'form-control'])}}
		        </div>

			</div>

			<div class="form-group">
				{{ Form::label('employee_type', 'Employee Type') }}

				<div class="input-group">
		                  <div class="input-group-addon" style="background-color:#d2d2d2">
		                    <i class="fa fa-building"></i>
		                  </div>
				{{ Form::select('employee_type', [
						'Trainee' => 'Trainee',
						'Probationary' => 'Probationary',
						'Regular'	 => 'Regular'],null,[
						'class' => 'form-control',
						'placeholder' => 'Select Employee Type'
						])}}
		        </div>

			</div>

			<div class="form-group">
				{{ Form::label('datepicker', 'Employment Date') }}
				<div class="input-group date">
					<div class="input-group-addon" style="background-color:#d2d2d2">
					<i class="fa fa-calendar"></i></div>
						{{ Form::text('employment_date',null,['class' => 'form-control pull-right', 'id' => 'datepicker'])}}
	 			</div>
	 		</div>
		</div>
	</div>
	</div>

	<div class="col-sm-6">
	<div class="box box-default">
		<div class="box-header with-border"><h2 class="box-title" style="color:#00b3b3"><strong>Extra Info</strong></h2></div>
		<div class="box-body">


			<div class="form-group">
				{{ Form::label('system_permission', 'System Permission') }}


				<div class="input-group">
		                  <div class="input-group-addon" style="background-color:#d2d2d2">
		                    <i class="fa fa-plus-square"></i>
		                  </div>
				{{ Form::select('system_permission', [
					'Regular Employee' => 'Regular Employee',
					'Payroll Administrator' => 'Payroll Administrator'],null,[
					'class' => 'form-control',
					'placeholder' => 'Select System Permission'
				])}}
		        </div>

			</div>

			<div class="form-group">
				{{ Form::label('emergency_number', 'Contact In Case of Emergency')}}

				<div class="input-group">
		                  <div class="input-group-addon" style="background-color:#d2d2d2">
		                    <i class="fa fa-phone-square"></i>
		                  </div>
				{{ Form::text('emergency_number',null,['class' => 'form-control'])}}
		        </div>

			</div>
		</div>
	</div>
	</div>
