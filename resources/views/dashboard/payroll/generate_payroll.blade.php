@extends('dashboard.layouts.master')

@section('c-header', ' Generate Payroll - Pay Period')
@section('description', "$sd to $ed" )


@section('breadcrumb')
		<li><a href="#">Payroll</a></li>
		<li class="active">Generate Payroll</li>
@endsection

@section('content')




<div class="row">
    <div class="col-xs-5" style="min-width:320px;">
    	{{ Form::open(['route' => ['payroll_search', $sd,$ed]])}}
	    <div class="input-group">
	            <div class="input-group-btn search-panel">
	                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	                	<span id="search_concept">@if(isset($search_param)) {{ $search_param }} @else {{ 'Search By' }}  @endif </span> <span class="caret"></span>
	                </button>
	                <ul class="dropdown-menu" role="menu">
	                  <li><a href="#Employee ID">Employee ID</a></li>
	                  <li><a href="#Last Name">Last Name</a></li>
	                  <li><a href="#Position">Position</a></li>
	                  <li class="divider"></li>
	                  <li><a href="#All">All</a></li>
	                </ul>
	            </div>
	            <input type="hidden" name="search_param" value="{{ $search_param or 'Search By' }}" id="search_param">
	            <input type="text" class="form-control test" value="{{ old('keyword') }}" name="keyword" placeholder="Search term...">
	            <span class="input-group-btn">
	                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	            </span>
        </div>
	    {{ Form::close() }}
    </div>

    <div class="col-xs-2 ">
    	{{ Form::open(['route' => ['generate-payroll',$sd,$ed]])}}
			<button type="submit" class="btn btn-primary">Generate Payroll</button>

    </div>


</div>

<div class="panel panel-primary" style="margin-top:20px">
	<div class="panel-heading" style="padding-left:10px;">
		<div class="checkbox" style="margin:0; display:inline">
		  <label><input type="checkbox" value="" id="select-all" >@if($paginate) {{ 'Select Page' }}  @else {{ 'Select All'}} @endif|</label>
		</div>

		<a href="{{ action('PayrollController@view_all',[$sd,$ed] ) }}" style="color:white">View All</a>
	</div>

	@if(!count($employees))
		<div class="alert alert-warning alert-dismissible" style="margin-bottom:0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h4><i class="icon fa fa-warning"></i>No Record Found.</h4>
        </div>
	@endif

	@if(isset($records) && count($employees))
		<div class="alert alert-success alert-dismissible" style="margin-bottom:0">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>{!! $records !!}</h4>
        </div>
	@endif

	<div style="overflow-x:auto;" id="emp-table">

	<table class="table table-striped table-hover">
		@foreach($employees as $employee )
			<tr>
				<td style="width:10px; vertical-align:middle;">
				    @if($employee->pay_info && count($employee->attendance) && !count($employee->payments))
					  <input type="checkbox" value="{{ $employee->id }}" name="emp[]">
					@endif
				</td>

				<td >
					@if($employee->gender == 'Female')
						<a href="#"><img class="avatar" src="{{asset('dist/img/user7-128x128.jpg')}}"></a>
					@else
						<a href="#"><img class="avatar" src="{{asset('dist/img/user8-128x128.jpg')}}"></a>
					@endif
				</td>
				<td class="col-sm-5">
					<h4>
						<strong><a style="color:#474747" href="#">{{ $employee->last_name. " " . $employee->first_name }} </a></strong> <br>
							<small style="color:teal">{{ $employee->email }}</small> <br>
							<small>{{ $employee->contact_num }}</small>
					</h4>
				</td>

				<td class="col-sm-5" style="vertical-align:middle">
					{!! '<strong>Position:</strong> '.$employee->position !!} 				<br>
				 	{!! '<strong>Employee Type:</strong>'.$employee->employee_type  !!}
				</td>

				<td class="text-center col-sm-2"  style="vertical-align:middle;text-align:center">
					@if(!$employee->pay_info)
						<a href="{{ route('set-sal' , $employee->id) }}" class="btn btn-warning" style="font-size:12px;">SALARY INFO UNAVAILABLE</a>
					@elseif(count($employee->payments))
						<div class="ready">PAYMENT DONE</div>
					@elseif(count($employee->attendance))
						<div class="ready">READY</div>
					@else
						<div class="notready">ATTENDANCE NOT READY</div>
					@endif
				</td>
			</tr>
		@endforeach
	</table>
		{{ Form:: close() }}
	</div>

</div>
@if($paginate)
	{{ $employees->links() }}
@endif


@endsection


