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
          Total EDC : {{ $total_edc }}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Active :{{ $total_active }}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Non Active : {{ $total_not_active }}
        </div>
        <div class="col-lg-12" style="height:50px">
          EDC Active Transaction : {{ $total_active_transaction }}
        </div>
    </div>


@endsection