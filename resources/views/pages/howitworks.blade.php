<?php
	include(app_path().'/includes/classes/load.php');
	$sh_hero_image="assets/images/test-hero6.jpg";
	$header_content=create_header("HOW IT WORKS");
	$header_class='sub-header-wrapper';

?>


@extends('layouts.master')

@section('title')
	EZ-Payroll - How it Works
@endsection

@section('content')
	<main class="epc-container">
		<div class="ep-ct1 elem elem--fadeInLeft one">
			<div class="hw-container">
				<div class="hw-head">
					<h1>
				</div>

				<div class="col-left">
					<ul class="hw-side-menu">
						<li><a href="#" class="tablinks">Employee Creation</a></li>
						<li><a href="#" class="tablinks">Salary Management</a></li>
						<li><a href="#" class="tablinks">Resolving Attendance</a></li>
						<li><a href="#" class="tablinks">Employee Specific Payments</a></li>
						<li><a href="#" class="tablinks">Generating Payroll</a></li>
						<li><a href="#" class="tablinks">Mass Insertion/Update</a></li>
					</ul>
				</div>

				<div class="col-right">





				</div>
			</div>
		</div>

	</main>

@endsection
