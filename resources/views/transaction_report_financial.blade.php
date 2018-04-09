@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-archive" aria-hidden="true"></i> Transaction Report (Financial)</h1>
    <!-- <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Generate Report</li>
    </ol> -->
  </section>

  <section class="content">
    <div class="row ">

      <!-- check if privilege (detail report by bank) is exist -->
      <div class="col-md-12 detailBankRow">
        <!-- first row -->
        <div class="row">
          <div class="col-md-8">
            <div class="box box-primary">
              <div class="box-body">
                  <form id="transactionReportFinancial_form" action="{{ route('transaction_report_financial') }}" method="POST">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Branch</label>
                          @if(Session::get('branch_code') == '')
                          <select class="form-control select2 selectBranch" name="branch_code" id="branch_code" style="width: 100%;" required>
                            <option value=""></option>
                              @if(Session::get('branch_code') == '')
                              <option value='AllBranch'> All Branch </option>
                              @endif
                          </select>
                          @else
                          <input type="text" class="form-control readonly" value="{{ Session::get('branch_code') }}" />
                          <input type="hidden" name="branch_code" value="{{ Session::get('branch_code') }}">
                          @endif
                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Range</label>
                          <select class="form-control select2 selectRange" name="range" id="range"  required="required" onChange="switchtoMonth(this, '', 'detailHost')">
                            <option></option>
                            <option value="d"> 1 Day </option>
                            <option value="w"> 1 Week </option>
                            <option value="m"> 1 Month </option>
                          </select>
                        </div><!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1" id='reconDate'>From Date</label>
                          <div class="input-group date">
                            <input type="text" name="date" id="date" class="form-control readonly" placeholder="Select Date" required="required" />
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="Submit" class="generate btn btn-primary" id="exampleInputEmail1" value="Generate Report">
                        </div>
                      </div>

                    </div>
                  </form>


              </div><!-- end of box body -->

              <style type="text/css">
              .generate {
                margin-top: 25px;
              }
              </style>

              <div class="box-footer">

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of detailBankRow -->




    </div> <!-- end of row -->
  </section>

</div><!-- /.content-wrapper -->

@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->
<script>
$("transactionReportFinancial_form").submit(function(e) {
  // needed so the default action isn't called
  //(in this case, regulary submit the form)

  $(this).attr('action', 'transaction_report_financial');


});

$(function ()
{
      $(".selectBranch").select2({
          placeholder: "Select Branch Code",
          allowClear: true
      });

       $(".selectRange").select2({
           placeholder: "Select Range",
           allowClear: true
       });
});

//select host
$(function(){
    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/branch_data',
      success: function (data) {
        for(var i = 0; i < data.length; i++)
        {
          $("#branch_code").append('<option value="' + data[i]['FBRANCHCODE'] + '">' + data[i]['FBRANCHCODE'] + '</option>');
        }
      }
    });


  });

</script>
@endsection
