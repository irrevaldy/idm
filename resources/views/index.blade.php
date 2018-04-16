@extends('layout')

@section('content')

    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <i class="fa fa-home"></i> Home
        </h1>
        <ol class="breadcrumb">
          <!-- <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Transaction Report</li> -->
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <script type="text/javascript">
        function exp(){
          var collapseButton = document.getElementById('collapseButton');
          collapseButton.click();
          var collapseButton2 = document.getElementById('collapseButton2');
          collapseButton2.click();
        }
      </script>
      @if(session('FCODE') == 'pvs1909')
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border" onClick="exp()" style="cursor: pointer;">
              <h3 class="box-title">Summary EDC Monitoring</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" id="collapseButton"><i class="fa fa-minus"></i></button>
                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div><!-- /.box-header -->

            <!--  get summary data monitoring from database -->
            <?php
            if($total_edc != 0)
            {
              $percentActive = (int)$total_active / (int)$total_edc * 100;
              $percentNotActive = (int)$total_not_active / (int)$total_edc * 100;
              $percentActiveTransaction = (int)$total_active_transaction / (int)$total_edc * 100;
            }
            else
            {
              $percentActive = 0;
              $percentNotActive = 0;
              $percentActiveTransaction = 0;
            }

            ?>


            <div class="box-body">
              <div class="row">  <!-- first row -->
                <div class="col-md-3">
                  <a onClick="viewStatus('all', this)">
                    <div class="info-box bg-aqua activeStage">
                      <span class="info-box-icon"><i class="fa fa-object-group" aria-hidden="true"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Total EDC</span>
                        <span class="info-box-number totalClass">{{ $total_edc }}</span>
                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                          <span class="totalClass">{{ $total_edc }}</span> total EDC
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div class="col-md-3">
                  <a onClick="viewStatus('active', this)">
                    <div class="info-box bg-green ">
                      <span class="info-box-icon"><i class="fa fa-check-square"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">EDC Active</span>
                        <span class="info-box-number totalActive">{{ $total_active }}</span>
                        <div class="progress">
                          <div class="progress-bar totalBar" style="width: <?php echo $percentActive; ?>%"></div>
                        </div>
                        <span class="progress-description">
                          <span class="totalActive">{{ $total_active }}</span> EDC active
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div class="col-md-3">
                  <a onClick="viewStatus('not active', this)">
                    <div class="info-box bg-red ">
                      <span class="info-box-icon"><i class="fa fa-window-close"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">EDC Not Active</span>
                        <span class="info-box-number totalNotActive">{{ $total_not_active }}</span>
                        <div class="progress">
                          <div class="progress-bar totalBar" style="width: <?php echo $percentNotActive; ?>%"></div>
                        </div>
                        <span class="progress-description">
                          <span class="totalNotActive">{{ $total_not_active }}</span> EDC not active
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

                <div class="col-md-3">
                  <a onClick="viewStatus('active transaction', this)">
                    <div class="info-box bg-yellow ">
                      <span class="info-box-icon"><i class="fa fa-check-square-o"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">EDC Active Transaction</span>
                        <span class="info-box-number totalActiveTransaction">{{ $total_active_transaction }}</span>
                        <div class="progress">
                          <div class="progress-bar totalBar" style="width: <?php echo $percentActiveTransaction; ?>%"></div>
                        </div>
                        <span class="progress-description">
                          <span class="totalActiveTransaction">{{ $total_active_transaction }}</span> EDC active transaction
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div> <!-- end of col-md-8 -->
      </div>
      @endif
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
@endsection
