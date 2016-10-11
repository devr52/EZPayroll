<?php

	function create_header($string){

		$header_content=<<<HC
			<div class="ep-shc elem elem--fadeIn one">
				<h1 class="animate fadeIn one">$string</h1>
			</div>
HC;
		return $header_content;
	}

	function create_header_pricing($string){

		$header_content=<<<HC
			<div class="ep-shc elem elem--fadeIn one">
				<h1 class="animate fadeIn one">$string</h1>
			</div>

HC;
		return $header_content;
	}

	//<img class="eyeglass elem elem--fadeInRight two" src="../images/eyeglass.png" alt="eyeglass">


	function create_main_header(){
		$header_content=
		"<div class=\"ep-title\">
						<h1>EZ-PayRoll</h1>
						<p>PAYROLL JUST FEELS RIGHT.</p>
						<div class=\"ep-header-form\">
							<a href=\"register\">Get Started</a>
						</div>
					</div>

	<div class=\"ep-arrow-down click-me m-scene\"><img src=\"assets/images/arrow-down.png\" alt=\"arrow-down\" class=\"elem elem--fadeInDown one\"> </div>";

	return $header_content;
	}


	function get_nav(){

		echo <<<NAV
			<div class="ep-nav-cont">
				<nav>
					<ul class="ep-nav">
						<li><a href="index.php">Home</a></li>
						<li>.</li>
						<li><a href="pages/how-it-works/">How it Works</a></li>
						<li>.</li>
						<li><a href="pages/pricing/">Pricing</a></li>
						<li>.</li>
						<li><a href="pages/contact/">Contact Us</a></li>
					</ul>
				</nav>
			</div>
NAV;
	}

	function get_sidenav(){

		echo <<<SIDENAV
		<span class="ep-mobile-menu" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

		<div id="mySidenav" class="sidenav">
		 	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  	<a href="pages/index.php">Home</a>
		  	<a href="pages/how-it-works/">How it Works</a>
		  	<a href="pages/pricing/">Pricing</a>
			<a href="pages/contact/">Contact Us</a>
			<a href="#">Sign In</a>
		</div>
SIDENAV;
	}


	function unset_get_started(){
		unset($_SESSION['company_name']);
		unset($_SESSION['email']);
	}


	function display_first_time(){
		echo <<<FIRST
		<div id="f-user" class="modal">
		  <div class="modal-content animate">
		  	<div class="demo">
				<h1>FREE TRIAL</h1>
				<p>
				<a href="demo_redirect.php"> Start Demo </a>
			</div>

			<div class="paid">
				<h1>AVAIL PLAN</h1>
				<a href="../pricing" >See Our Packages</a>
			</div>
		   </diV>
		</div>
FIRST;
	}

	function check_trial_period($trial_expire){
		if(time()>$trial_expire){
			return "<script>document.getElementById('f-user').style.display='block'</script>";
		}

		return "";
	}


?>
