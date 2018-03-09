<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/plugins/back-to-top/css/style.css') }}">
    <!-- private css file -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/back-to-top/css/style.css') }}">
    <link href="{{ asset('assets/plugins/messg/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style type="text/css">
      .skin-blue .main-header .logo {
        background-color: #7abcff;
      }

      .skin-blue .main-header .navbar {
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7abcff+0,60abf8+2,1f81ba+100 */
        background: #7abcff; /* Old browsers */
        background: -moz-linear-gradient(left,  #7abcff 0%, #60abf8 2%, #1f81ba 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left,  #7abcff 0%,#60abf8 2%,#1f81ba 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right,  #7abcff 0%,#60abf8 2%,#1f81ba 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#1f81ba',GradientType=1 ); /* IE6-9 */
      }

      .skin-blue .main-header .navbar .sidebar-toggle:hover {
        background-color: #1f81ba;
      }

      .skin-blue .main-header .logo:hover {
        background-color: #7abcff;
      }


    </style>

    <title>Wirecard</title>
    </head>
      <body class="hold-transition skin-blue fixed sidebar-mini sidebar-collapse">
        <div class="wrapper">
          <!--bar-navbar-->
          <header class="main-header">
                  <!-- Logo -->
                  <a class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="{{ asset('assets/img/logo.png') }}" width="50px"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="{{ asset('assets/img/logo.png') }}" width="125px"></span>
                  </a>
                  <!-- Header Navbar: style can be found in header.less -->
                  <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" onclick="setSidebar()">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </a>
                    <script type="text/javascript">
                      function setSidebar(){
                        $.ajax({
                          url: "ajax/set-sidebar.php",
                          cache: false,
                          success: function(msg){

                          }
                        });
                      }
                    </script>
                    <div class="navbar-custom-menu">
                      <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- <img src="dist/img/photo.png" class="user-image" alt="User Image">-->
                            <span class="name">{{ session('name') }}</span>
                          </a>
                          <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                              <!-- <img src="dist/img/photo.png" class="img-circle" alt="User Image"> -->
                              <p>
                                <?php
                                  $branch_code = session('branch_code');
                                  if(!isset($branch_code) || $branch_code == '') {
                                    $code = "";
                                  } else {
                                    $code = "(".$branch_code.")";
                                  }

                                ?>
                                <span class="name">{{ session('name') }}</span>
                                <small>{{ session('groupName') }} - {{ session('FNAME') }} <?php echo $code;?></small>
                              </p>
                            </li>

                            <li class="user-footer">
                              <div class="pull-left">
                                <!-- <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#myModal">Profile</a> -->
                                <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#profileModal">Profile</button>
                              </div>
                              <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                            </li>
                          </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
                          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> -->
                      </ul>
                    </div>
                  </nav>
                </header>
              </div>
            </body>
            </html>
