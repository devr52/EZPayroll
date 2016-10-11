<?php
	include(app_path().'/includes/classes/load.php');

	$header_content=create_header("CONTACT US");
	$sh_hero_image="assets/images/test-hero4.jpg";
	$header_class='sub-header-wrapper';
?>

@extends('layouts.master')

@section('title')
	EZ-Payroll - Contact Us
@endsection

@section('content')

<main class="epc-container" style="background-color:#f5f5f5; height:auto">
	<div class="ep-ct1 elem elem--fadeInUp one" style="height:auto; background-color:#f5f5f5; ">
		<div class="ep-contact-us-wrapper">
			<article class="contact-us">
				<div class="ep-ct1-form-cont">
					<h1>Send us a letter<span> - we'd love to hear from you.</span></h1>
					<div class="ep-ct1-form">
						<form action="" method="post">
							<div class="epct1-form-row row1-input">
								<div class="epct1-form-col1">
									<p><input type="text" name="full_name" placeholder="Full Name" required></p>
									<p><input type="email" name="email" placeholder="E-mail" required></p>
									<p><input type="text" name="company_name" placeholder="Company Name"></p>
								</div>

								<div class="epct1-form-col2">
									<p><input type="text" name="industry_name" placeholder="Industry Name"></p>
									<p><input type="text" name="info_source" placeholder="Want a cookie?"></p>
								</div>
							</div>

							<div class="epct1-form-row">
								<p>Message</p>
								<p><textarea type="text" name="message"></textarea></p>
							</div>

							<p class="ep-send"><button class="hvr-sweep-to-bottom" type="submit" name="send">Send</button></p>
						</form>

						<div class="validation error">
							<span></span>
						</div>
					</div>
				</div>

				<div class="ep-map-cont" style="margin-bottom:25px;">
					<div class="map">
						<div id='map_canvas'>

						</div>
					</div>
				</div>
			</article>

			<aside class="contact-info">
				<div class="ep-contact-info">
					<h1>EZ PayRoll</h1>
					<h3>OUR OFFICE</h3>
					<p>R.A Gapuz Bldg. <br>
					1128 Alhambra St. <br>
					Cor. UN Avenue. <br>
					Ermita, Manila <br>
					Philippines</p>

					<div class="epci-email"><span class="mail-img"><img style="height: auto;
    width: auto;" src="{{asset('assets/images/mail.png')}}" alt="mail-icon"></span><a href="mailto:ezp.service@gmail.com">ezp.service@gmail.com</a></div>

					<div class="epci-social-icons">
						<ul>
							<li><a href="#"><img src="{{asset('assets/images/fblogo.png')}}" alt="fb-icon"></a></li>
							<li><a href="#"><img src="{{asset('assets/images/twitter-logo.png')}}" alt="twitter-icon"></a></li>
							<li><a href="#"><img src="{{asset('assets/images/ytlogo.png')}}" alt="yt-icon"></a></li>
						</ul>
					</div>
				</div>

				<div class="ep-support">
					<h1>PAYROLL SUPPORT</h1>
					<p>We are always happy to hear from you. For support related questions, please visit our games’ websites in order to get in contact with the support.</p>
				</div>
			</aside>
		</div>
	</div>



</main>


@endsection

