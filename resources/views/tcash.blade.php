@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Tcash</strong></h2>
    </div>
    <div>Set Limit Tcash</div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="summaryTransaction_form" autocomplete="off" action="{{ route('tcash_setup') }}">
                  {{ csrf_field() }}
              <div class="form-group">
                <label class="col-sm-3 control-label">Store Code</label>
                <div class="col-sm-9">
                    <input class="form-control form-white" name="storeCode" id="store" type="text" placeholder="Select Bank">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Current Limit</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="currLimit" id="card_type" type="text" placeholder="Select Card Type">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">New Limit</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="newLimit" id="transaction_type" type="text" placeholder="Select Transaction Type" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-embossed" id="true-button-insert" >Save changes</button>
              <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit" style="visibility: hidden;">Generate Report</button>
              <a href="{{ route('summary_transaction') }}" class="btn btn-primary btn-embossed" style="visibility: hidden;">Download ZIP</a>
            </div>
              @if(isset($attrib))
              <div>
                Store Code berhasil diupdate
                </div>
                @endif
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
@endsection
