<?php
	include(app_path().'/includes/classes/load.php');
	$sh_hero_image="assets/images/register-hero.jpg";
	$header_content=create_header("SIGN UP");
	$header_class='sub-header-wrapper';
	$confirm_code=mt_rand();
?>

@extends('layouts.master')

@section('title', 'EZ-Payroll - Register')


@section('content')

<main class="epc-container" style="background-color:#4a98a5;">
	<div class="ep-ct1" style="height:auto; padding:0; background:url('assets/images/register-bg.png') no-repeat bottom right; background-color:#9bd3e0; background-size: cover; ">

		@if(session('success'))
			<div class="success" style="height:400px">
				<h1>Success! Please Activate Your Account</h1>
				<p>Thank you for signing up @EZ PayRoll. You will receive an email confirmation. Click on the link to confirm your email address.</p>
			</div>

		@elseif(session('verified'))

			<div class="verified">
				<h1>Account Verified</h1>
				<p>Please check your email for instructions on how to login using your demo account. 	</p>
			</div>

		@else


		<div class="ep-reg">

			<aside class="ep-reg-col2">
				<div>
					<video class="demo" width="100%" height="100%" poster="{{asset('assets/demo-video/video-thumb.jpg')}}" controls>
						  <source src="{{asset('assets/demo-video/demo.mp4')}}" type="video/mp4">
					</video>
				</div>
			</aside>

			<section class="ep-reg-col1">

				<div >
					<h1>YOU HAVE ONE JOB. <br> GO SIGN UP.</h1>

					<p class="desc">Enjoy free demo and get to know more about EZ-Payroll.</p>

					@include('errors.list')

					{{ Form::open(['route' => 'signup']) }}

					<p>{{ Form::text('company_name','',['placeholder'=>'Company Name', 'class'=>'i1']) }}</p>

					<div class="input-col1">
						<p>{{ Form::text('full_name','',['placeholder'=>'Full Name', 'class'=>'i2']) }}</p>
						<p>{{ Form::text('company_position','',['placeholder'=>'Your Company Position', 'class'=>'i4']) }}</p>
					</div>

					<div class="input-col1">
						<p>{{ Form::email('email','',['placeholder'=>'Your Email', 'class'=>'i4']) }}</p>
						<p>{{ Form::text('employee_count','',['placeholder'=>'Number of Employees', 'class'=>'i5']) }}</p>
					</div>

					{{ Form::select('info_source', array(
						'how' => 'How did you hear about us?',
						'Facebook' => 'Facebook',
						'MobileAds' => 'Mobile Ads',
						'Google' => 'Google',
						'Gossip' => 'Gossip',
						'Others' => 'Others'), 'how'
					, ['class'=>'i6']) }}

					{{ Form::hidden('confirm_code',$confirm_code) }}


					{{ Form::button('Lets <sub>Pay</sub>Roll!',[
						'class'=>'hvr-radial-out',
						'type' => 'submit'
						]) }}

					<p class="terms">By clicking this button, you agree to our <a href="#">Terms of Service.</a></p>

					{{ Form::close() }}

				</div>
				@endif
			</section>


		</div>

	</div>

</main>

@endsection

