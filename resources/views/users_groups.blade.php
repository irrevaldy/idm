@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Users & Groups</strong></h2>
    </div>
    <div>Users</div>
    @if(isset($attrib))
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table" id="tableSearch" >
          <thead>
            <tr>
              <th>Username</th>
              <th>Name</th>
              <th>Group</th>
              <th>Host</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

            @foreach($attrib as $key => $value)
            <tr>
              <td>{{ $value->username }}</td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->groupName }}</td>
              <td>{{ $value->FNAME }}</td>
              <td>{{ $value->status }}</td>
              <tr>
                @endforeach
          </tbody>
        </table>
      </div>
      </div>
      @endif

      <div>Groups</div>
      @if(isset($attrib2))
      <div class="form-group">
        <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
          <table class="table" id="tableMerchant" >
            <thead>
              <tr>
                <!--<th>#</th>-->
                <th>Group Name</th>
                <th>Host</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>

              @foreach($attrib2 as $key => $value)
              <tr>
                <td>{{ $value->groupName }}</td>
                <td>{{ $value->FMERCHNAME }}</td>
                <td>{{ $value->status }}</td>
                <tr>
                  @endforeach
            </tbody>
          </table>
        </div>
        </div>
        @endif



@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->
@endsection
