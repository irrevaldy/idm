@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>EDC Data</strong></h2>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="searchTransaction_form" autocomplete="off" action="{{ route('search_transaction_main') }}">
                  {{ csrf_field() }}
              <h4>Search SN</h4>
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

    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="searchTransaction_form" autocomplete="off" action="{{ route('search_transaction_main') }}">
                  {{ csrf_field() }}
              <h4>Register New SN</h4>
                <h4>Register New EDC</h4>
              <div class="form-group">
                <label class="col-sm-3 control-label">Corporate</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="corporate" id="corporate" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Merchant</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="merchant" id="merchant" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Excel File</label>
                <div class="input-group input-group-sm">
                  <input type="file" name="uploadedfile" id="logoBrowse" style="display:none;" onChange="setFileName()">
                  <input type="text" class="form-control" readonly="readonly" id="logoText">
                  <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" id="browseFile" type="button" onclick="$('#logoBrowse').click();">Browse</button>
                  </span>
                </div><!-- /input-group -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-embossed" id="btnDelete" style="background-color:red" >Delete</button>
                <button type="submit" id="true-button-insert" style="visibility: hidden;">Submit</button>
                <button type="button" class="btn btn-primary btn-embossed" id="a" >Search</button>
              </div>
              @if(isset($attrib))
              <div class="form-group">
                <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                  <table class="table" id="tableSearch" >
                    <thead>
                      <tr>
                        <th>Host</th>
                        <th>MID</th>
                        <th>TID</th>
                        <th>Branch</th>
                        <th>Store</th>
                        <th>Transaction</th>
                        <th>Card Num</th>
                        <th>Prepaid Card Num</th>
                        <th>Inv Num</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>RC</th>
                        <th>Status</th>
                        <th>APPR Code</th>
                        <th>Amount</th>
                        <th>Redeem</th>
                        <th>Net</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($attrib as $key => $value)
                      <tr>
                        <td>{{ $value->FNAME }}</td>
                        <td>{{ $value->FMID }}</td>
                        <td>{{ $value->FTID }}</td>
                        <td>{{ $value->FBRANCHCODE }}</td>
                        <td>{{ $value->FSTORECODE }}</td>
                        <td>{{ $value->FTRX_LABEL }}</td>
                        <td>{{ $value->FCARDNUM }}</td>
                        <td>{{ $value->FPREPAIDCARDNUM }}</td>
                        <td>{{ $value->FINVNUM }}</td>
                        <td>{{ $value->FDATE }}</td>
                        <td>{{ $value->FTIME }}</td>
                        <td>{{ $value->FRESPCODE }}</td>
                        <td>{{ $value->FSTATUS }}</td>
                        <td>{{ $value->FAPPRCODE }}</td>
                        <td>{{ $value->FAMOUNT }}</td>
                        <td>{{ $value->FREDEEM }}</td>
                        <td>{{ $value->NET }}</td>
                        <tr>
                          @endforeach
                    </tbody>
                  </table>
                </div>
                </div>
                @endif
            </form>
          </div>
        </div>
      </div>
    </div>

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

@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->

<script type = "text/javascript">

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
