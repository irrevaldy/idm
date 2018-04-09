@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header">
    <h1>
      <i class="fa fa-cogs" aria-hidden="true"></i> Transaction Report
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Generate Report</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="animated flipInY col-md-3">
        <div class="tile-stats detBank top-primary">
          <div class="detBankIcon icon">
            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
          </div>
          <a href='#' onClick="activate()">
          <div class="count"><i class="fa fa-building" aria-hidden="true"></i></div>

          <h4><span>Detail</span> Report By Host</h4>
          <p> </p>
          </a>
        </div>
      </div>
    </div>

    <div class="row" id="detailBankRow" style="display:none">
      <div class="col-md-8 detailBankRow">
        <!-- first row -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-building"></i> Detail Report By Host</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" onClick="activate()"><i class="fa fa-times" aria-hidden="true"></i></button>
                  <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
              </div><!-- /.box-header -->

              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <form role="form" method="POST" id="transactionReport_form" autocomplete="off" action="{{ route('transaction_report') }}">
                          {{ csrf_field() }}
                      <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Branch</label>
                          @if(Session::get('branch_code') == '')
                          <select class="form-control select2 selectBranch" name="branch_code" id="branch_code" style="width: 100%;" required>
                            <option value=""></option>
                              @if(Session::get('branch_code') == '')
                              <option value='All Branch'> All Branch </option>
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
                          <select class="form-control select2 selectRange" name="range" id="range" style="width: 100%;" required="required" onChange="switchtoMonth(this, '', 'detailHost')">
                            <option></option>
                            <option value="d"> 1 Day </option>
                            <option value="w"> 1 Week </option>
                            <option value="m"> 1 Month </option>
                          </select>
                        </div><!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1" id='detailHost'>From Date</label>
                          <div class="input-group date">
                            <input type="text" name="date" id="detailDate" class="form-control readonly" placeholder="Select Date" required="required" />
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div><!-- /.input group -->
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="Submit" class="generate btn btn-primary" id="exampleInputEmail1" value="Generate Report">
                        </div>
                      </div>

                    </div>
                  </form>
                  </div>
                </div>

              </div><!-- end of box body -->

              <div class="box-footer">

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end of detailBankRow -->


    </div><!-- end of row -->

  </section>
</div>


@endsection

@section('javascript')

<!-- BEGIN PAGE SCRIPTS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> <!-- Tables Filtering, Sorting & Editing -->
<script src="{{ asset('assets/js/pages/table_dynamic.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- >Bootstrap Date Picker -->
<!-- END PAGE SCRIPTS -->
<script>

function activate() {
    var x = document.getElementById("detailBankRow");
    if (x.style.display === "none" ) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

$("transactionReport_form").submit(function(e) {
  // needed so the default action isn't called
  //(in this case, regulary submit the form)

  $(this).attr('action', 'transaction_report');


});

$(function ()
{
      $(".selectBranch").select2({
          placeholder: "Select Branch",
          allowClear: true
      });

       $(".selectRange").select2({
           placeholder: "Select Range",
           allowClear: true
       });
       $('.input-group.date').datepicker({
             autoclose: true,
             todayHighlight: true,
             format: "dd/mm/yyyy",
             orientation: 'auto'
         });
});

function switchtoMonth(id, state, idLabel){
  if(id.value == 'm' && state == 'bank') {
    $('.bankdate').datepicker('remove');
    $('.bankdate').datepicker({
      format: "mm/yyyy",
      autoclose: true,
      todayHighlight: true,
      orientation: 'bottom',
      minViewMode: 1
    });

    document.getElementById(idLabel).innerHTML = 'Month';
  } else if(id.value != 'm' && state == 'bank'){
    $('.bankdate').datepicker('remove');
    $('.bankdate').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true,
      orientation: 'bottom'
    });

    document.getElementById(idLabel).innerHTML = 'Month';
  }else if(id.value == 'm') {
    $('.input-group.date').datepicker('remove');
    $('.input-group.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "mm/yyyy",
        minViewMode: 1,
      orientation: 'auto'
    });

    document.getElementById(idLabel).innerHTML = 'Month';
   } else if(id.value == 'w') {
    $('.input-group.date').datepicker('remove');
    $('.input-group.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
      orientation: 'auto'
    });

    document.getElementById(idLabel).innerHTML = 'End Date';
   } else {
    $('.input-group.date').datepicker('remove');
    $('.input-group.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
      orientation: 'auto'
    });

    document.getElementById(idLabel).innerHTML = 'From Date';
   }
}

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
