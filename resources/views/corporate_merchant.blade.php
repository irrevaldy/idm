@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Corporate & Merchant</strong></h2>
    </div>

    <div>Corporate</div>
    <div class="form-group">
      <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
        <table class="table" id="tableCorporate" >
          <thead>
            <tr>
              <th>#</th>
              <th>Corporate Name</th>
              <th>Merchant Logo</th>
              <th>Register Date</th>
            </tr>
          </thead>

        </table>
      </div>
      </div>

      <div>Merchant</div>
      <div class="form-group">
        <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
          <table class="table" id="tableMerchant" >
            <thead>
              <tr>
                <th>#</th>
                <th>Merchant Name</th>
                <th>Corporate</th>
                <th>Merchant Logo</th>
                <th>Register Date</th>
              </tr>
            </thead>
            </table>
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
  $(document).ready(function(){
    var tableCorporate = $('#tableCorporate').DataTable();

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/administration/users_groups/get_all_dataCorporate',
			success: function (data) {
				tableCorporate.clear().draw();

				for (var i = 0; i < data.length; i++) {
          var CORP_NAME = data[i].CORP_NAME;
          var CORP_LOGO = data[i].CORP_LOGO;
          var REG_DATE = data[i].REG_DATE;

          var jRow = $('<tr>').append(
            '<td>'+ (i + 1) +'</td>',
              '<td>'+ CORP_NAME +'</td>',
              '<td>'+ CORP_LOGO +'</td>',
              '<td>'+ REG_DATE +'</td>',
                );

          tableCorporate.row.add(jRow).draw();
				}
			}
			});

      var tableMerchant = $('#tableMerchant').DataTable();

      $.ajax({
        dataType: 'JSON',
        type: 'GET',
        url: '/administration/users_groups/get_all_dataMerchant',
  			success: function (data) {
  				tableMerchant.clear().draw();

  				for (var i = 0; i < data.length; i++) {
            var FMERCHNAME = data[i].FMERCHNAME;
            var CORP_NAME = data[i].CORP_NAME;
            var FMERCHLOGO = data[i].FMERCHLOGO;
            var FREG_DATE = data[i].FREG_DATE;

            var jRow = $('<tr>').append(
              '<td>'+ (i + 1) +'</td>',
                '<td>'+ FMERCHNAME +'</td>',
                '<td>'+ CORP_NAME +'</td>',
                '<td>'+ FMERCHLOGO +'</td>',
                '<td>'+ FREG_DATE +'</td>'
                );

            tableMerchant.row.add(jRow).draw();
  				}
  			}
  			});

  });
</script>
@endsection
