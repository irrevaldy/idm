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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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

                <!-- Left side column. contains the sidebar -->
                      <aside class="main-sidebar">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">

                          <ul class="sidebar-menu">


                            <!-- <li class="header">Main Navigation</li> -->
                            <li><a href="index.php"><i class="fa fa-home"></i> <span>Home</span> </a></li>
                				<li><a href="search_trx.php"><i class="fa fa-search"></i> <span>Search Transaction</span> </a></li>

                            <li class="treeview">
                              <a href="#">
                                <i class="fa fa-bars"></i> <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>

                					<li><a href="generateReport.php"><i class="fa fa-cogs"></i> <span>Transaction Report</span> </a></li>

                				<li><a href="generateReconReport.php"><i class="fa fa-archive"></i> <span>Transaction Report (Financial)</span> </a></li>
                					<li><a href="summaryData.php"><i class="fa fa-align-left" aria-hidden="true"></i><span>Summary</span> </a></li>
                			      <li><a href="tcash.php"><i class="fa fa-volume-control-phone" aria-hidden="true"></i><span>Tcash</span> </a></li>
                              <li><a href="data-edc.php"><i class="fa fa-fax" aria-hidden="true"></i><span>EDC Data</span> </a></li>
                              <li class="treeview">
                              <a href="#">
                                <i class="fa fa-book"></i> <span>Administration</span>
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>
                              <ul class="treeview-menu">
                                <li><a href="data-merchant.php"><i class="fa fa-university" aria-hidden="true"></i><span>Corporate & Merchant</span></a></li>
                                <li><a href="data-user.php"><i class="fa fa-users"></i> <span>Users & Groups</span></a></li>

                              </ul>
                            </li>
                          <li><a href="audit-trail.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Audit Trail</span></a></li>

                          </ul>

                          <style>
                          .sidebar-menu li,
                          .sidebar-menu > li.header {
                          	font-size: 16px;
                          }

                          .sidebar-menu li i {
                          	font-size: 23px;
                          	margin-right: 8px;
                          	margin-left: -5px;
                          }
                          </style>

                        </section>
                        <!-- /.sidebar -->
                      </aside>










      <section>


        <div class="sidebar">
        <div class="logopanel">
          <div class="logoimage">
            <img src="{{ asset('assets/img/logo.png') }}">
          </div>
        </div>
        <div class="sidebar-inner">
          <div class="menu-title">
               Navigation
            </div>
            <ul class="nav nav-sidebar navigation" id="navigation">
              @foreach($main_menu as $key => $value)
                <li class="">
                  <a href="{{ URL::to($value->LINK) }}"><i class="fa {{ $value->LOGO }}" aria-hidden="true"></i><span data-translate="{{ $value->NAME }}">{{ $value->NAME }}</span><!--<span class="fa arrow"></span>--></a>
                  <ul class="children collapse">
                    @foreach($sub_menu as $key2 => $value2)
                      @if($value->ID == $value2->PARENTID)
                        <li><a href="{{ URL::to($value2->LINK) }}">{{ $value2->NAME }}</a></li>
                      @endif
                    @endforeach
                  </ul>
                </li>
              @endforeach
            </ul>
        </div>
      </div>
      <!-- END SIDEBAR -->

      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>

            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">


            <!-- BEGIN USER DROPDOWN -->
            <li class="dropdown" id="user-header">
              <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              <span class="username">[ {{ Session::get('username') }} ]</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ route('logout') }}"><i class="icon-logout"></i><span>Logout</span></a>
                </li>
              </ul>
            </li>
            <!-- END USER DROPDOWN -->
          </ul>
        </div>
        <!-- header-right -->
      </div>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <!-- <div class="header">
            <h2><i class="icon-layers"></i> <strong>Terminal</strong> Management System</h3>
          </div>
          <div class="row">
            <div class="col-lg-12" style="height:720px">

            </div>
          </div> -->

          <!-- page content -->
          @yield('content')
          <!-- /page content -->

          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2018 </span>
                <span>Wirecard | Prima Vista Solusi</span>.
                <span>All rights reserved. </span>
              </p>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->

    </section>


    <!-- BEGIN PRELOADER -->
    <div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
    <script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/gsap/main-gsap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-cookies/jquery.cookies.min.js') }}"></script> <!-- Jquery Cookies, for theme -->
    <script src="{{ asset('assets/plugins/jquery-block-ui/jquery.blockUI.min.js') }}"></script> <!-- simulate synchronous behavior when using AJAX -->
    <!-- <script src="{{ asset('assets/plugins/translate/jqueryTranslator.js') }}"></script> <! Translate Plugin with JSON data  -->
    <script src="{{ asset('assets/plugins/bootbox/bootbox.min.js') }}"></script> <!-- Modal with Validation -->
    <script src="{{ asset('assets/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script> <!-- Custom Scrollbar sidebar -->
    <script src="{{ asset('assets/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js') }}"></script> <!-- Show Dropdown on Mouseover -->
    <script src="{{ asset('assets/plugins/charts-sparkline/sparkline.min.js') }}"></script> <!-- Charts Sparkline -->
    <script src="{{ asset('assets/plugins/retina/retina.min.js') }}"></script> <!-- Retina Display -->
    <!-- <script src="{{ asset('assets/plugins/select2/select2.js') }}"></script> <! Select Inputs -->
     <script src="{{ asset('assets/plugins/select2-4.0.3/dist/js/select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/icheck/icheck.min.js') }}"></script> <!-- Checkbox & Radio Inputs -->
    <script src="{{ asset('assets/plugins/backstretch/backstretch.min.js') }}"></script> <!-- Background Image -->
    <script src="{{ asset('assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> <!-- Animated Progress Bar -->
    <script src="{{ asset('assets/plugins/charts-chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notify.js') }}"></script> <!-- Notify -->
    <script src="{{ asset('assets/plugins/numeric/jquery.numeric.min.js') }}"></script> <!-- Handling Numeric -->

    <script src="{{ asset('assets/js/builder.js') }}"></script> <!-- Theme Builder -->
    <script src="{{ asset('assets/js/sidebar_hover.js') }}"></script> <!-- Sidebar on Hover -->
    <script src="{{ asset('assets/js/widgets/notes.js') }}"></script> <!-- Notes Widget -->
    <script src="{{ asset('assets/js/quickview.js') }}"></script> <!-- Chat Script -->
    <script src="{{ asset('assets/js/pages/search.js') }}"></script> <!-- Search Script -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script> <!-- Main Plugin Initialization Script -->
    <script src="{{ asset('assets/js/application.js') }}"></script> <!-- Main Application Script -->

    <script type="text/javascript">
      $(".numeric").numeric();

      $(function () {
        var $displayarea = $(".page-content");
        var parentWidth = $('.main-content').height();
        var footer = $('.footer');

        if ($displayarea.height()+footer.height() > parentWidth) {
          footer.css({
              position: 'static'
          });
        } else {
            footer.css({
              position: 'fixed'
          });
        }
      });

    </script>

    @yield('javascript')
  </body>
</html>
