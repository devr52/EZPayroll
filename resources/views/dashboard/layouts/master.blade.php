<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EZ-Payroll - Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dashboard.css')}}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body style="background-color: #ecf0f5;" >


	<section class="content-header">
      <h1 style="font-weight:600">@yield('c-header')<small style="font-weight:500">@yield('description')</small></h1>

      <ol class="breadcrumb">
      	<li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        @yield('breadcrumb')
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     @yield('content')

    </section>



<script src="{{asset('assets/js/script.js')}}"></script>
<!-- jQuery 2.2.3 -->
<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>

<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

<script>
		  $( function() {
		    $( "#datepicker" ).datepicker();
        $('[data-toggle="tooltip"]').tooltip();

        $(document).on('change', ':file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

        $( "#datepicker2" ).datepicker();

        $(document).on('change', ':file', function() {
          var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
          input.trigger('fileselect', [numFiles, label]);
        });

  // We can watch for our custom `fileselect` event like this
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) input.val(log);
            else if( log ) alert(log);
        });

         $('.search-panel .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
          });

          $( '#select-all' ).change( function () {
            $( '#emp-table input[type="checkbox"]' ).prop('checked', this.checked)
          })

		  });


      function getType(){
        var myselect = document.getElementById("type").value;
        document.getElementById("hidden_type").value=myselect;
      }

      function weekly(){
        var myselect = document.getElementById("payment_type").value;

        if(myselect == 'Weekly'){
          document.getElementById("hidden_type").value=myselect;
        }
      }

</script>

</body>
</html>
