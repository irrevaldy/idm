@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Search Transaction</strong></h2>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="searchTransaction_form" autocomplete="off">
                  {{ csrf_field() }}
              <h4>Search by Filter:</h4>
              <div class="form-group">
                <label class="col-sm-3 control-label">Store Code</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="store_code" id="store_code" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Branch Code</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="branch_code" id="branch_code" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Host</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="host" id="host" type="text" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Transaction Type</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="transaction_type" id="transaction_type" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Prepaid Card Number</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="prepaid_card_number" id="prepaid_card_number" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Approval Code</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="approval_code" id="approval_code" type="text" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">MID</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="mid" id="mid" type="text" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">TID</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="tid" id="tid" type="text" placeholder="">
                </div>
              </div>
                <div class="form-group">
                <label class="col-sm-3 control-label">Transaction Date</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="transaction_date" id="transaction_date" type="text" placeholder="" required>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit" onclick="summonTable()" >Submit</button>
              </div>

              <div class="form-group">
                <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                  <table class="table table-bordered" id="tableSearch">
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
                  </table>
                </div>
                </div>
            </form>
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



<script type="text/javascript">
$("#btnSubmit").click(function(e)
{

  e.preventDefault();

  var tableSearch = $('#tableSearch').DataTable();

  $('.btn-primary').prop('disabled', true);

  $.ajax({
        type: 'POST',
        data: {
          store_code          : $('input[name="store_code"]').val(),
          branch_code         : $('input[name="branch_code"]').val(),
          host                : $('input[name="host"]').val(),
          transaction_type    : $('input[name="transaction_type"]').val(),
          prepaid_card_number : $('input[name="prepaid_card_number"]').val(),
          approval_code       : $('input[name="approval_code"]').val(),
          mid                 : $('input[name="mid"]').val(),
          tid                 : $('input[name="tid"]').val(),
          transaction_date    : $('input[name="transaction_date"]').val()
          // ,ModifiedBy        : "ADMIN"
        },
        //headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/search_transaction/main_data',
        success: function (data)
        {
              tableSearch.clear().draw();

              for (var i = 0; i < data.length; i++)
              {

                var fname = data[i]['FNAME'];
                var fmid = data[i]['FMID'];
                var ftid = data[i]['FTID'];
                var fbranchcode = data[i]['FBRANCHCODE'];
                var fstorecode = data[i]['FSTORECODE'];
                var ftrx_label = data[i]['FTRX_LABEL'];
                var fcardnum = data[i]['FCARDNUM'];
                var fprepaidcardnum = data[i]['FPREPAIDCARDNUM'];
                var finvnum = data[i]['FINVNUM'];
                var fdate = data[i]['FDATE'];
                var ftime  = data[i]['FTIME'];
                var frespcode = data[i]['RESPCODE'];
                var fstatus = data[i]['FSTATUS'];
                var fapprcode = data[i]['FAPPRCODE'];
                var famount = data[i]['FAMOUNT'];
                var fredeem = data[i]['FREDEEM'];
                var fnet = data[i]['FNET'];

                  var jRow = $('<tr>').append(
                      '<td>'+ fname +'</td>',
                      '<td>'+ fmid +'</td>',
                      '<td>'+ ftid +'</td>',
                      '<td>'+ fbranchcode +'</td>',
                      '<td>'+ fstorecode +'</td>',
                      '<td>'+ ftrx_label +'</td>',
                      '<td>'+ fcardnum +'</td>',
                      '<td>'+ fprepaidcardnum +'</td>',
                      '<td>'+ finvnum +'</td>',
                      '<td>'+ fdate +'</td>',
                      '<td>'+ ftime +'</td>',
                      '<td>'+ frespcode +'</td>',
                      '<td>'+ fstatus +'</td>',
                      '<td>'+ fapprcode +'</td>',
                      '<td>'+ famount +'</td>',
                      '<td>'+ fredeem +'</td>',
                      '<td>'+ fnet +'</td>',
                      );
                  tableSearch.row.add(jRow).draw();
                }
        }
      });

    $('.btn-primary').prop('disabled', false);
  });

</script>
@endsection
