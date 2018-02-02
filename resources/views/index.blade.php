@extends('layout')

@section('content')

    <div class="header">
        <h2><i class="fa fa-th" aria-hidden="true"></i><strong>Home</strong></h2>
    </div>
    <div class="row">
        <div class="col-lg-12" style="height:50px">
          <b>Summary EDC Monitoring</b>
        </div>
        <div class="col-lg-12" style="height:50px">
          Total EDC : {{print_r($total_edc)}}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Active : {{print_r($total_active)}}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Non Active : {{print_r($total_non_active)}}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Active Transaction : {{print_r($total_active_transaction)}}
        </div>
    </div>


@endsection
