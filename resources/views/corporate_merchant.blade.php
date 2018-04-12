@extends('layout')

@section('content')

@if(isset($attrib))
{{ $attrib }}
@endif
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-university" aria-hidden="true"></i> Corporate & Merchant
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Corporate & Merchant</li>
    </ol>
  </section>

  <section class="content">

  <div class="row">

      <!-- table user -->
      <div class="col-md-12">

        <div class="box box-primary box-table">
          <div class="export-box">
            <a class="btn btn-primary export-btn" data-toggle="modal" data-target="#addCorpModal"> Add New <b>Corporate</b> </a>
          </div>
          <div class="box-body">
            <table id="tableCorporate" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Corporate Name</th>
                  <th>Merchant Logo</th>
                  <th>Register Date</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- end of table user -->

  </div> <!-- end of row -->

  <div class="row">

      <!-- table user -->
      <div class="col-md-12">

        <div class="box box-primary box-table">
          <div class="export-box">
            <a class="btn btn-primary export-btn"  data-toggle="modal" data-target="#addMerchModal"> Add New <b>Merchant</b> </a>
          </div>
          <div class="box-body">
            <table id="tableMerchant" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Merchant Name</th>
                  <th>Corporate</th>
                  <th>Merchant Logo</th>
                  <th>Register Date</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <!-- end of table user -->

  </div> <!-- end of row -->

  </section><!-- /.content -->


</div><!-- end of wrapper -->

<!-- modal -->
<!-- corporate modal -->

<div class="modal fade" id="addCorpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Register New Corporate </h4>
      </div>

      <!-- form profile -->
      <form role="form" action="/administration/corporate_merchant/addCorporate" method="POST" autocomplete="off" enctype="multipart/form-data">
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
<div class="modal fade" id="editCorpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Edit Corporate </h4>
      </div>

      <!-- form profile -->
      <form role="form" action="/administration/corporate_merchant/updateCorporate" method="POST" autocomplete="off" enctype="multipart/form-data">
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
<div id="delCorpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Corporate</h4>
      </div>
      <div class="modal-body">
        <p>Corporate <span id="corporateNameSpan"></span> will be deleted, are you sure ?</p>
        <form style="display: none;" action="/administration/corporate_merchant/deleteCorporate" method="POST"><input type="text" name="corporateIdDel" id="corporateIdDel" /><input type="submit" id="submitDelCorp"/></form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onClick="submitDelCorp()">Submit</button>
      </div>
    </div>

  </div>
</div>

<!-- merchant modal -->
<div class="modal fade" id="addMerchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Register New Merchant </h4>
      </div>

      <!-- form profile -->
      <form role="form" action="/administration/corporate_merchant/addMerchant" method="POST" autocomplete="off" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Corporate </label>

                <select class="form-control corp" name="corporateId" id="corporateId-merch" style="width: 100%;" required="required">
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
                  <input type="file" name="uploadedfile" id="logoBrowseo" style="display:none;" onChange="setFileNameMerchant()">
                  <input type="text" class="form-control" readonly="readonly" id="logoTexto">
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" id="browseFileo" type="button" onclick="$('#logoBrowseo').click();">Browse</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div>

            <script type="text/javascript">

              function setFileNameMerchant() {
                var input = document.getElementById("logoBrowseo");
                var logoText = document.getElementById("logoTexto");
                var browseFile = document.getElementById("browseFileo");
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

<div class="modal fade" id="editMerchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university" aria-hidden="true"></i> Edit Merchant </h4>
      </div>

      <!-- form profile -->
      <form role="form" action="/administration/corporate_merchant/updateMerchant" method="POST" autocomplete="off" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Corporate </label>
                <select class="form-control corp" name="corporateId" id="editCorporateId2" style="width: 100%;" required="required">
                  <option value=""></option>
                </select>
              </div><!-- /.form-group -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Merchant Name </label>
                <input type="text" class="form-control" name="editMerchName" id="editMerchName" required="required">
                <input type="text" class="form-control" name="editMerchId" id="editMerchId" placeholder="Merchant" style="display: none;">
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
                    <button class="btn btn-info btn-flat" id="editBrowseFile" type="button" onclick="$('#editLogoBrowse').click();">Browse</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div>

            <script type="text/javascript">

              function setFileNameEdit() {
                var input = document.getElementById("editLogoBrowse");
                var logoText = document.getElementById("editLogoText");
                var browseFile = document.getElementById("editBrowseFile");
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
<div id="delMerchModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Merchant</h4>
      </div>
      <div class="modal-body">
        <p>Merchant <span id="merchNameSpan"></span> will be deleted, are you sure ?</p>
        <form style="display: none;" action="/administration/corporate_merchant/deleteMerchant" method="POST"><input type="text" name="merchIdDel" id="merchIdDel" /><input type="submit" id="submitDelMerch"/></form>
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

@if(isset($attrib))
@if($attrib == "Add Corporate Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Add Corporate Success', 3500);

  </script>
@elseif($attrib == "Add Corporate Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Add Corporate Failed', 3500);

  </script>
@elseif($attrib == "Update Corporate Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Update Corporate Success', 3500);

  </script>
@elseif($attrib == "Update Corporate Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Update Corporate Failed', 3500);

  </script>
@elseif($attrib == "Delete Corporate Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Delete Corporate Success', 3500);

  </script>
@elseif($attrib == "Delete Corporate Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Delete Corporate Failed', 3500);

  </script>
@elseif($attrib == "Add Merchant Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Add Merchant Success', 3500);

  </script>
@elseif($attrib == "Add Merchant Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Add Merchant Failed', 3500);

  </script>
@elseif($attrib == "Update Merchant Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Update Merchant Success', 3500);

  </script>
@elseif($attrib == "Update Merchant Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Update Merchant Failed', 3500);

  </script>
@elseif($attrib == "Delete Merchant Success")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Delete Merchant Success', 3500);

  </script>
@elseif($attrib == "Delete Merchant Failed")
<script type="text/javascript">

    messg.success('<i class="fa fa-check"></i> Delete Merchant Failed', 3500);

  </script>
  @endif
  @endif

<script type="text/javascript">
$(function () {
  $('#tableCorporate').DataTable();

  jQuery('#tableCorporate').wrap('<div class="dataTables_scroll" />');

  $('#tableMerchant').DataTable();

  jQuery('#tableMerchant').wrap('<div class="dataTables_scroll" />');
});

  $(document).ready(function(){
    var tableCorporate = $('#tableCorporate').DataTable();

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/administration/corporate_merchant/get_all_dataCorporate',
			success: function (data) {
				tableCorporate.clear().draw();

				for (var i = 0; i < data.length; i++) {
          var ID = data[i].ID;
          var CORP_NAME = data[i].CORP_NAME;
          var CORP_LOGO = data[i].CORP_LOGO;
          var REG_DATE = data[i].REG_DATE;

          if(REG_DATE == null)
          {
            REG_DATE = '';
          }

          var jRow = $('<tr>').append(
            '<td>'+ (i + 1) +'</td>',
              '<td>'+ CORP_NAME +'</td>',
              '<td>'+ CORP_LOGO +'</td>',
              '<td>'+ REG_DATE +'</td>',
              '<td><a class="warn" href="javascript:;" style="cursor: pointer;" onClick="editCorp('+ ID +', \''+ CORP_NAME +'\')" ><i class="fa fa-pencil-square-o"></i> Edit </a><a class="danger" href="javascript:;" style="cursor: pointer;" onClick="deleteCorp('+ ID +', \''+ CORP_NAME +'\')"><i class="fa fa-times"></i> Delete</a></td>'
              );

          tableCorporate.row.add(jRow).draw();
				}
			}
			});

      var tableMerchant = $('#tableMerchant').DataTable();

      $.ajax({
        dataType: 'JSON',
        type: 'GET',
        url: '/administration/corporate_merchant/get_all_dataMerchant',
  			success: function (data) {
  				tableMerchant.clear().draw();

  				for (var j = 0; j < data.length; j++) {
            var FID = data[j].FID;
            var FMERCHNAME = data[j].FMERCHNAME;
            var CORP_NAME = data[j].CORP_NAME;
            var FMERCHLOGO = data[j].FMERCHLOGO;
            var FREG_DATE = data[j].FREG_DATE;
            var ID = data[j].ID;

            if(FREG_DATE == null)
            {
              FREG_DATE = '';
            }

            var jRow = $('<tr>').append(
              '<td>'+ (j + 1) +'</td>',
                '<td>'+ FMERCHNAME +'</td>',
                '<td>'+ CORP_NAME +'</td>',
                '<td>'+ FMERCHLOGO +'</td>',
                '<td>'+ FREG_DATE +'</td>',
                '<td><a class="warn" href="javascript:;" style="cursor: pointer;" onClick="editMerch(\''+ FID +'\', \''+ FMERCHNAME +'\',\''+ ID +'\')" ><i class="fa fa-pencil-square-o"></i> Edit </a> <a class="danger" href="javascript:;" style="cursor: pointer;" onClick="deleteMerch(\''+ FID +'\', \''+ FMERCHNAME +'\')"><i class="fa fa-times"></i> Delete</a></td>'

                );

            tableMerchant.row.add(jRow).draw();
  				}
  			}
  			});

  });

  function editCorp(id, val) {
    $('input[name="corporateId"]').val(id);
    $('input[name="corporateName"]').val(val);

    $('#editCorpModal').modal('show');
  }

  function editMerch(id, merch, corpid) {
    $("#editCorporateId2").val(corpid).trigger("change");
    $('input[name="editMerchId"]').val(id);
    $('input[name="editMerchName"]').val(merch);

      $('#editMerchModal').modal('show');
  }

  function deleteCorp(id, val) {
    //alert(val);
    $("#corporateNameSpan").html(val);

    var corporateIdDel = document.getElementById('corporateIdDel');

    corporateIdDel.value = id;
    //alert(user_id.value);

    $('#delCorpModal').modal('show');
  }

  function submitDelCorp(){
    $("#submitDelCorp").click();
  }

  function deleteMerch(id, val) {
    //alert(val);
    $("#merchNameSpan").html(val);

    var merchIdDel = document.getElementById('merchIdDel');

    merchIdDel.value = id;
    //alert(user_id.value);

      $('#delMerchModal').modal('show');
  }

  function submitDelMerch(){
    $("#submitDelMerch").click();
  }

  $(function ()
  {
        $(".corp").select2({
            placeholder: "Select Corporate",
            allowClear: true
        });
  });

  $.ajax({
    dataType: 'JSON',
    type: 'GET',
    url: '/corporate_data',
    success: function (data) {
      for(var i = 0; i < data.length; i++)
      {
        $("#corporateId-merch").append('<option value="' + data[i]['ID'] + '">' + data[i]['CORP_NAME'] + '</option>');
      }
    }
  });

  $.ajax({
    dataType: 'JSON',
    type: 'GET',
    url: '/corporate_data',
    success: function (data) {
      for(var i = 0; i < data.length; i++)
      {
        $("#editCorporateId2").append('<option value="' + data[i]['ID'] + '">' + data[i]['CORP_NAME'] + '</option>');
      }
    }
  });

</script>
@endsection
