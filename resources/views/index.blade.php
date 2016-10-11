<?php
	include(app_path().'/includes/classes/load.php');
	$header_class="main-header-wrapper";
	$header_content=create_main_header();
?>

@extends('layouts.master')

@section('title' , 'EZ-Payroll - Home')

@section('content')

<main class="epc-container" >
	<div class="ep-content1">
			<div class="ep-ct1" id="ep-content">
				<div class="ep-row elem elem--fadeInRight one">
					<div class="text epr-text">
						<h1>Lorem Ipsum</h1>
						<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for.</p>

						<a href="#" class="ep-more hvr-sweep-to-bottom">Learn More</a>
					</div>

					<div class="img-div img">
						<img src="{{asset('assets/images/c1-img1.jpg')}}" alt="image1">
					</div>

				</div>
				<div class="ep-row1 elem elem--fadeInLeft two">
					<div class="img-div">
						<img src="{{asset('assets/images/c1-img2.jpg')}}" alt="image2">
					</div>

					<div class="epr-text">
						<h1>IPSUM LOREM</h1>

						<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>

						<a href="#" class="ep-more hvr-sweep-to-bottom">Learn More</a>
					</div>
				</div>
			</div>

	</div>

	<div class="ep-content2">
		<div class="ep-ct2">

			<div class="ep-ct2-col1">
				<h1>IPSUM LOREM</h1>

				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>

				<a href="#" class="ep-more hvr-sweep-to-bottom">Learn More</a>
			</div>

			<div class="ep-ct2-col2">

			</div>

		</div>
	</div>


	<div class="ep-content3">
		<div class="ep-ct3">

			<div class="ep-ct3-col1">

			</div>

			<div class="ep-ct3-col2">
				<h1>IPSUM LOREM</h1>

				<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>

				<a href="#" class="ep-more hvr-sweep-to-bottom">Learn More</a>
			</div>

		</div>
	</div>
</main>

  <script>
        $('.click-me').on('click', function(){
        $('html, body').animate({
            scrollTop: $('#ep-content').offset().top
        }, 1000)
    })
  </script>

@endsection
