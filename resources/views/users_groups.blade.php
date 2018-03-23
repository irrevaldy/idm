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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Register New Corporate </h4>
                      </div>

                      <!-- form profile -->
                      <form role="form" action="process/add_corporate.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Corporate Name </label>
                                <input type="text" class="form-control" name="corporateName" placeholder="Corporate..." required="required">
                              </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Corporate Logo</label>
                                <strong class="" id="silang_text" style="color: #FF5656;display: none;"> must be filled</strong>
                                <div class="input-group input-group-sm">
                                  <input type="file" name="uploadedfile" id="logoBrowse" style="display:none;" onChange="setFileName()">
                                  <input type="text" class="form-control" readonly="readonly" id="logoText">
                                  <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" id="browseFile" type="button" onclick="$('#logoBrowse').click();">Browse</button>
                                  </span>
                                </div><!-- /input-group -->
                              </div>
                            </div>

                            <script type="text/javascript">

                              function setFileName() {
                                var input = document.getElementById("logoBrowse");
                                var logoText = document.getElementById("logoText");
                                var browseFile = document.getElementById("browseFile");
                                //alert(input.files[0].name);

                                logoText.value = input.files[0].name;
                                if(logoText.value != '') {
                                  logoText.style.borderColor = "";
                                  browseFile.style.borderColor = "";
                                  silang_text.style.display = "none";
                                }

                              }

                            </script>

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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Edit Corporate </h4>
                      </div>

                      <!-- form profile -->
                      <form role="form" action="process/update_corporate.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Corporate Name </label>
                                <input type="text" class="form-control" id="corporateId" name="corporateId" placeholder="Corporate..." required="required" style="display: none;">
                                <input type="text" class="form-control" id="corporateName" name="corporateName" placeholder="Corporate..." required="required">
                              </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Corporate Logo</label>
                                <strong class="" id="silang_text" style="color: #FF5656;display: none;"> must be filled</strong>
                                <div class="input-group input-group-sm">
                                  <input type="file" name="uploadedfile" id="logoBrowse" style="display:none;" onChange="setFileName()">
                                  <input type="text" class="form-control" readonly="readonly" id="logoText">
                                  <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" id="browseFile" type="button" onclick="$('#logoBrowse').click();">Browse</button>
                                  </span>
                                </div><!-- /input-group -->
                              </div>
                            </div>

                            <script type="text/javascript">

                              function setFileName() {
                                var input = document.getElementById("logoBrowse");
                                var logoText = document.getElementById("logoText");
                                var browseFile = document.getElementById("browseFile");
                                //alert(input.files[0].name);

                                logoText.value = input.files[0].name;
                                if(logoText.value != '') {
                                  logoText.style.borderColor = "";
                                  browseFile.style.borderColor = "";
                                  silang_text.style.display = "none";
                                }

                              }

                            </script>

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
                        <h4 class="modal-title">Delete Corporate</h4>
                      </div>
                      <div class="modal-body">
                        <p>Corporate <span id="corporateNameSpan"></span> will be deleted, are you sure ?</p>
                        <form style="display: none;" action="process/delete_corporate.php" method="POST"><input type="text" name="corporateIdDel" id="corporateIdDel" /><input type="submit" id="submitDelCorp"/></form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onClick="submitDelCorp()">Submit</button>
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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Register New Merchant </h4>
                      </div>

                      <!-- form profile -->
                      <form role="form" action="process/add_merchant.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Corporate </label>
                                <select class="form-control corp" name="corporateId" id="trxType" style="width: 100%;" required="required">
                                  <option></option>

                                </select>
                              </div><!-- /.form-group -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Merchant Name </label>
                                <input type="text" class="form-control" name="merchName" placeholder="Merchant" required="required">
                              </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Merchant Logo</label>
                                <strong class="" id="silang_text" style="color: #FF5656;display: none;"> must be filled</strong>
                                <div class="input-group input-group-sm">
                                  <input type="file" name="uploadedfile" id="logoBrowse" style="display:none;" onChange="setFileName()">
                                  <input type="text" class="form-control" readonly="readonly" id="logoText">
                                  <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" id="browseFile" type="button" onclick="$('#logoBrowse').click();">Browse</button>
                                  </span>
                                </div><!-- /input-group -->
                              </div>
                            </div>

                            <script type="text/javascript">

                              function setFileName() {
                                var input = document.getElementById("logoBrowse");
                                var logoText = document.getElementById("logoText");
                                var browseFile = document.getElementById("browseFile");
                                //alert(input.files[0].name);

                                logoText.value = input.files[0].name;
                                if(logoText.value != '') {
                                  logoText.style.borderColor = "";
                                  browseFile.style.borderColor = "";
                                  silang_text.style.display = "none";
                                }

                              }

                            </script>

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
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Edit Merchant </h4>
                      </div>

                      <!-- form profile -->
                      <form role="form" action="process/update_merchant.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Corporate </label>
                                <select class="form-control corp" name="corporateId" id="corporateIdSelect" style="width: 100%;" required="required">
                                  <option value=""></option>

                                </select>
                              </div><!-- /.form-group -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Merchant Name </label>
                                <input type="text" class="form-control" name="editMerchName" id="merchName" placeholder="Merchant" required="required">
                                <input type="text" class="form-control" name="editMerchId" id="merchId" placeholder="Merchant" required="required" style="display: none;">
                              </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Merchant Logo</label>
                                <strong class="" id="silang_text" style="color: #FF5656;display: none;"> must be filled</strong>
                                <div class="input-group input-group-sm">
                                  <input type="file" name="uploadedfile" id="editLogoBrowse" style="display:none;" onChange="setFileNameEdit()">
                                  <input type="text" class="form-control" readonly="readonly" id="editLogoText">
                                  <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" id="browseFile" type="button" onclick="$('#editLogoBrowse').click();">Browse</button>
                                  </span>
                                </div><!-- /input-group -->
                              </div>
                            </div>

                            <script type="text/javascript">

                              function setFileNameEdit() {
                                var input = document.getElementById("editLogoBrowse");
                                var logoText = document.getElementById("editLogoText");
                                var browseFile = document.getElementById("editLogoBrowse");
                                //alert(input.files[0].name);

                                logoText.value = input.files[0].name;
                                if(logoText.value != '') {
                                  logoText.style.borderColor = "";
                                  browseFile.style.borderColor = "";
                                  silang_text.style.display = "none";
                                }

                              }

                            </script>

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
                        <h4 class="modal-title">Delete Merchant</h4>
                      </div>
                      <div class="modal-body">
                        <p>Merchant <span id="merchNameSpan"></span> will be deleted, are you sure ?</p>
                        <form style="display: none;" action="process/delete_merchant.php" method="POST"><input type="text" name="merchIdDel" id="merchIdDel" /><input type="submit" id="submitDelMerch"/></form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onClick="submitDelMerch()">Submit</button>
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
              '<td><a class="edit btn btn-sm btn-default" href="javascript:;" data-toggle="modal" data-target="#editUsersModal" style="cursor: pointer;" onClick="" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" data-toggle="modal" data-target="#modal-delete" style="cursor: pointer;" onClick=""><i class="icons-office-52"></i></a></td>'

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
                '<td><a class="edit btn btn-sm btn-default" href="javascript:;" data-toggle="modal" data-target="#editGroupsModal" style="cursor: pointer;" onClick="" ><i class="icon-note"></i></a><a class="delete btn btn-sm btn-danger" href="javascript:;" data-toggle="modal" data-target="#modal-delete" style="cursor: pointer;" onClick=""><i class="icons-office-52"></i></a></td>'

                );

            tableGroups.row.add(jRow).draw();
  				}
  			}
  			});

  });
</script>
@endsection
