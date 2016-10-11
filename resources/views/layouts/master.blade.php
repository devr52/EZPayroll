<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title> {{-- yield title --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="icon" type="image/gif" href="{{asset('assets/images/web-icon.png') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/media.css')}}">
	{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}"> --}}

</head>
<body>
	<div id="main" class="main-wrapper m-scene" >
			<div style="background-color:#212121;">
			<div class="{{ $header_class }} animate fadeInner" id="sh_header">

				 @if($header_class=='sub-header-wrapper')
				 	<?php echo "<script>document.getElementById(\"sh_header\").style.backgroundImage=\"url($sh_hero_image)\";</script>"; ?>
				 @endif


				<header class="ep-header">


						<div id="id01" class="modal">
							  <form class="modal-content animate1" action="" method="post">
							    <div class="imgcontainer">
							      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
							      <img src="img_avatar2.png" alt="Avatar" class="avatar">
							    </div>

							    <div class="container">
							      <label><b>Username</b></label>
							      <input type="text" placeholder="Enter Username" name="uname" required>

							      <label><b>Password</b></label>
							      <input type="password" placeholder="Enter Password" name="psw" required>

							      <button type="submit" name="login">Login</button>
							      <input type="checkbox" checked="checked"> Remember me
							    </div>

							    <div class="container" style="background-color:#f1f1f1">
							      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
							      <span class="psw">Forgot <a href="#">password?</a></span>
							    </div>
							  </form>

							</div>

							<script>
							// Get the modal
							var modal = document.getElementById('id01');

							// When the user clicks anywhere outside of the modal, close it
							window.onclick = function(event) {
							    if (event.target == modal) {
							        modal.style.display = "none";
							    }
							}
							</script>


						<div class="ep-logo">
							<a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-small.png') }}" alt="logo"><span class="company-name">EZ-PayRoll</span></a>
						</div>


						@include('layouts.nav') {{-- DISPLAYS NAV BAR --}}
						@include('layouts.sidenav') {{-- DISPLAY MOBILE NAV --}}

					    {!! $header_content !!}

				</header>
			</div>
			</div>




			@yield('content')


		<div class="footer-wrapper">
			<footer class="ep-footer">
<!-- 			<img src="http://localhost/EZPayroll/images/logo-small.png" alt="footer-logo"> -->
<!-- 				<div>
					<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Testimonials</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
				</div> -->
				<div class="f-social">
					<ul>
						<li><a href="#"><img src="{{asset('assets/images/f-fb.png')}}" alt="fblink"></a></li>
						<li><a href="#"><img src="{{asset('assets/images/f-tw.png')}}" alt="twitterlink"></a></li>
						<li><a href="#"><img src="{{asset('assets/images/f-yt.png')}}" alt="youtubelink"></a></li>
					</ul>

					<span class="made">Made by</span>
					<p style="margin:10px 0;"><span class="dev">Emond - Web Developer :)</p>
					<p class="copy">Copyright &#169; 2016 EZ Payroll</span>
				</div>

			</footer>
		</div>
	</div>
		<!-- SCRIPTS -->
	<script src="{{asset('assets/js/jquery-3.1.0.min.js')}}"></script>
	<script src="{{asset('assets/js/prefixfree.min.js')}}"></script>
<!-- 	<script src="http://localhost/EZPayroll/js/jquery.smoothState.min.js"></script> -->
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDL3rkfSXHVsktwDkzykRZPRhQIdSuWcks"></script>
	<script src="{{asset('assets/js/script.js')}}"></script>


	<script>
        $('.click-me').on('click', function(){
        $('html, body').animate({
            scrollTop: $('#ep-content').offset().top
        }, 1000)
    })
   </script>


</body>
</html>


