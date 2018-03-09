@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Corporate & Merchant</strong></h2>
    </div>

    <div>Corporate</div>
    @if(isset($attrib))
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table" id="tableCorporate" >
          <thead>
            <tr>
              <!--<th>#</th>-->
              <th>Corporate Name</th>
              <th>Merchant Logo</th>
              <th>Register Date</th>
            </tr>
          </thead>
          <tbody>

            @foreach($attrib as $key => $value)
            <tr>
              <td>{{ $value->CORP_NAME }}</td>
              <td>{{ $value->CORP_LOGO }}</td>
              <td>{{ $value->REG_DATE }}</td>
            <tr>
                @endforeach
          </tbody>
        </table>
      </div>
      </div>
      @endif

      <div>Merchant</div>
      @if(isset($attrib2))
      <div class="form-group">
        <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
          <table class="table" id="tableMerchant" >
            <thead>
              <tr>
                <!--<th>#</th>-->
                <th>Merchant Name</th>
                <th>Corporate</th>
                <th>Merchant Logo</th>
                <th>Register Date</th>
              </tr>
            </thead>
            <tbody>

              @foreach($attrib2 as $key => $value)
              <tr>
                <td>{{ $value->FMERCHNAME }}</td>
                <td>{{ $value->CORP_NAME }}</td>
                <td>{{ $value->FMERCHLOGO }}</td>
                <td>{{ $value->FREG_DATE }}</td>
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
