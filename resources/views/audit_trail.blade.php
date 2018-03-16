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
              <div class="form-group">
                <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                  <table class="table" id="tableAuditTrail" >
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Description</th>
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
<script type="text/javascript">
  $(document).ready(function(){
    var tableAuditTrail = $('#tableAuditTrail').DataTable();

    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/audit_trail/get_all_data',
			success: function (data) {
				tableAuditTrail.clear().draw();

				for (var i = 0; i < data.length; i++) {
          var username = data[i].username;
          var date = data[i].DATE;
          var name = data[i].name;
          var description = data[i].description;

          var jRow = $('<tr>').append(
            '<td>'+ (i + 1) +'</td>',
              '<td>'+ username +'</td>',
              '<td>'+ date +'</td>',
              '<td>'+ name +'</td>',
              '<td>'+ description +'</td>'
              );

          tableAuditTrail.row.add(jRow).draw();
				}
			}
			});
  });
</script>
<!-- END PAGE SCRIPTS -->
<!--function initTable(){
  var tableAuditTrail = $('#tableAuditTrail').DataTable();

        $.ajax({
        dataType: 'JSON',
        type: 'POST',
        url: '/audit_trail',
        success: function (data) {

            tableAuditTrail.clear().draw();

            if(data['success'] == TRUE) {

              data = data['result'];

              for (var i = 0; i < data.length; i++) {

                var username = data[i].username;
                var date = data[i].DATE;
                var name = data[i].name;
                var description = data[i].description;


                var jRow = $('<tr>').append(
                    '<td>'+ username +'</td>',
                    '<td>'+ date +'</td>',
                    '<td>'+ name +'</td>',
                    '<td>'+ description +'</td>'
                    );
                tableAuditTrail.row.add(jRow).draw();
              }
            } // end if(data['status'] == '#SUCCESS')
            else {

              console.log("Query Exception, Please Check Database");
            }
        }

    });


initTable();
</script>-->

@endsection
