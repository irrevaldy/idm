@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-check-square-o" aria-hidden="true"></i> Audit Trail
    </h1>
    <!-- <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Audit Trail</li>
    </ol> -->
  </section>

  <!-- Main content -->
  <section class="content">

  <div class="row">
    <div class="col-md-5">
      <div class="box box-primary box-table">
        <div class="box-body">
          <form action="audit-trail-filter.php" method="POST">
          <div class="col-md-8">

            <!-- Date range -->
            <div class="form-group">
              <label>Date</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right readonly" id="date" name="date" placeholder="Date" value="" required="required">
              </div><!-- /.input group -->
            </div><!-- /.form group -->
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-primary btnSubmit" id="btnSubmit"  >Submit</button>
            <button type="submit" id="true-button-insert" style="visibility: hidden;">Submit</button>

          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

      <!-- table user -->
      <div class="col-md-12">

        <div class="box box-primary box-table">
          <!-- <div class="export-box">
            <a class="btn btn-primary export-btn" href="form-add-user.php"> Add New User </a>
          </div> -->
          <div class="box-body">
            <table id="tableAuditTrail" class="table table-bordered table-striped">
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
      </div>
      <!-- end of table user -->

  </div> <!-- end of row -->

  </section><!-- /.content -->

</div><!-- /.content-wrapper -->

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
