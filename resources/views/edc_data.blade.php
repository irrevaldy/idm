@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>EDC Data</strong></h2>
    </div>
    @if(!isset($attrib))
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="searchTransaction_form" autocomplete="off" action="{{ route('search_transaction_main') }}">
                  {{ csrf_field() }}
              <h4>Search SN</h4>
              <div class="export-box">
                        <a class="btn btn-primary export-btn deletes" data-toggle="modal" data-target="#addEdcModal"> Register New SN </a>
                      </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="exampleInputEmail1">SN</label><strong class="" id="silang_text" style="color: #FF5656;display: none;">SN is not found</strong><strong id="centang_text" style="color: #2AE800;display: none;"> is Exist</strong>
                <div class="input-group">

                  <input type="text" class="form-control" id="username" name="username" placeholder="SN" maxlength="30" required="required" onChange="checkUsername('username')" style="border-right: 0px;">
                  <div class="input-group-addon" id="addonBox" style="display:">
                    <i class="fa fa-spinner fa-pulse" id="spinner" style="color: #0055FF;display: none;"></i>
                    <i class="fa fa-check" id="centang" aria-hidden="true" style="color: #2AE800;display: none;"></i>
                    <i class="fa fa-times-circle" id="silang" aria-hidden="true" style="color: #FF0000;display: none;"></i>
                  </div>
                </div><!-- /.input group -->
              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-danger" id="delSn" onclick="deleteSnConfirm()" >Delete</button>
                <a class="btn btn-primary export-btn deletes" id="confirmDelete" data-toggle="modal" data-target="#delEdcModal" style="display: none;"> Delete </a>
                <button type="button" class="btn btn-primary btn-embossed" id="getSn"  onclick="getDataSn()">Search</button>
              </div>
            </form>
            <div class="box-footer" style="display: none;" id="footer">
              <ul>
                <li>
                  <span id="dataSnText">Data SN </span>
                </li>
              </ul>
            </div>
            <div class="box-footer" style="display: none;" id="deleteFooter">
              <ul>
              	<li>
              		<span id="deleteSnText">Delete SN</span>
              	</li>
              </ul>
          </div>
        </div>
  			</div>
      </div>
    </div>
    @elseif(isset($attrib))
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <p>
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <b>Corporate Name :</b> {{ $attrib->corporate }}
            </p><p>
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <b>Merchant Name :</b> {{ $attrib->merchant }}
            </p>
            <p>
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <b>Total EDC Existing :</b>
            </p>
            <p>
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <b>Total Data will be imported :</b> {{ $attrib->highestRow_count }}
            </p>
            <p>
              <i class="fa fa-circle-o" aria-hidden="true"></i>
              <b>Total error data :</b>
            </p>
            <div class="box-footer with-border" id="footerForm">
            <form role="form" action="process/import_edc.php" method="POST" autocomplete="off" enctype="multipart/form-data">
              <input type="text" name="merchant" value="<?php echo $attrib->corporate; ?>" style="display:none">
              <input type="text" name="target_file" value="<?php echo $attrib->storage_path; ?>" style="display:none">

              <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
              <a href="data-edc.php"><button type="button" class="btn btn-warning" style="float:right; margin-right: 5px;">Cancel</button></a>

              </form>
              <br>
              <br>
            </div><!-- /.box-header -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel">
        <div class="panel-content">
          <div class="form-group">
            <div class="panel-content pagination2 force-table-responsive" style="overflow-x: scroll;">
              <h3 class="box-title">List data from file</h3>
              <table class="table table-bordered" id="tableEdcData">
                <thead>
                  <tr>
                    <th>No</th>
                  @for ($i = 0; $i < count($attrib2); $i++)
                    <th>{{ $attrib2[$i] }}</th>
                      @endfor
                    <th>Status</th>
                  </tr>
                </thead>
              <!--  <tbody>
                  <tr>
                    <th>1</th>
                    @for ($i = 0; $i < count($attrib2); $i++)
                      <th>{{ $attrib2[$i] }}</th>
                        @endfor
                    <th>Status</th>
                      <tr>
                </tbody>-->
              </table>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
    @endif
<!--modal -->
    <div id="delEdcModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="closeDeleteModal" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Delete SN</h4>
          </div>
          <div class="modal-body">
            <p>SN <span id="modalSnText"></span> will be deleted, are you sure ?</p>
            <form style="display: none;" action="process/delete_user.php" method="POST"><input type="text" name="user_id" id="user_ids" /><input type="submit" id="submitUser"/></form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onClick="deleteDataSn()">Submit</button>
          </div>
        </div>

      </div>
    </div>

    <div class="modal fade" id="addEdcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-fax" aria-hidden="true"></i> Register New Edc </h4>
          </div>

          <!-- form profile -->
          <form role="form" id="upload_form" method="POST" action="/edc_data/upload_edc" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Corporate </label>
                    <input type="text" class="form-control" id="corporate" name="corporate">
                  </div><!-- /.form-group -->
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Merchant </label>
                    <input type="text" class="form-control" id="merchant" name="merchant">

                  </div><!-- /.form-group -->
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Excel File</label>
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

@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->

<script type = "text/javascript">

$(document).ready(function(){
  var tableEdcData = $('#tableEdcData').DataTable();

  $.ajax({
    dataType: 'JSON',
    type: 'GET',
    url: '/edc_data/get_edc_data',
    success: function (data) {
      tableEdcData.clear().draw();

      for (var i = 0; i < data.length; i++) {
        var a = data[i][1];
        var b = data[i][9];
        var c = data[i][10];
        var d = data[i][13];
        var e = data[i][14];
        var f = data[i][17];
        var g = data[i][18];
        var h = data[i][21];
        var ii = data[i][22];
        var j = data[i][25];
        var k = data[i][26];
        var l = data[i][30];
        var m = data[i][31];
        var n = data[i][32];
        var o = data[i][33];
        var p = data[i][34];
        var q = data[i][35];
        var r = data[i]['status'];


        var jRow = $('<tr>').append(
          '<td>'+ (i + 1) +'</td>',
            '<td>'+ a +'</td>',
            '<td>'+ b +'</td>',
            '<td>'+ c +'</td>',
            '<td>'+ d +'</td>',
            '<td>'+ e +'</td>',
            '<td>'+ f +'</td>',
            '<td>'+ g +'</td>',
            '<td>'+ h +'</td>',
            '<td>'+ ii +'</td>',
            '<td>'+ j +'</td>',
            '<td>'+ k +'</td>',
            '<td>'+ l +'</td>',
            '<td>'+ m +'</td>',
            '<td>'+ n +'</td>',
            '<td>'+ o +'</td>',
            '<td>'+ p +'</td>',
            '<td>'+ q +'</td>',
            '<td>'+ r +'</td>'
            );

        tableEdcData.row.add(jRow).draw();
      }
    }
    });

});

var dataSnText = document.getElementById("dataSnText");

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

function checkUsername(id){


  var u = document.getElementById(id)
  if(u.value != ''){

    spinner.style.display = "";
    $.ajax({
      type: 'POST',
      data: { username : username.value },
      url: "/edc_data/checkSN",
      cache: false,
      success: function(msg){

        //alert(msg);

        if(msg == "not") {
          spinner.style.display = "none";
          silang.style.display = "";
          silang_text.style.display = "";

          username.style.borderColor = "#FF5656";
          addonBox.style.borderColor = "#FF5656";

          username_txt = "exist";

          getSn_btn.disabled = true;
          delSn_btn.disabled = true;

          footer.style.display = "none";
          deleteFooter.style.display = "none";
        } else {
          spinner.style.display = "none";
          centang.style.display = "";

          username_txt = "not";

          $("#addonBox").addClass("blinkBorderOk");
          $("#username").addClass("blinkBorderOk");

          getSn_btn.disabled = false;
          delSn_btn.disabled = false;

          footer.style.display = "none";
          deleteFooter.style.display = "none";
        }

      }
    });

  }
}

var username = document.getElementById('username');
var addonBox = document.getElementById('addonBox');

username.onfocus = function() {
addonBox.style.borderColor = "#3c8dbc";
username.style.borderColor = "#3c8dbc";

spinner.style.display = "none";
silang.style.display = "none";
centang.style.display = "none";
silang_text.style.display = "none";

if ($(".blink")[0]){
    // Do something if class exists
    //alert('blink exist');
    $("#silang_text").removeClass("blink");
    $("#addonBox").removeClass("blinkBorder");
    $("#username").removeClass("blinkBorder");
}

$("#addonBox").removeClass("blinkBorderOk");
$("#username").removeClass("blinkBorderOk");
}

username.onblur = function(){
addonBox.style.borderColor = "#d2d6de";
username.style.borderColor = "#d2d6de";

//checkUsername('username');
}

function getDataSn() {
  //alert(username.value);

  $.ajax({
  type: 'POST',
  data: { username : username.value },
  url: "/edc_data/getSN",
  cache: false,
  success: function(data){

    var FMERCHNAME = data[0].FMERCHNAME;
    var FSN = data[0].FSN;
    var FMID = data[0].FMID;

    dataSnText.innerHTML = "Data SN found : </br> Merchant : "+ FMERCHNAME +" </br> SN : " + FSN + " </br> TID MID : " + FMID;

    footer.style.display = "";
    deleteFooter.style.display = "none";

  }
});
}

function deleteSnConfirm() {
  //alert(username.value);

  var modalSnText = document.getElementById('modalSnText');
  modalSnText.innerHTML = username.value;

  confirmDelete.click();

  /* */
}

function deleteDataSn() {
  $.ajax({
  type: 'POST',
  data: { username : username.value },
  url: "/edc_data/deleteSN",
  cache: false,
  success: function(data){


    if(data == 'sukses') {
      deleteFooter.style.display = "";
      footer.style.display = "none";
      deleteSnText.innerHTML = "Delete SN <b>" + username.value + "</b> sukses.";

      getSn.disabled = true;
      delSn.disabled = true;

      $('#delEdcModal').modal('hide');
    } else if(data == 'gagal') {
      deleteFooter.style.display = "";
      footer.style.display = "none";
      deleteSnText.innerHTML = "Delete SN <b>" + username.value + "</b> gagal.";

      $('#delEdcModal').modal('hide');
    } else {
      deleteSnText.innerHTML = "Error.";
      deleteFooter.style.display = "";
      footer.style.display = "none";

      $('#delEdcModal').modal('hide');
    }



  }
});

}



</script>
@endsection
