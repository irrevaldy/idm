@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Users & Groups</strong></h2>
    </div>
    <div>Users</div>
    <div class="export-box">
              <a class="btn btn-primary export-btn deletes" data-toggle="modal" data-target="#addUsersModal"> Add New User</a>
            </div>
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table" id="tableUsers" >
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
          <table class="table" id="tableGroups" >
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
                      <form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                                <input type="text" name="group" id="group" class="form-control"  placeholder="Group" maxlength="50" required="required">
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

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Note </label>
                                <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                              </div><!-- /.form-group -->
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

                <!-- edit corp modal -->
                <div class="modal fade" id="editUsersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog " role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Please Input The Fields</h4>
                      </div>

                      <!-- form profile -->
                      <form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                                <input type="text" name="group" id="group" class="form-control"  placeholder="Group" maxlength="50" required="required">
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

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Note </label>
                                <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                              </div><!-- /.form-group -->
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
                        <p>User <span id="user"></span> will be deleted, are you sure ?</p>
                        <form style="display: none;" action="process/delete_user.php" method="POST"><input type="text" name="user_id" id="user_ids" /><input type="submit" id="submitUser"/></form>
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
                      <form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" name="name" id="name" class="form-control"  placeholder="Group" maxlength="50" required="required">
                            </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Host </label>
                                <input type="text" name="institute" id="institute" class="form-control" placeholder="Name" maxlength="50" required="required">
                            </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Merchant </label>
                                <input type="text" name="merchant" id="merchant" class="form-control"  placeholder="Branch" maxlength="4" required="required">
                            </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Note </label>
                                <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                              </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Privileges</label>
                                <input type="text" name="privileges" id="privileges" class="form-control" placeholder="Password" maxlength="50" required="required">
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
                      <form role="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Group Name </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" maxlength="50" required="required">
                            </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Host </label>
                                <input type="text" name="group" id="group" class="form-control"  placeholder="Group" maxlength="50" required="required">
                            </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Merchant </label>
                                <input type="text" name="branch" id="branch" class="form-control"  placeholder="Branch" maxlength="4" required="required">
                            </div><!-- /.form-group -->
                            </div>


                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Note </label>
                              <textarea class="form-control" rows="3" name="note" id="note" placeholder="Type your note here ..." maxlength="300"></textarea>
                            </div><!-- /.form-group -->
                          </div>


                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Status</label><br>
                                <label for="st-active" id="lbl-active" class="tin">Active</label>
                                <input type="radio" name="status" value="1" id="st-active" onclick="klik()">
                                <input type="radio" name="status" value="0" id="st-inactive" onclick="klik()">
                                <label for="st-inactive" id="lbl-inactive" class="bold">Not Active</label>
                              </div>
                            </div>
                          </div> <!-- end of row -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Privileges</label>
                              <input type="text" name="privileges" id="privileges" class="form-control"  placeholder="Branch" maxlength="4" required="required">
                          </div><!-- /.form-group -->
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
                        <p>Group <span id="group"></span> will be deleted, are you sure ?</p>
                        <form style="display: none;" action="process/delete_group.php" method="POST"><input type="text" name="group_id" id="group_id" /><input type="submit" id="submitGroup"/></form>
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
          var username = data[i].username;
          var name = data[i].name;
          var groupName = data[i].groupName;
          var FNAME = data[i].FNAME;
          var status = data[i].status;

          var jRow = $('<tr>').append(
            '<td>'+ (i + 1) +'</td>',
              '<td>'+ username +'</td>',
              '<td>'+ name +'</td>',
              '<td>'+ groupName +'</td>',
              '<td>'+ FNAME +'</td>',
              '<td>'+ status +'</td>',
              '<td><a class="edit btn btn-sm btn-default" href="javascript:;" data-toggle="modal" data-target="#editUsersModal" style="cursor: pointer;" onClick="" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" data-toggle="modal" data-target="#delUsersModal" style="cursor: pointer;" onClick=""><i class="icons-office-52"></i></a></td>'

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
            var groupName = data[i].groupName;
            var host = data[i].host;
            var status = data[i].status;

            var jRow = $('<tr>').append(
              '<td>'+ (i + 1) +'</td>',
                '<td>'+ groupName +'</td>',
                '<td>'+ host +'</td>',
                '<td>'+ status +'</td>',
                '<td><a class="edit btn btn-sm btn-default" href="javascript:;" data-toggle="modal" data-target="#editGroupsModal" style="cursor: pointer;" onClick="" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" data-toggle="modal" data-target="#delGroupsModal" style="cursor: pointer;" onClick=""><i class="icons-office-52"></i></a></td>'

                );

            tableGroups.row.add(jRow).draw();
  				}
  			}
  			});

  });
</script>
@endsection
