@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Transaction Report</strong></h2>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="transactionReport_form" autocomplete="off" action="{{ route('transaction_report') }}">
                  {{ csrf_field() }}
              <div class="form-group">
                <label class="col-sm-3 control-label">Branch</label>
                <div class="col-sm-9">
                    <input class="form-control form-white" type="hidden" name="code" value="{{ session('FCODE') }}" />
                  <input class="form-control form-white" name="branch_code" id="branch_code" type="text" placeholder="Select Branch">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Range</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="range" id="range" type="text" placeholder="Select Range">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">From Date</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="date" id="date" type="text" placeholder="Select Date" required>
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-embossed" id="true-button-insert" >Generate Report</button>
                <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
                <a href="{{ route('transaction_report') }}" class="btn btn-primary btn-embossed" style="visibility: hidden;">Download ZIP</a>
              </div>
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
$("transactionReport_form").submit(function(e) {
  // needed so the default action isn't called
  //(in this case, regulary submit the form)

  $(this).attr('action', 'transaction_report');


});
</script>
@endsection
