@extends('layout')

@section('content')

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home"></i> Charts
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaction Report</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border" onClick="exp()" style="cursor: pointer;">
          <h3 class="box-title">Count Total EDC Based on Merch ID</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" id="collapseButton"><i class="fa fa-minus"></i></button>
            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
          </div>
        </div><!-- /.box-header -->


        <div class="box-body">
          <div class="row">  <!-- first row -->
            <div class="col-md-10 col-md-offset-1">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                  <canvas id="myChart" width="50" height="300"></canvas>
                            </div>

                        </div>

                    </div>


          </div>
        </div>

      </div>
    </div> <!-- end of col-md-8 -->
  </div>

  </section><!-- /.content -->

</div><!-- /.content-wrapper -->

@endsection

@section('javascript')

<script type="text/javascript">
function exp(){
  var collapseButton = document.getElementById('collapseButton');
  collapseButton.click();
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>

$(function(){
  $.ajax({
    dataType: 'JSON',
    type: 'GET',
    url: '/monitoring_bar_chart',
    success: function (result) {

    console.log(result);
    var labels = [],data=[];
    for (var i = 0; i < result.length; i++) {
        labels.push(result[i]['FMERCH_ID']);
        data.push(result[i]['total']);
    }

    console.log(labels);
    console.log(data);

    var buyerData = {
      labels : labels,
      datasets : [
        {
          fillColor : "rgba(240, 127, 110, 0.3)",
          strokeColor : "#f56954",
          pointColor : "#A62121",
          pointStrokeColor : "#741F1F",
          data : data
        }
      ]
    };
    var buyers = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(buyers, {
      type: 'bar',
      data: buyerData,
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
      }
    });

    }
    });

});




// var ctx = document.getElementById("myChart").getContext("2d");
// var myChart = new Chart(ctx, {
// type: 'bar',
// data: {
//     labels: ["Red", "Blue", "Yellow", "Green", "Purple","Orange"],
//     datasets: [{
//         label: '# of Votes',
//         data: [12, 19, 3, 5, 2, 3],
//         backgroundColor: [
//             'rgba(255, 99, 132, 0.2)',
//             'rgba(54, 162, 235, 0.2)',
//             'rgba(255, 206, 86, 0.2)',
//             'rgba(75, 192, 192, 0.2)',
//             'rgba(153, 102, 255, 0.2)',
//             'rgba(255, 159, 64, 0.2)'
//         ],
//         borderColor: [
//             'rgba(255,99,132,1)',
//             'rgba(54, 162, 235, 1)',
//             'rgba(255, 206, 86, 1)',
//             'rgba(75, 192, 192, 1)',
//             'rgba(153, 102, 255, 1)',
//             'rgba(255, 159, 64, 1)'
//         ],
//         borderWidth: 1
//     }]
// },
// options: {
//     responsive: true,
//     maintainAspectRatio: false,
//     scales: {
//         yAxes: [{
//             ticks: {
//                 beginAtZero:true
//             }
//         }]
//     }
// }
// });
</script>

@endsection
