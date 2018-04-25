@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-search"></i> Search Transaction
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaction Report</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary">

      <div class="box-header with-border" onClick="exp()" style="cursor: pointer;">
        <h3 class="box-title">Search By Filter</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" id="collapseButton"><i class="fa fa-minus"></i></button>
          <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div><!-- /.box-header -->

      <div class="box-body">
          <form role="form" method="POST" id="searchTransaction_form" autocomplete="off">
            <div class="row">  <!-- first row -->
              <div class="col-md-12">

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Store Code</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" name="store_code" id="store_code" placeholder="Store Code">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Branch Code</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-sitemap" aria-hidden="true"></i>
                        </div>

                        <input type="text" class="form-control" name="branch_code" id="branch_code" value="" placeholder="Branch Code" >
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Host </label>
                      @if(Session::get('FCODE') == 'I001' || Session::get('FCODE') == 'pvs1909' || Session::get('FCODE') == 'merchant')
                      <select class="form-control host selectHost" name="host" id="host" style="width: 100%;" required>
                      </select>
                      <!--<input type="text" class="form-control" name="host" id="host" placeholder="Host" >-->
                      @else
                      <input type="text" class="form-control readonly" value="{{ Session::get('FNAME') }}" />
                      <input type="hidden" name="bankCode" id="host" value="{{ Session::get('CODE') }}" />
                      @endif
                    </div>
                  </div>

                </div>
              </div>
            </div> <!-- end of first row -->

            <div class="row"> <!-- second row -->
              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Transaction Type </label>
                  <select class="form-control trx selectTransaction_Type" name="transaction_type" id="transaction_type" style="width: 100%;">
                        <option></option>
                        <option value="sale"> Sale </option>
                        <option value="installment"> Installment </option>
                        <option value="loyalty"> Loyalty </option>
                        <option value="prepaid_sale"> Prepaid Sale </option>
                        <option value="prepaid_topup"> Prepaid Top Up </option>
                        <option value="tarik_tunai"> Tarik Tunai </option>
                        @if(Session::get('FCODE') == 'pvs1909' || Session::get('merch_id') == '1')
                        <option value="loyalty_indomaret"> Loyalty Indomaret </option>
                        @endif
                      </select>
                    <!--  <input type="text" class="form-control" name="transaction_type" id="transaction_type" placeholder="Transaction Type" >-->

                    </div><!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Prepaid Card Number</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </div>

                        <input type="text" class="form-control" name="prepaid_card_number" id="prepaid_card_number" placeholder="Prepaid Card Number" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Approval Code</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" name="approval_code" id="approval_code" placeholder="Approval Code">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div> <!-- end of second row -->

            <div class="row"> <!-- third row -->
              <div class="col-md-12">
                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">MID</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="mid" name="mid" placeholder="MID" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">TID</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="tid" placeholder="TID">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <!-- Date range -->
                    <div class="form-group">
                      <label>Transaction Date</label>

                      <div class="input-group date">
                          <input type="text" name="transaction_date" id="transaction_date" class="form-control readonly" placeholder="Select Date" required="required" />
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                    </div><!-- /.form group -->
                  </div>

                </div>
              </div>
            </div> <!-- end of third row -->

            <input type="submit" class="btn btn-primary" id="submit_filter_form" value="Submit" style="display: none;">

          </form>
      </div><!-- end of box body -->
      <div class="box-footer">
        <button type="button" class="btn btn-primary btn-embossed" id="btnSubmit">Submit</button>
      </div>

    </div>

    <div class="box box-primary" id="box-result" style="display:none">
      <div class="box-footer">
            <div class="form-group">
              <div class="panel-content pagination2 force-table-responsive" style="overflow-x: hidden;">
                <table class="table table-bordered" id="tableSearch">
                  <thead>
                    <tr>
                      <th>Host</th>
                      <th>MID</th>
                      <th>TID</th>
                      <th>Branch</th>
                      <th>Store</th>
                      <th>Transaction</th>
                      <th>Card Num</th>
                      <th>Prepaid Card Num</th>
                      <th>Inv Num</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>RC</th>
                      <th>Status</th>
                      <th>APPR Code</th>
                      <th>Amount</th>
                      <th>Redeem</th>
                      <th>Net</th>
                    </tr>
                  </thead>
                </table>
              </div>
              </div>
            </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border" onClick="exp()" style="cursor: pointer;">
            <h3 class="box-title">Total Transaction by Date</h3>
            <div class="box-tools pull-right">
              <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
            </div>
          </div><!-- /.box-header -->

          <div id="temps_div" style="overflow-x:auto; overflow-y:hidden"></div>
          <?= $lava->render('LineChart', 'Transaction', 'temps_div') ?>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border" onClick="exp()" style="cursor: pointer;">
          <h3 class="box-title">Total Transaction by Seconds</h3>
          <div class="box-tools pull-right">
            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
          </div>
        </div><!-- /.box-header -->

      <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
  </div>
</div>

  </section>

</div><!-- /.content-wrapper -->

@endsection

@section('javascript')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script> <!-- Checkbox & Radio Inputs -->

<!-- BEGIN PAGE SCRIPTS -->

<!-- END PAGE SCRIPTS -->
<script type="text/javascript">

Highcharts.setOptions({
    global: {
        useUTC: false,
        credits: false
    }
});

Highcharts.chart('container', {
    chart: {
        type: 'line',
        marginRight: 10,
        events: {
            load: function () {
                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (Math.round(new Date().getTime() / 1000))*1000, // current time
                        y = Math.random() * 100;
                    console.log('x:' + x);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },
    title: {
        text: ''
    },
    xAxis: {
        type: 'datetime',
        tickInterval: 1000
    },
    yAxis: {
        title: {
            text: 'Value'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    credits: {
    enabled: false
    },
    series: [{
        name: 'Random data',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (Math.round(new Date().getTime() / 1000))*1000,
                i;


            for (i = -19; i <= 0; i += 1) {

                data.push({
                    x: time + i * 1000,
                    y: Math.random() * 100
                });
            }
            return data;
        }())
    }]
});
</script>

<script type="text/javascript">

function exp(){
  var collapseButton = document.getElementById('collapseButton');
  collapseButton.click();
}


$(function ()
{
       $(".selectHost").select2({
           placeholder: "Select Host",
           allowClear: true
       });

       $(".selectTransaction_Type").select2({
           placeholder: "Select Transaction",
           allowClear: true
       });

       $('.input-group.date').datepicker({
             autoclose: true,
             todayHighlight: true,
             format: "dd/mm/yyyy",
             orientation: 'auto'
         });
});


$("#btnSubmit").click(function(e)
{
  var x = document.getElementById("box-result");
  x.style.display = "block";

  e.preventDefault();

  var tableSearch = $('#tableSearch').DataTable();

  $('.btn-primary').prop('disabled', true);

  $.ajax({
        type: 'POST',
        data: {
          store_code          : $('input[name="store_code"]').val(),
          branch_code         : $('input[name="branch_code"]').val(),
          host                : $('#host').find(":selected").val(),
          transaction_type    : $('#transaction_type').find(":selected").val(),
          prepaid_card_number : $('input[name="prepaid_card_number"]').val(),
          approval_code       : $('input[name="approval_code"]').val(),
          mid                 : $('input[name="mid"]').val(),
          tid                 : $('input[name="tid"]').val(),
          transaction_date    : $('#transaction_date').val()
          // ,ModifiedBy        : "ADMIN"
        },
        //headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        url: '/search_transaction/main_data',
        success: function (data)
        {
              tableSearch.clear().draw();

              for (var i = 0; i < data.length; i++)
              {

                var fname = data[i]['FNAME'];
                var fmid = data[i]['FMID'];
                var ftid = data[i]['FTID'];
                var fbranchcode = data[i]['FBRANCHCODE'];
                var fstorecode = data[i]['FSTORECODE'];
                var ftrx_label = data[i]['FTRX_LABEL'];
                var fcardnum = data[i]['FCARDNUM'];
                var fprepaidcardnum = data[i]['FPREPAIDCARDNUM'];
                var finvnum = data[i]['FINVNUM'];
                var fdate = data[i]['FDATE'];
                var ftime  = data[i]['FTIME'];
                var frespcode = data[i]['RESPCODE'];
                var fstatus = data[i]['FSTATUS'];
                var fapprcode = data[i]['FAPPRCODE'];
                var famount = data[i]['FAMOUNT'];
                var fredeem = data[i]['FREDEEM'];
                var fnet = data[i]['FNET'];

                  var jRow = $('<tr>').append(
                      '<td>'+ fname +'</td>',
                      '<td>'+ fmid +'</td>',
                      '<td>'+ ftid +'</td>',
                      '<td>'+ fbranchcode +'</td>',
                      '<td>'+ fstorecode +'</td>',
                      '<td>'+ ftrx_label +'</td>',
                      '<td>'+ fcardnum +'</td>',
                      '<td>'+ fprepaidcardnum +'</td>',
                      '<td>'+ finvnum +'</td>',
                      '<td>'+ fdate +'</td>',
                      '<td>'+ ftime +'</td>',
                      '<td>'+ frespcode +'</td>',
                      '<td>'+ fstatus +'</td>',
                      '<td>'+ fapprcode +'</td>',
                      '<td>'+ famount +'</td>',
                      '<td>'+ fredeem +'</td>',
                      '<td>'+ fnet +'</td>',
                      );
                  tableSearch.row.add(jRow).draw();
                }
        }
      });

    $('.btn-primary').prop('disabled', false);
  });


//select host
$(function(){
    $.ajax({
      dataType: 'JSON',
      type: 'GET',
      url: '/host_data',
      success: function (data) {


        $("#host").append('<option value=""></option>');
        for(var i = 0; i < data.length; i++)
        {
          $("#host").append('<option value="' + data[i]['FCODE'] + '">' + data[i]['FNAME'] + '</option>');
        }
      }
    });


  });

</script>
@endsection
