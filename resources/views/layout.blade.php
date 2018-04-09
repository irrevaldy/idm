<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Wirecard</title>
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}"> <!-- Gem style -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/back-to-top/css/style.css') }}"> <!-- Gem style -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/messg/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tile-stats.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
  </head>
  <body class="hold-transition skin-blue fixed sidebar-mini {{ Session::get('sidebar')}} ">
  <a href="#0" class="cd-top">Top</a>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- navbar -->
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
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                  <!-- User Account: style can be found in dropdown.less -->
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
                          <span class="name">{{ Session::get('name') }}</span><br>
                          @if(Session::get('branch_code') != '')
                          <small>{{ Session::get('groupName') }} - {{ Session::get('FNAME') }} ({{ Session::get('branch_code') }})</small>
                          @else
                          <small>{{ Session::get('groupName') }} - {{ Session::get('FNAME') }}</small>
                          @endif
                        </p>
                      </li>
                      <!-- Menu Body -->
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
            </nav>
          </header>
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <ul class="sidebar-menu">
                @foreach($main_menu as $key => $value)
                @if($value->LINK != "#")
                <li>  <a href="{{ URL::to($value->LINK) }}"><i class="fa {{ $value->LOGO }}" aria-hidden="true"></i><span data-translate="{{ $value->NAME }}">{{ $value->NAME }}</span><!--<span class="fa arrow"></span>--></a></li>
                @else
                <li class="treeview">  <a href="{{ URL::to($value->LINK) }}"><i class="fa {{ $value->LOGO }}" aria-hidden="true"></i><span data-translate="{{ $value->NAME }}">{{ $value->NAME }}</span><!--<span class="fa arrow"></span>--></a>
                  <ul class="treeview-menu">
                    @foreach($sub_menu as $key2 => $value2)
                    @if($value->ID == $value2->PARENTID)
                    <li><a href="{{ URL::to($value2->LINK) }}"><i class="fa {{ $value2->LOGO }}" aria-hidden="true"></i><span data-translate="{{ $value2->NAME }}">{{ $value2->NAME }}</span></a></li>
                    @endif
                    @endforeach
                  </ul>
                </li>
                @endif
              @endforeach
            </ul>
            </section>
            <!-- /.sidebar -->
          </aside>




    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Edit Profile </h4>
          </div>

          <!-- form profile -->
          <form id="updatePassword_form" autocomplete="off">
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

             <div class="modal-footer">
               <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeProfile">Close</button>
               <button type="button" class="btn btn-primary" id="submitModal">Save changes</button>
             </div>
           </form> <!-- end of form profile -->
         </div>
       </div>
     </div>

    <!-- page content -->

    @yield('content')
    <!-- /page content -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <!-- <b>Version</b> 2.3.0 -->
        </div>
        <strong>Copyright &copy; 2018 Wirecard | PT Prima Vista Solusi.</strong> All rights reserved.
    </footer>


    <!-- END PAGE CONTENT -->

    <!-- END MAIN CONTENT -->
    </div>


  <!-- javascript -->
  <script src="{{ asset('assets/plugins/jquery/jquery-2.1.4.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/back-to-top/js/main.js') }}"></script>
  <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
      <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

  <script type="text/javascript">
    function setSidebar()
    {
      $.ajax({
        dataType: 'JSON',
        type: 'GET',
        url: '/sidebar',
        success: function (data) {
        /*  if(data['sidebar'] == 'sidebar-collapse')
          {
             $("body").addClass('sidebar-collapse');
          }
          else if(data['sidebar'] == '')
          {
             $("body").removeClass('sidebar-collapse');
          }*/
        }
      });
    }
  </script>
  <script type="text/javascript">


    function checkOldPass(id)
    {
      //alert(id.value);
      var newPassword = document.getElementById('newPassword');

      if(id.value == '')
      {
        newPassword.disabled = true;
      }
      else
      {
        newPassword.disabled = false;
      }
    }
  </script>

  <script type="text/javascript">
  $("#submitModal").click(function(e)
  {
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

          if(result == '#SUCCESS')
          {
            $('#oldPassword').val('').trigger('change');
            $('#newPassword').val('').trigger('change');

            //$('#updatePassword_form')[0].reset();

            setTimeout(function(){ $('#profileModal').modal('hide'); }, 1500);
          }
          else if(result == '#ERROR')
          {

          }
        }
      });
    }
    $('.btn-primary').prop('disabled', false);
  });
  </script>
  @yield('javascript')
</body>
</html>
