@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-volume-control-phone"></i> TCash <a class="btn btn-primary export-btn" data-toggle="modal" data-target="#tcashLimitModalNew"> Set limit Tcash</a>
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaction Report</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-primary box-table" style="display: none;">
      <div class="export-box">
        <a class="btn btn-primary export-btn" data-toggle="modal" data-target="#tcashLimitModalNew"> Set limit Tcash</a>
      </div>

      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th id="nums">#</th>
              <th>SN</th>
              <th>Branch</th>
              <th>Store</th>
              <th>Merchant Name</th>
              <th>Address 1</th>
              <th>Address 2</th>
              <th>Address 3</th>
              <th>Top Up Limit</th>
              <th>Top Up Balance</th>
            </tr>
          </thead>

          <style type="text/css">
            tfoot {
              background: #f9f9f9;
            }
            tfoot th:first-child {
              text-align: right;
            }
          </style>

        </table>
      </div>
    </div>

  </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<div class="modal fade" id="tcashLimitModalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-level-down" aria-hidden="true"></i> Set limit Tcash </h4>
      </div>

      <!-- form profile -->
      <form autocomplete="off">
      <div class="modal-body">

        <div class="box-body">
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Store Code <span id="notFound"> <i class="fa fa-times" aria-hidden="true"></i> not found</span></label>
                <input type="text" name="storeCode" id="storeCode" class="form-control" placeholder="store code" maxlength="50" required="required">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Current Limit</label>
                <input type="number" name="currLimit" id="currLimit" class="form-control" value='0' placeholder="current limit" maxlength="50" readonly>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">New Limit</label>
                <input type="number" name="newLimit" id="newLimit" class="form-control" placeholder="new limit" maxlength="50" required="required">
              </div>
            </div>

          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="display: none;" id="submitBtnLimit">Save changes</button>
      <div class="modal-footer">

        <button type="button" class="btn btn-warning" data-dismiss="modal" id="closeLimit">Close</button>
<<<<<<< HEAD
        <button type="button" class="btn btn-primary" id="submitModalNew">Save changes</button>
=======
        <button type="submit" class="btn btn-primary" id="submitModalNew">Save changes</button>
>>>>>>> 53713b0ecfec0fb38482eaa60f55317dcbf2786e

        </div>



        @if(isset($attrib))
        <div>
          Store Code berhasil diupdate
          </div>
          @endif


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

<script type="text/javascript">
function exp(){
  var collapseButton = document.getElementById('collapseButton');
  collapseButton.click();
}

$("input[name='storeCode']").change(function() {

  var storeCode = $("input[name='storeCode']").val();

  if(storeCode != '') {

<<<<<<< HEAD


      $.ajax({
        type: 'POST',
        data: {
          code: storeCode,
        },
        url: '/tcash/checkLimit',
        success: function (data) {

          //var json = JSON.parse(data);
          console.log(data['status']);

          if(data['status'] == 'found') {
            $("input[name='currLimit']").val( data['limit'] );

            $("input[name='storeCode']").css({"border": "1px solid #d2d6de", "background-color": "#fff"});
            $("#notFound").css({"display": "none"});
            $('#submitModalNew').prop('disabled', false);
          } else {
            $("input[name='currLimit']").val( data['limit'] );

            $("input[name='storeCode']").css({"border": "1px solid #FF5656", "background-color": "#FFDBDB"});
            $("#notFound").css({"display": "inline"});
            $('#submitModalNew').prop('disabled', true);
          }

        }
      });
=======
    $.ajax({
      type: 'POST',
      data: {
        code: storeCode
        // ,ModifiedBy        : "ADMIN"
      },
      //headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
      url: '/tcash/checklimit',
      success: function (data)
      {
        var limit = data[0]['limit'];

        if(data['success'] == true) {
          $("input[name='currLimit']").val( limit );

          $("input[name='storeCode']").css({"border": "1px solid #d2d6de", "background-color": "#fff"});
          $("#notFound").css({"display": "none"});
          $('#submitModalNew').prop('disabled', false);
        } else {
          $("input[name='currLimit']").val( limit );

          $("input[name='storeCode']").css({"border": "1px solid #FF5656", "background-color": "#FFDBDB"});
          $("#notFound").css({"display": "inline"});
          $('#submitModalNew').prop('disabled', true);
        }
      }
    });
>>>>>>> 53713b0ecfec0fb38482eaa60f55317dcbf2786e

  } else {

    $("input[name='currLimit']").val('0');

  }

});

<<<<<<< HEAD
$('#submitModalNew').click(function() {

  var storeCode = $("input[name='storeCode']").val()
  var newLimit = $("input[name='newLimit']").val();

  if(storeCode == '' || newLimit == '') {

    $('#submitBtnLimit').click();

  } else {

    $.ajax({
      type: "POST",
      url: "/tcash/setlimit",
      data: {
        code: storeCode,
        limit: newLimit
        }
      }).done(function( msg ) {

        //alert( msg );

      if(msg == 'sukses')
      {
        messg.info('<i class="fa fa-check"></i> Update Tcash Limit Success', 3500);
        $('#tcashLimitModalNew').modal('hide');
        $('#nums').click();

      } else {
        messg.error('<i class="fa fa-times"></i> Update Tcash Limit Failed', 3500);
      }

    });
  }


});


=======
>>>>>>> 53713b0ecfec0fb38482eaa60f55317dcbf2786e
</script>

@endsection
