@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Audit Trail</strong></h2>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">
            <form role="form" method="POST" class=" form-horizontal form-validation" id="searchTransaction_form" autocomplete="off" action="{{ route('search_audit_trail') }}">
                  {{ csrf_field() }}
              <div class="form-group">
                <label class="col-sm-3 control-label">Date</label>
                <div class="col-sm-9">
                  <input class="form-control form-white" name="date" id="date" type="text" placeholder="">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" id="true-button-insert" style="visibility: hidden;">Submit</button>
                <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit"  >Submit</button>
              </div>
              @if(isset($attrib))
              <div class="form-group">
                <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                  <table class="table" id="tableAuditTrail" >
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($attrib as $key => $value)
                      <tr>
                        <td>{{ $value->username }}</td>
                        <td>{{ $value->DATE }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->description }}</td>
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
@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->
@endsection
