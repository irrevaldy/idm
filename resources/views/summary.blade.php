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
                  <input class="form-control form-white" name="bank_code" id="bank_code" type="text" placeholder="Select Bank">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Card Type</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="card_type" id="card_type" type="text" placeholder="Select Card Type">
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
                <input class="form-control form-white" name="corporate" id="corporate" type="text" placeholder="Select Corporate" required>
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
                  <input class="form-control form-white" name="bank_code" id="bank_code" type="text" placeholder="Select Bank">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Transaction Type</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="transaction_type" id="transaction_type" type="text" placeholder="Select Transaction Type">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Corporate</label>
              <div class="col-sm-9">
                <input class="form-control form-white" name="corporate" id="corporate" type="text" placeholder="Select Corporate" required>
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
</script>
@endsection
