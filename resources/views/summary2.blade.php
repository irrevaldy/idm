@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Summary</strong></h2>
    </div>
    <button onclick="callTransactionSummary()">Transaction Summary</button>
    <button onclick="callResponseCodeSummary()">Response Code Summary</button>

<div id="showTransaction" style="display:none">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel">
        <div class="panel-content">
          <form role="form" method="POST" class=" form-horizontal form-validation" id="summaryTransaction_form" autocomplete="off" action="{{ route('summary_transaction') }}">
                {{ csrf_field() }}
            <div class="form-group">
              <label class="col-sm-3 control-label">Bank</label>
              <div class="col-sm-9">
                <select class="form-control selectBank selectStore" name="bank_code" id="bank_code" style="width: 100%;" required="required">
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Card Type</label>
              <div class="col-sm-9">
                <select class="form-control selectCard selectStore" name="card_type" id="card_type" style="width: 100%;" required="required">
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Transaction Type</label>
              <div class="col-sm-9">
                <select class="form-control selectTrx selectStore" name="transaction_type" id="transaction_type" style="width: 100%;" required="required">
                  <option></option>
                  <option value="sale"> Sale </option>
                  <option value="prepaidTopUp"> Prepaid Top UP </option>
                  <option value="prepaidSale"> Prepaid Sale </option>
                </select>    </div>
          </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Corporate</label>
              <div class="col-sm-9">
                <select class="form-control selectCorp selectStore" name="corporate" id="corporate" style="width: 100%;" required="required">
                  <option></option>

                </select>
            </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Status</label>
              <div class="col-sm-9">
                <select class="form-control selectStatus selectStore" name="statusa" id="statusa" style="width: 100%;" required="required">
                  <option></option>
                  <option value="s">Settled</option>
                  <option value="d">Declined</option>
                </select>  </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Specified RC (Declined)</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="specifiedrc" id="specifiedrc" type="text" placeholder="Select Specified RC">
            </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Month</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="month" id="month" type="text" placeholder="Select Month" required>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-embossed" id="true-button-insert" >Generate Report</button>
              <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
              <a href="{{ route('summary_transaction') }}" class="btn btn-primary btn-embossed" style="visibility: hidden;">Download ZIP</a>
            </div>
            @if(isset($attrib))
            <div class="form-group">
              <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                <table class="table" id="tableSearch" >
                  <thead>
                    <tr>
                      <th>Bank</th>
                      <th>Total Transaction</th>
                      <th>Total Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($attrib as $key => $value)
                    <tr>
                      <td>{{ $value->FNAME }}</td>
                      <td>{{ $value->totalTrx }}</td>
                      <td>{{ $value->totalAmount }}</td>
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
</div>

<div id="showResponseCode" style="display:none">
  <div class="row">
    <div class="col-lg-12">
      <div class="panel">
        <div class="panel-content">
          <form role="form" method="POST" class=" form-horizontal form-validation" id="summaryResponseCode_form" autocomplete="off" action="{{ route('summary_response_code') }}">
                {{ csrf_field() }}
            <div class="form-group">
              <label class="col-sm-3 control-label">Bank</label>
              <div class="col-sm-9">
                <select class="form-control selectBank selectStore" name="bank_code_rc" id="bank_code_rc" style="width: 100%;" required="required">
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Transaction Type</label>
              <div class="col-sm-9">
                <select class="form-control selectTrx selectStore" name="trx_type_rc" id="trx_type_rc" style="width: 100%;" required="required">
                  <option></option>
                  <option value="sale"> Sale </option>
                  <option value="prepaidTopUp"> Prepaid Top UP </option>
                  <option value="prepaidSale"> Prepaid Sale </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Corporate</label>
              <div class="col-sm-9">
                <select class="form-control selectCorp selectStore" name="corp_id_rc" id="corp_id_rc" style="width: 100%;" required="required">
                  <option></option>
                </select></div>
          </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Month</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="month" id="month" type="text" placeholder="Select Month" required>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-embossed" id="true-button-insert" >Generate Report</button>
              <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
              <a href="{{ route('summary_response_code') }}" class="btn btn-primary btn-embossed" style="visibility: hidden;">Download ZIP</a>
            </div>
            @if(isset($attrib2))
            <div class="form-group">
              <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                <table class="table" id="tableSearch" >
                  <thead>
                    <tr>
                      <th>Response Code</th>
                      <th>Total Transaction</th>
                      <th>Total Amount</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($attrib2 as $key => $value)
                    <tr>
                      <td>{{ $value->FRESPCODE }}</td>
                      <td>{{ $value->totalTrx }}</td>
                      <td>{{ $value->totalAmount }}</td>
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
</div>





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


  });

</script>
@endsection
