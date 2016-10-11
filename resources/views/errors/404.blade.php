<!DOCTYPE html>
<html>
    <head>
      <title>404 Page Not Found</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


      <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

      <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

    </head>
    <body  style="background-color: #ecf0f5;">
        <div class="content-wrapper" style="margin-left:0px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                404 Error Page
              </h1>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>

                <div class="error-content">
                  <h3><i class="fa fa-warning text-yellow"></i>Oops! Page not found.</h3>

                  <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href="{{ url('/dashboard' )}}">return to dashboard</a> or try using the search form.
                  </p>

                  <form class="search-form">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search">

                      <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.input-group -->
                  </form>
                </div>
                <!-- /.error-content -->
              </div>
              <!-- /.error-page -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
    </body>
</html>


