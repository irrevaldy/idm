@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Users & Groups</strong></h2>
    </div>
    @if(isset($attrib))
    {{ $attrib }}
    @endif
    <div>Users</div>
    <div class="export-box">
      <a class="btn btn-primary export-btn deletes" data-toggle="modal" data-target="#addUsersModal"> Add New User</a>
    </div>
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table table-bordered" id="tableUsers">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Name</th>
              <th>Group</th>
              <th>Host</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

    <div>Groups</div>
    <div class="export-box">
      <a class="btn btn-primary export-btn deletes" data-toggle="modal" data-target="#addGroupsModal"> Add New Group</a>
    </div>
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table table-bordered" id="tableGroups" bor>
          <thead>
            <tr>
              <th>#</th>
              <th>Group Name</th>
              <th>Host</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>


        <!-- modal -->
        <!-- Users modal -->

        <div class="modal fade" id="addUsersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Please Input the Fields </h4>
              </div>

              <!-- form profile -->
              <form role="form" action="/administration/users_groups/addUsers" method="POST" autocomplete="off" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Group </label>
                        <select class="form-control select2" name="group" id="group2" style="width: 100%;" required="required">
                          <option></option>
                        </select>
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Branch </label>
                        <input type="text" name="branch" id="branch" class="form-control"  placeholder="Branch" maxlength="4" required="required">
                    </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label><strong class="" id="silang_text" style="color: #FF5656;display: none;"> is Already Exist</strong><strong id="centang_text" style="color: #2AE800;display: none;"> is Available</strong>
                          <div class="input-group">

                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" maxlength="30" required="required" onChange="checkUsername('username')" style="border-right: 0px;">
                            <div class="input-group-addon" id="addonBox" style="display:">
                              <i class="fa fa-spinner fa-pulse" id="spinner" style="color: #0055FF;display: none;"></i>
                              <i class="fa fa-check" id="centang" aria-hidden="true" style="color: #2AE800;display: none;"></i>
                              <i class="fa fa-times-circle" id="silang" aria-hidden="true" style="color: #FF0000;display: none;"></i>
                            </div>
                          </div><!-- /.input group -->
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                  </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Note </label>
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                      </div><!-- /.form-group -->
                    </div>


                </div>
              </div>
            </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeLimit">Close</button>
                <button type="submit" class="btn btn-primary" id="submitModal">Submit</button>
              </div>
              </form> <!-- end of form profile -->

            </div>
          </div>
        </div>

        <!-- edit corp modal -->
        <div class="modal fade" id="editUsersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Please Input The Fields</h4>
              </div>

              <!-- form profile -->
              <form role="form" action="/administration/users_groups/updateUsers" method="POST" autocomplete="off" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name </label>
                        <input type="text" class="form-control" id="edit_user_id" name="edit_user_id" required="required" style="display: none;">
                        <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="Name" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Group </label>
                        <select class="form-control select2" name="edit_group" id="edit_group" style="width: 100%;" required="required">
                          <option></option>
                        </select>    </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Branch </label>
                        <input type="text" name="edit_branch" id="edit_branch" class="form-control"  placeholder="Branch" maxlength="4" required="required">
                    </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label><strong class="" id="silang_text" style="color: #FF5656;display: none;"> is Already Exist</strong><strong id="centang_text" style="color: #2AE800;display: none;"> is Available</strong>
                          <div class="input-group">

                            <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Username" maxlength="30" required="required" onChange="checkUsername('username')" style="border-right: 0px;">
                            <div class="input-group-addon" id="addonBox" style="display:">
                              <i class="fa fa-spinner fa-pulse" id="spinner" style="color: #0055FF;display: none;"></i>
                              <i class="fa fa-check" id="centang" aria-hidden="true" style="color: #2AE800;display: none;"></i>
                              <i class="fa fa-times-circle" id="silang" aria-hidden="true" style="color: #FF0000;display: none;"></i>
                            </div>
                          </div><!-- /.input group -->
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="edit_password" id="edit_password" class="form-control" placeholder="Password" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Note </label>
                        <textarea class="form-control" rows="3" name="edit_note" id="edit_note" placeholder="Type your note here ..." maxlength="300"></textarea>
                      </div><!-- /.form-group -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group">
                          <label>Status</label><br>

                          <label for="st-active" id="lbl-active" class="tin">Active</label>
                          <input type="radio" name="status" value="1" id="st-active" onclick="klik()">
                          <input type="radio" name="status" value="0" id="st-inactive" onclick="klik()" >
                          <label for="st-inactive" id="lbl-inactive" class="bold">Not Active</label>
                      </div>
                    </div>
                </div>

                </div>
              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeLimit">Close</button>
                <button type="submit" class="btn btn-primary" id="submitModal">Submit</button>
              </div>
              </form> <!-- end of form profile -->


            </div>
          </div>
        </div>

        <!-- del corp modal -->
        <div id="delUsersModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete User</h4>
              </div>
              <div class="modal-body">
                <p>User <span id="delete_name"></span> will be deleted, are you sure ?</p>
                <form style="display: none;" action="/administration/users_groups/deleteUsers" method="POST">
                  <input type="text" name="delete_user_id" id="delete_user_id" />
                  <input type="text" name="delete_name" id="delete_name" />
                  <input type="submit" id="submitUser"/></form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onClick="submitUser()">Submit</button>
              </div>
            </div>

          </div>
        </div>

        <!-- merchant modal -->
        <div class="modal fade" id="addGroupsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Please Input The Fields </h4>
              </div>
              <!-- form profile -->
              <form role="form" action="/administration/users_groups/addGroups" method="POST" autocomplete="off" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Group Name</label>
                        <input type="text" name="name" id="name" class="form-control"  placeholder="Group" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Host </label>
                        <select class="form-control institute" name="institute" id="institute" style="width: 100%;" onChange="checkHost(this)" required="required">
                          <option></option>
                        </select>
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Merchant </label>
                        <select class="form-control merchant" name="merchant" id="merchant" style="width: 100%;">
                          <option></option>
                        </select>
                      </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Note </label>
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Privileges</label>
                        <input type="text" name="privileges" id="privileges" class="form-control" placeholder="privilege" maxlength="50" required="required">
                    </div><!-- /.form-group -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeLimit">Close</button>
                <button type="submit" class="btn btn-primary" id="submitModal">Submit</button>
              </div>
              </form> <!-- end of form profile -->

            </div>
          </div>
        </div>

        <div class="modal fade" id="editGroupsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Update Group Form</h4>
              </div>
              <!-- form profile -->
              <form role="form" action="/administration/users_groups/updateGroups" method="POST" autocomplete="off" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Group Name </label>
                        <input type="text" name="edit_group_id2" id="edit_group_id2" class="form-control" placeholder="Name" maxlength="50" required="required" style="display: none;">
                        <input type="text" name="edit_group2" id="edit_group2" class="form-control" placeholder="Name" maxlength="50" required="required">
                      </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Host </label>
                        <select class="form-control edit_host2" name="edit_host2" id="edit_host2" style="width: 100%;" required="required">
                        </select>
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Merchant </label>
                        <select class="form-control edit_merchant2" name="edit_merchant2" id="edit_merchant2" style="width: 100%;" required="required">
                        </select>
                      </div><!-- /.form-group -->
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Note </label>
                        <textarea class="form-control" rows="3" name="edit_note2" id="edit_note2" placeholder="Type your note here ..." maxlength="300"></textarea>
                      </div><!-- /.form-group -->
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label>Status</label><br>
                        <label for="st-active2" id="lbl-active2" class="tin">Active</label>
                        <input type="radio" name="group_status" value="1" id="st-active2" onclick="klik()">
                        <input type="radio" name="group_status" value="0" id="st-inactive2" onclick="klik()">
                        <label for="st-inactive2" id="lbl-inactive2" class="bold">Not Active</label>
                      </div>
                    </div>
                  </div> <!-- end of row -->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Privileges</label>
                      <input type="text" name="edit_privileges2" id="edit_privileges2" class="form-control"  placeholder="Privilege" maxlength="4" required="required">
                    </div><!-- /.form-group -->
                  </div>
                </div>

                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeLimit">Close</button>
                <button type="submit" class="btn btn-primary" id="submitModal">Submit</button>
              </div>
              </form> <!-- end of form profile -->

            </div>
          </div>
        </div>



        <!-- Modal Delete Merch -->
        <div id="delGroupsModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Group</h4>
              </div>
              <div class="modal-body">
                <p>Group <span id="delete_groupName"></span> will be deleted, are you sure ?</p>
                <form style="display: none;" action="/administration/users_groups/deleteGroups" method="POST">
                  <input type="text" name="delete_group_id" id="delete_group_id" />
                  <input type="text" name="delete_groupName2" id="delete_groupName2" />
                  <input type="text" name="delete_group_host" id="delete_group_host" />
                  <input type="submit" id="submitGroup"/>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onClick="submitGroup()">Submit</button>
              </div>
            </div>

          </div>
        </div>

        <!--end of modal -->
@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->

<script type="text/javascript">
  $(document).ready(function(){
    var tableUsers = $('#tableUsers').DataTable();

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/administration/users_groups/get_all_dataUsers',
			success: function (data) {
				tableUsers.clear().draw();

				for (var i = 0; i < data.length; i++) {
          var user_id = data[i].user_id;
          var name = data[i].name;
          var group_id = data[i].group_id;
          var groupName = data[i].groupName;
          var branch = data[i].branch_code;
          var username = data[i].username;
          var password = data[i].password;
          var note = data[i].description;
          var fid = data[i].FID;
          var fname = data[i].FNAME;
          if(fid == '99')
          {
            host = fname;
          }
          else if(fid == '1909')
          {
            host = 'Wirecard';
          }
          var status = data[i].status;

          $('input#st-active').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
          }).on('ifChecked', function(event){
            //alert('tes');
            $("label#lbl-active").addClass("bold");
            $("label#lbl-active").removeClass("tin");
            $("label#lbl-inactive").removeClass("bold");
            $("label#lbl-inactive").addClass("tin");
          });

          $('input#st-inactive').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
          }).on('ifChecked', function(event){
            //alert('tes');
            $("label#lbl-inactive").addClass("bold");
            $("label#lbl-inactive").removeClass("tin");
            $("label#lbl-active").removeClass("bold");
            $("label#lbl-active").addClass("tin");

          });

          function active(){
            $('input#st-active').iCheck('check', function(){
              $("label#lbl-active").addClass("bold");
              $("label#lbl-active").removeClass("tin");
              $("label#lbl-inactive").removeClass("bold");
              $("label#lbl-inactive").addClass("tin");
            });
          }

          if(status == '1') {
            active();
          }

          if(status == '1')
          {
            status2 = 'Active';
          }
          else {
            status2 = 'Not Active';
          }
          if(note == null)
          {
            note = '';
          }

          var jRow = $('<tr>').append(
              '<td>'+ (i + 1) +'</td>',
                '<td>'+ username +'</td>',
                '<td>'+ name +'</td>',
                '<td>'+ groupName +'</td>',
                '<td>'+ fname +'</td>',
                '<td>'+ status2 +'</td>',
                '<td><a class="edit btn btn-sm btn-default" href="javascript:;" style="cursor: pointer;" onClick="editUsers(\''+ user_id +'\',\''+ name +'\', \''+ group_id +'\',\''+ branch +'\',\''+ username +'\',\''+ password +'\',\''+ note +'\')" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" style="cursor: pointer;" onClick="deleteUsers(\''+ user_id +'\',\''+ name +'\')"><i class="icons-office-52"></i></a></td>'

                );

          tableUsers.row.add(jRow).draw();
				}
			}
			});

      var tableGroups = $('#tableGroups').DataTable();

      $.ajax({
        dataType: 'JSON',
        type: 'GET',
        url: '/administration/users_groups/get_all_dataGroups',
  			success: function (data) {
  				tableGroups.clear().draw();

  				for (var i = 0; i < data.length; i++) {
            var group_id = data[i].group_id;
            var groupName = data[i].groupName;
            var group_host = data[i].FMERCHNAME;
            var group_fid = data[i].FID;
            var group_fname = data[i].FNAME;
            var merch_id = data[i].merch_id;
            if(group_fid == '99')
            {
              group_host = 'Merchant';
            }
            else if(group_fid == '1909')
            {
              group_host = 'Wirecard';
            }
            else
            {
              group_host = group_fname;
            }

            var group_status = data[i].status;
            var group_merchant = data[i].FMERCHNAME;

            $('input#st-active2').iCheck({
              checkboxClass: 'icheckbox_flat-green',
              radioClass: 'iradio_flat-green'
            }).on('ifChecked', function(event){
              //alert('tes');
              $("label#lbl-active2").addClass("bold");
              $("label#lbl-active2").removeClass("tin");
              $("label#lbl-inactive2").removeClass("bold");
              $("label#lbl-inactive2").addClass("tin");
            });

            $('input#st-inactive2').iCheck({
              checkboxClass: 'icheckbox_flat-red',
              radioClass: 'iradio_flat-red'
            }).on('ifChecked', function(event){
              //alert('tes');
              $("label#lbl-inactive2").addClass("bold");
              $("label#lbl-inactive2").removeClass("tin");
              $("label#lbl-active2").removeClass("bold");
              $("label#lbl-active2").addClass("tin");

            });


          function active2(){
            $('input#st-active2').iCheck('check', function(){
              $("label#lbl-active2").addClass("bold");
              $("label#lbl-active2").removeClass("tin");
              $("label#lbl-inactive2").removeClass("bold");
              $("label#lbl-inactive2").addClass("tin");
            });
          }

          if(group_status == '1') {
            active2();
          }

            if(group_status == '1')
            {
              group_status2 = 'Active';
            }
            else {
              group_status2 = 'Not Active';
            }

            var jRow = $('<tr>').append(
              '<td>'+ (i + 1) +'</td>',
                '<td>'+ groupName +'</td>',
                '<td>'+ group_merchant +'</td>',
                '<td>'+ group_status2 +'</td>',
                '<td><a class="edit btn btn-sm btn-default" href="javascript:;" style="cursor: pointer;" onClick="editGroups(\''+ group_id +'\', \''+ groupName +'\',\''+ group_fid +'\',\''+ merch_id +'\')" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" style="cursor: pointer;" onClick="deleteGroups(\''+ group_id +'\',\''+ groupName +'\',\''+ group_host +'\')"><i class="icons-office-52"></i></a></td>'

                );

            tableGroups.row.add(jRow).draw();
  				}
  			}
  			});

  });

  function editUsers(user_id, name, group, branch, username, password, note) {
        $('#edit_user_id').val(user_id);
        $('#edit_name').val(name);
        $('#edit_group').val(group).trigger("change");
        $('#edit_branch').val(branch);
        $('#edit_username').val(username);
        $('#edit_password').val(password);
        $('#edit_note').val(note);

      $('#editUsersModal').modal('show');

    }

    function deleteUsers(user_id, name) {
          $('#delete_name').html(name);
          $('#delete_name').val(name);
          $('#delete_user_id').val(user_id);

        $('#delUsersModal').modal('show');

      }
      function submitUser(){
        $("#submitUser").click();
      }

      function editGroups(group_id, groupName, group_host, group_merchant) {
            $('#edit_group_id2').val(group_id);
            $('#edit_group2').val(groupName);
            $('#edit_host2').val(group_host).trigger("change");
            $('#edit_merchant2').val(group_merchant).trigger("change");

          $('#editGroupsModal').modal('show');

        }

      function deleteGroups(group_id, groupName, group_host) {
            $('#delete_groupName').html(groupName);
            $('#delete_groupName2').val(groupName);
            $('#delete_group_id').val(group_id);
            $('#delete_group_host').val(group_host);

          $('#delGroupsModal').modal('show');

        }
        function submitGroup(){
          $("#submitGroup").click();
        }

        $(function ()
        {
              $(".select2").select2({
                  placeholder: "Select Group",
                  allowClear: true
              });
              $(".institute").select2({
                  placeholder: "Select Host",
                  allowClear: true
              });
              $(".merchant").select2({
                  placeholder: "Select Merchant",
                  allowClear: true
              });
              $(".edit_host2").select2({
                  placeholder: "Select Host",
                  allowClear: true
              });
              $(".edit_merchant2").select2({
                  placeholder: "Select Merchant",
                  allowClear: true
              });
        });

        $.ajax({
          dataType: 'JSON',
          type: 'POST',
          url: '/group_data',
          success: function (data) {

            for(var i = 0; i < data.length; i++)
            {

              $("#group2").append('<option value="' + data[i]['group_id'] + '">' + data[i]['groupName'] + '</option>');
            }
            $("#group2").append('<option value="' + data[i]['group_id'] + '">' + data[i]['groupName'] + '</option>');

          }
        });

        $.ajax({
          dataType: 'JSON',
          type: 'POST',
          url: '/group_data',
          success: function (data) {

            for(var i = 0; i < data.length; i++)
            {

              $("#edit_group").append('<option value="' + data[i]['group_id'] + '">' + data[i]['groupName'] + '</option>');
            }
          }
        });

        $.ajax({
          dataType: 'JSON',
          type: 'GET',
          url: '/institute_data',
          success: function (data) {

            for(var i = 0; i < data.length; i++)
            {

              $("#institute").append('<option value="' + data[i]['FID'] + '">' + data[i]['FNAME'] + '</option>');
            }
          ;

          }
        });

        $.ajax({
          dataType: 'JSON',
          type: 'GET',
          url: '/merchant_data_all',
          success: function (data) {

            for(var i = 0; i < data.length; i++)
            {

              $("#merchant").append('<option value="' + data[i]['FID'] + '">' + data[i]['FMERCHNAME'] + '</option>');
            }
          }
        });

        $.ajax({
          dataType: 'JSON',
          type: 'GET',
          url: '/institute_data',
          success: function (data) {


            for(var i = 0; i < data.length; i++)
            {
              $("#edit_host2").append('<option value="' + data[i]['FID'] + '">' + data[i]['FNAME'] + '</option>');
            }
              $("#edit_host2").append('<option value="99">Merchant</option>');
              $("#edit_host2").append('<option value="1909">Wirecard</option>');
          }
        });

        $.ajax({
          dataType: 'JSON',
          type: 'GET',
          url: '/merchant_data_all',
          success: function (data) {

            for(var i = 0; i < data.length; i++)
            {

              $("#edit_merchant2").append('<option value="' + data[i]['FID'] + '">' + data[i]['FMERCHNAME'] + '</option>');
            }
          }
        });


</script>
@endsection
