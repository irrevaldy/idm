<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Wirecard</title>
        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/png">

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
          <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/2.0.1/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">
        <!-- Important Owl stylesheet -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel.2/assets/owl.carousel.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/jquery-notify/ui.notify.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
    </head>
    <body class="hold-transition login-page">
      <div class="login-box">
        <div class="login-logo">
            <section id="slider-1" class="slider-1">
            <div class="col-sm-12">
              <div id="owl-demo" class="owl-theme">
                <div> <img src="{{ asset('assets/img/logo.png') }}" class="img-responsive"></div>
                <!-- <div> <img src="image/bank mandiri.png" class="img-responsive"> </div>
                <div> <img src="image/bni.png" class="img-responsive"> </div>
                <div> <img src="image/bri-logo.png" class="img-responsive"> </div> -->
              </div>
            </div>
          </section>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
          <!-- <img src="css/idm2.png" class="img-responsive"> -->

          <h1 class="login-box-msg"><b>Log In</b> Form</h1>
          <div class="hr"></div>
          <form id="form" autocomplete="off" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            @if($errors->any())
                <div class="alert alert-danger" style="text-shadow:none;">
                    <span><i class="fa fa-warning"></i>&nbsp;&nbsp;{{ $errors->first() }}</span>
                </div>
              @endif
            <div class="form-group has-feedback">
              <input type="text" class="form-control label_better" name="username" id="username" data-new-placeholder="Username" placeholder="Username" required="required">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback pass" id="password-box">
              <input type="password" class="form-control label_better" name="password" id="password-inp" data-new-placeholder="Password" placeholder="Password" onChange="check()"  required="required">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-4 col-xs-offset-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat" id="submitLogin">Sign In</button>
                <button type="button" class="btn btn-primary btn-block btn-flat" style="display: none;" onClick="procLogin()" id="buttonLogin"><i class="fa fa-spinner fa-pulse" id="spinner" style="display: none;"></i> Sign In</button>
              </div><!-- /.col -->
            </div>
          </form>

        </div><!-- /.login-box-body -->
        <div class="hr hr2"></div>

        <div class="login-box-footer text-center">
          <strong>Copyright &copy; 2018 Wirecard | PT Prima Vista Solusi.</strong><br> All rights reserved.
          <br> Version 0.0.1 - Mar 2018
        </div>
      </div><!-- /.login-box -->


        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            });
          });
        </script>

        <!-- label-bettter -->
        <script src="{{ asset('assets/plugins/label_better/jquery.label_better.js') }}"></script>
        <script>
        $(document).ready( function() {
          $(".label_better").label_better({
            easing: "bounce"
          });
        });
        </script>

        <script type="text/javascript">
          function check(){
            var pass = document.getElementById('password-inp');
            if(pass.value != "") {
              $("#password-box").addClass("pass-push");
              //alert('push');
            } else {
              $("#password-box").removeClass("pass-push");
              //alert('pull');
            }
          }

        </script>
  </body>
  </html>
