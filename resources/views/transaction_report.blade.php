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
              <div class="col-md-3">
                <div class="form-group">
                  <label >Branch</label>
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
                </div>
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
                  <label for="exampleInputEmail1" id='detailHost'>From Date</label>
                  <div class="input-group date">
                    <input type="text" name="date" id="date" class="form-control readonly" placeholder="Select Date" required="required" />
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                  </div>
                </div><!-- /.input group -->
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
