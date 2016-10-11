<?php
	include(app_path().'/includes/classes/load.php');
	$header_content=create_header_pricing('PRICING');
	$sh_hero_image="assets/images/test-hero2.jpg";
	$header_class='sub-header-wrapper';
?>

@extends('layouts.master')

@section('title', 'EZ-Payroll - Pricing')


@section('content')

	<main class="epc-container" style="text-align:center; background:url('assets/images/pricing-bg.jpg') no-repeat; background-size:100%;">
	<img class="rayban" src="assets/images/rayban.png">
	<div class="ep-ct1" style=" top:0; margin-top: 20px; display:inline-block; height:auto; background-color:transparent; box-shadow:none;">
			<div class="columns elem elem--fadeInUp">
			  <ul class="price">
			    <li class="header elem elem--fadeInLeft" style="border:1px solid #212121">Basic</li>
			    <li class="grey" style="background-color: #455A64; border:1px solid #455A64;">&#x20B1; 1499.99 / month</li>
			    <li class="elem elem--fadeInLeft a">Payroll as per DOLE code rules</li>
			    <li class="elem elem--fadeInLeft b">SSS (as per DOLE)</li>
			    <li class="elem elem--fadeInLeft c">BIR (as per DOLE)</li>
			    <li class="elem elem--fadeInLeft d">Pag IBIG (as per DOLE)</li>
			    <li class="elem elem--fadeInLeft e">PhilHealth (as per DOLE)</li>
			    <li class="elem elem--fadeInLeft f">Enrollments</li>
			    <li class="elem elem--fadeInLeft g">Payroll file</li>

			    <li class="grey elem elem--fadeIn three"></li>
			  </ul>
			</div>

			<div class="columns elem elem--fadeInUp">
			  <ul class="price tuglife">
			    <li class="header elem elem--fadeInRight" style="background-color:#D32F2F; border:1px solid  #F44336; ">Pro</li>
			    <li class="grey" style="background-color: #F44336;border:1px solid  #F44336;">&#x20B1; 2499.99 / month</li>
			    <li style="font-weight:800; font-family:arial; color:#F44336; font-size:16px;" class="elem elem--fadeInRight a">Everything in the Basic plan +</li>
			    <li  class="elem elem--fadeInRight a">Night differential (applied per DOLE)</li>
			    <li  class="elem elem--fadeInRight b">Overtime pay (daily OT applied per DOLE)
	Minimum wage</li>
			    <li  class="elem elem--fadeInRight c">Holiday rates (DOLE)</li>
			    <li  class="elem elem--fadeInRight d">13th Month (as per DOLE)</li>
			    <li  class="elem elem--fadeInRight e">BIR deducted per payroll</li>
			    <li  class="elem elem--fadeInRight f">PhilHealth per payroll (deducted per DOLE)</li>
			    <li  class="elem elem--fadeInRight g">13th Month (as per DOLE)</li>
			    <li  class="elem elem--fadeInRight h">Advances, Deductions per pay, Benefits and Bonuses (defined by us and based on DOLE handbook)</li>
			    <li  class="elem elem--fadeInRight i">Paystub</li>
			    <li class="grey elem elem--fadeIn three"></li>
			  </ul>
			</div>
		</div>

		<div class="pricing-footer">


		</div>
	</main>

@endsection

