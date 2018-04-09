@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-align-left" aria-hidden="true"></i> Summary Data
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Summary Data</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="animated flipInY col-md-3">
        <div class="tile-stats detBank top-primary">
          <div class="detBankIcon icon">
            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
          </div>
          <a href='#' onClick="callTransactionSummary()">
          <div class="count"><i class="fa fa-align-left" aria-hidden="true"></i></div>

          <h4><span>Transaction</span> Summary</h4>
          <p> </p>
          </a>
        </div>
      </div>

      <div class="animated flipInY col-md-3">
        <div class="tile-stats detCard top-primary">
          <div class="detCardIcon icon">
            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
          </div>
          <a href='#' onClick="callResponseCodeSummary()">
          <div class="count"><i class="fa fa-align-left" aria-hidden="true"></i></div>

          <h4><span>Response Code</span> Summary</h4>
          <p> </p>
          </a>
        </div>
      </div>
    </div>


    <div class="row " id="showTransaction" style="display:none">
      <div class="col-md-12 detailBankRow">
        <!-- first row -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-align-left"></i> Transaction Summary</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" onClick="callTransactionSummary()"><i class="fa fa-times" aria-hidden="true"></i></button>
                  <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
              </div><!-- /.box-header -->

              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                  <form id="summaryTransaction_form" method="POST">

                    <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bank</label>
                          <select class="form-control selectBank selectStore" name="bank_code" id="bank_code" style="width: 100%;" required="required">
                            <option></option>
                          </select>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Card Type</label>
                          <select class="form-control selectCard selectStore" name="card_type" id="card_type" style="width: 100%;" required="required">
                            <option></option>
                          </select>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Transaction Type</label>
                          <select class="form-control selectTrx selectStore" name="transaction_type" id="transaction_type" style="width: 100%;" required="required">
                            <option></option>
                            <option value="sale"> Sale </option>
                            <option value="prepaidTopUp"> Prepaid Top UP </option>
                            <option value="prepaidSale"> Prepaid Sale </option>
                          </select>
                        </div><!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Corporate</label>
                          <select class="form-control selectCorp selectStore" name="corporate" id="corporate" style="width: 100%;" required="required">
                            <option></option>

                          </select>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Status</label>
                          <select class="form-control selectStatus selectStore" name="statusa" id="statusa" style="width: 100%;" required="required">
                            <option></option>
                            <option value="s">Settled</option>
                            <option value="d">Declined</option>
                          </select>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Specified RC (Declined)</label>
                          <input class="form-control" name="specifiedrc" id="specifiedrc" type="text" placeholder="Response Code..." type="text" disabled>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1" id='detailHost'>Month</label>
                          <div class="input-group date">
                            <input type="text" name="month" id="month" class="form-control readonly" placeholder="Select Month" required="required" />
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="generate btn btn-primary" id="true-button-insert" >Generate Report</button>
                          <button type="button" class="generate btn btn-primary" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
                          <a href="{{ route('summary_transaction') }}" class="generate btn btn-primary" style="visibility: hidden;">Download ZIP</a>
                        </div>
                      </div>

                    </div> <!-- end of <div class="row"> -->
                  </form>
                  </div>

                </div>

              </div><!-- end of box body -->

              <div class="box-body" id="summaryTrx_div" style="border-top: 3px solid #3c8dbc; display:none">
                <div class="row">
                  <div class='col-md-12'>
                    <h4><i class='fa fa-align-left' aria-hidden='true'></i> Transaction Summary Detail</h4>
                    </div>
                </div>
                <table class="table table-bordered" id="tableSummary">
                  <thead>
                    <tr>
                      <th style='width: 20%'>Bank</th>
                      <th style='width: 40%'>Total Transaction</th>
                      <th style='width: 40%'>Total Amount</th>
                    </tr>
                  </thead>
                </table>
              </div>

              <div class="box-footer">

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of detailBankRow -->
    </div>

  <div class="row " id="showResponseCode" style="display:none">
      <div class="col-md-12 summaryRc">
        <!-- first row -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-align-left"></i> Response Code Summary</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" onClick="callResponseCodeSummary()"><i class="fa fa-times" aria-hidden="true"></i></button>
                  <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
              </div><!-- /.box-header -->

              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                  <form id="summaryResponseCode_form" method="POST">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Bank</label>
                          <select class="form-control selectBank selectStore" name="bank_code_rc" id="bank_code_rc" style="width: 100%;" required="required">
                            <option></option>
                          </select>
                        </div><!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Transaction Type</label>
                          <select class="form-control selectTrx selectStore" name="trx_type_rc" id="trx_type_rc" style="width: 100%;" required="required">
                            <option></option>
                            <option value="sale"> Sale </option>
                            <option value="prepaidTopUp"> Prepaid Top UP </option>
                            <option value="prepaidSale"> Prepaid Sale </option>
                          </select>
                        </div><!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Corporate</label>
                          <select class="form-control selectCorp selectStore" name="corp_id_rc" id="corp_id_rc" style="width: 100%;" required="required">
                            <option></option>
                          </select>

                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1" id='detailHost'>Month</label>
                          <div class="input-group date">
                            <input type="text" name="month_rc" id="month_rc" class="form-control readonly" placeholder="Select Month" required="required" />
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" class="generate btn btn-primary" id="true-button-insert" >Generate Report</button>
                          <button type="button" class="generate btn btn-primary" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
                          <a href="{{ route('summary_response_code') }}" class="generate btn btn-primary" style="visibility: hidden;">Download ZIP</a>

                        </div>
                      </div>

                    </div>
                  </form>
                  </div>
                </div> <!-- end of <div class="row"> -->

              </div><!-- end of box body -->

              <div class="box-body" id="summaryRc_div" style="border-top: 3px solid #3c8dbc; display:none">
                <div class="row">
                  <div class='col-md-12'>
                    <h4><i class='fa fa-align-left' aria-hidden='true'></i> Top 5 RC Declined</h4>
                    </div>
                </div>
                <table class="table table-bordered" id="tableRc">
                  <thead>
                    <tr>
                      <th style='width: 20%'>Response Code</th>
                      <th style='width: 40%'>Total Transaction</th>
                      <th style='width: 40%'>Total Amount</th>
                    </tr>
                  </thead>
                </table>
              </div>



              <div class="box-footer">

              </div>

            </div>
          </div>
        </div>
      </div><!-- end of summaryRc -->

    </div> <!-- end of row -->
  </section>

</div><!-- /.content-wrapper -->


@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->

<script>
function callTransactionSummary() {
    var x = document.getElementById("showTransaction");
    var y = document.getElementById("showResponseCode");
    if (x.style.display === "none" ) {
        x.style.display = "block";
        y.style.display = "none";
    } else {
        x.style.display = "none";
        y.style.display = "none";
    }
}
function callResponseCodeSummary() {
    var y = document.getElementById("showResponseCode");
    var x = document.getElementById("showTransaction");
    if (y.style.display === "none") {
        y.style.display = "block";
        x.style.display = "none";
    } else {
        y.style.display = "none";
        x.style.display = "none";
    }
}

$(function ()
{
      $(".selectBank").select2({
          placeholder: "Select Bank",
          allowClear: true
      });
      $(".selectCard").select2({
          placeholder: "Select Card",
          allowClear: true
      });
      $(".selectTrx").select2({
          placeholder: "Select Transaction Type",
          allowClear: true
      });
      $(".selectStatus").select2({
          placeholder: "Select Status",
          allowClear: true
      });
      $(".selectCorp").select2({
          placeholder: "Select Corporate",
          allowClear: true
      });
      $('.input-group.date').datepicker({
          autoclose: true,
          todayHighlight: true,
          format: "mm/yyyy",
          orientation: 'auto',
          minViewMode: 1
        });
});

$(function(){
    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/bank_data',
      success: function (data) {
        for(var i = 0; i < data.length; i++)
        {
          $("#bank_code").append('<option value="' + data[i]['FCODE'] + '">' + data[i]['FNAME'] + '</option>');
        }
      }
    });

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/card_data',
      success: function (data) {
        for(var i = 0; i < data.length; i++)
        {
          $("#card_type").append('<option value="' + data[i]['FCARDTYPE'] + '">' + data[i]['FCARDTYPEDESC'] + '</option>');
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
          $("#corporate").append('<option value="' + data[i]['ID'] + '">' + data[i]['CORP_NAME'] + '</option>');
        }
      }
    });

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/bank_data',
      success: function (data) {
        for(var i = 0; i < data.length; i++)
        {
          $("#bank_code_rc").append('<option value="' + data[i]['FCODE'] + '">' + data[i]['FNAME'] + '</option>');
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
          $("#corp_id_rc").append('<option value="' + data[i]['ID'] + '">' + data[i]['CORP_NAME'] + '</option>');
        }
      }
    });

    // trxSummary_form
  });

  $("#summaryTransaction_form").submit(function(e) {

    var x = document.getElementById("summaryTrx_div");
    x.style.display = "block";

      e.preventDefault();

      var tableSummary = $('#tableSummary').DataTable();

      $.ajax({
        type: 'POST',
        data: { bank_code : $('#bank_code option:selected').val(),
                card_type : $('#card_type option:selected').val(),
                transaction_type : $('#transaction_type option:selected').val(),
                corporate : $('#corporate option:selected').val(),
                statusa : $('#statusa option:selected').val(),
                specifiedrc : $('#specifiedrc').val(),
                month : $('#month').val()
              },
        url: '/report/summary/transaction',
          success: function(data){

          // var data = JSON.parse(msg);

          //$('#summaryTrx_div').html(msg);

          //$('#summaryTrx_div').html(data.FNAME + '-' + data.totalTrx + '-' + data.totalAmount);
          tableSummary.clear().draw();

          for (var i = 0; i < data.length; i++)
          {

            var fname = data[i]['FNAME'];
            var totaltrx = data[i]['totalTrx'];
            var totalamount = data[i]['totalAmount'];


              var jRow = $('<tr>').append(
                  '<td>'+ fname +'</td>',
                  '<td>'+ totaltrx +'</td>',
                  '<td>'+ totalamount +'</td>',

                  );
              tableSummary.row.add(jRow).draw();
            }
        }

      });

  });

  $("#summaryResponseCode_form").submit(function(e) {

    var x = document.getElementById("summaryRc_div");
    x.style.display = "block";

      e.preventDefault();

      var tableRc = $('#tableRc').DataTable();

      $.ajax({
        type: 'POST',
        data: { bank_code_rc : $('#bank_code_rc option:selected').val(),
                trx_type_rc : $('#trx_type_rc option:selected').val(),
                corp_id_rc : $('#corp_id_rc option:selected').val(),
                month_rc : $('#month_rc').val()
              },
        url: '/report/summary/responsecode',
          success: function(data){

          // var data = JSON.parse(msg);

          //$('#summaryTrx_div').html(msg);

          //$('#summaryTrx_div').html(data.FNAME + '-' + data.totalTrx + '-' + data.totalAmount);
          tableRc.clear().draw();

          for (var i = 0; i < data.length; i++)
          {

            var frespcode = data[i]['FRESPCODE'];
            var totaltrx = data[i]['totalTrx'];
            var totalamount = data[i]['totalAmount'];


              var jRow = $('<tr>').append(
                  '<td>'+ frespcode +'</td>',
                  '<td>'+ totaltrx +'</td>',
                  '<td>'+ totalamount +'</td>',

                  );
              tableRc.row.add(jRow).draw();
            }
        }

      });

  });

</script>
@endsection
