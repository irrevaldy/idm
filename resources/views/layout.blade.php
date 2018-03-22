<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/png">
    <title>Wirecard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ui.css') }}">
      <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.3/dist/css/select2.css') }}">
    <script src="{{ asset('assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    </head>
      <body class="fixed-topbar fixed-sidebar theme-sdtl color-default">
      <section>
        <div class="sidebar">
        <div class="logopanel">
          <div class="logoimage">
            <img src="{{ asset('assets/img/logo.png') }}">
          </div>
          <style type="text/css">


            .logopanel img {
              width: 100%;
            }

            .logoimage {
              border: 0px solid #f00;
              width: 200px;
              margin: auto;
            }

            .sidebar .sidebar-inner .nav-sidebar > li > a:hover {
              color: #7295E5;
            }

            .sidebar .logopanel {
              padding: 5px;
            }

            .theme-sdtl.color-default:not(.sidebar-top) .logopanel {
                background: #7abcff  none repeat scroll 0 0;
            }

            .page-content .header h2,
            .main-content .page-content .panel {
              border-left: 3px solid #666;
            }

            .form-control.form-white {
                background-color: #ffffff;
                border: 1px solid #ccc;
                color: #555555;
            }

            .form-control.form-white:hover {
                background-color: #ffffff;
                border: 1px solid #666;
                color: #555555;
                outline: medium none;
            }

            .prepend-icon input {
                border: 1px solid #ccc;
                padding-left: 36px;
            }

            .select2-container {
                display: inherit;
            }

            .modal-open .modal {
              z-index: 1000;
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 2px;
            }
            .select2-container .select2-selection--single {
                -moz-user-select: none;
                box-sizing: border-box;
                cursor: pointer;
                display: block;
                height: 34px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 26px;
                position: absolute;
                right: 1px;
                top: 4px;
                width: 20px;
            }

            .modal-content {
                border-radius: 3px;
            }

            .mCSB_container {
              min-height: 800px;

            }

          </style>

        </div>
        <div class="sidebar-inner">
          <div class="menu-title">
               Navigation
            </div>
            <ul class="nav nav-sidebar navigation" id="navigation">
              @foreach($main_menu as $key => $value)
              @if($value->LINK == "#")
                <li class="nav-parent">
              @else
                <li class="">
              @endif
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
        <div class="topbar" style="background: linear-gradient(to right,  #7abcff 0%,#60abf8 2%,#1f81ba 100%);">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>

            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- <img src="dist/img/photo.png" class="user-image" alt="User Image">-->
                  <span class="name" style="color:white;">{{ Session::get('name') }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <!-- <img src="dist/img/photo.png" class="img-circle" alt="User Image"> -->
                    <p>
                      <span class="name">{{ Session::get('name') }}</span><br>
                      <small>{{ Session::get('groupName') }} - {{ Session::get('FNAME') }} ({{ Session::get('branch_code') }})</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
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


          </ul>
        </div>
        <!-- header-right -->
      </div>
        <!-- END TOPBAR -->
        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Edit Profile </h4>
              </div>

              <!-- form profile -->
              <form autocomplete="off">
              <div class="modal-body">

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Group</label>
                                <select class="form-control select2" name="group" id="group" style="width: 100%;" required="required" onChange="checkGroup(this)" disabled>
                                  @if( Session::get('FCODE') == 'pvs1909' )
                                  <option value="a" selected></option>
                                  @else
                                  <option value="b" selected>{{ Session::get('groupName') }}</option>
                                  @endif
                                <option></option>


                                </select>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch</label>
                                <input type="text" class="form-control" id="branch" name="branch" placeholder="Branch" maxlength="30" value="{{ Session::get('branch_code') }}">
                            </div><!-- /.form-group -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                  	        <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="hidden" name="user_id" id="user_id" value="{{ Session::get('user_id') }}">
                                <input type="text" name="name" id="name" class="form-control" id="exampleInputEmail1" placeholder="Name" maxlength="50" value="{{ Session::get('name') }}" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control readonly" id="username" name="username" placeholder="Username" maxlength="30" value="{{ Session::get('username') }}" required="required">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Password</label>
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" maxlength="50" onchange="checkOldPass(this)">
                            </div>
                        </div>

                        <script type="text/javascript">

                            function checkOldPass(id){
                                //alert(id.value);

                                var newPassword = document.getElementById('newPassword');

                                if(id.value == '') {
                                    newPassword.disabled = true;
                                } else {
                                    newPassword.disabled = false;
                                }
                            }

                        </script>

                        <div class="col-md-6">
                            <div class="form-group">
                    	        <label>New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" maxlength="50" required="required" disabled>
                            </div><!-- /.form-group -->
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                    	        <label>Note</label>
                                <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300">a</textarea>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="display: none;" id="submitBtn">Save changes</button>
              </form> <!-- end of form profile -->
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeProfile">Close</button>
                <button type="button" class="btn btn-primary" onClick="submit()" id="submitModal">Save changes</button>
              </div>

            </div>
          </div>
        </div>
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

      $("#submitModal").click(function(e){
    e.preventDefault();

    $('.btn-primary').prop('disabled', true);

    if($('input[name="name"]').val().length <= 0)
    {
      $('#submitBtn').click();
    }
    else
    {
        $.ajax({
        type: 'POST',
        data: {
          user_id           : $('input[name="user_id"]').val(),
          name              : $('input[name="name"]').val(),
          username          : $('input[name="username"]').val(),
          oldPassword       : $('input[name="oldPassword"]').val(),
          newPassword       : $('input[name="newPassword"]').val(),
          note              : $('input[name="note"]').val(),
          },
        //headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/update_password',

        success: function (data)
        {
          console.log(data['status']);
          var result = data['status'];

          if(result == '#SUCCESS') {

            setTimeout(function(){ $('#profileModal').modal('hide'); }, 1500);
          }
          else if(result == '#ERROR')
          {

          }
        }
      });
    }
    //$('.btn-primary').prop('disabled', false);
  });

    </script>

    @yield('javascript')
  </body>
</html>
