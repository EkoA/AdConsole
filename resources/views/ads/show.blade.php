@extends('layouts.app ')

@section('content')
<div class="clearfix"></div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>

      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="contact-us">
              <div class="row">

            @if (Auth::guest())
            @else
              @include('layouts.menu')
            @endif
                <center><div class="panel-heading"><h3>Ad | <span style="color: #8dc63f; font-weight: bold;">{{$ads->id}}</span></h3></div></center>

                <div class="panel-body">
                  <ul>
                  <table class="table table-striped">
                  <center>
                  <img src="{{asset('images/ads/')}}/{{$ads->image}}" alt="picture" style="border:2px solid grey;" width="250px"/>
                  </center>
                  <br>
                          <tr><td>Ad ID</td><td>{{$ads->id}}</td></tr>
                          <tr><td>Brand Name</td><td>{{$ads->brand_name}}</td></tr>
                          <tr><td>Caption</td><td>{{$ads->caption}}</td></tr>
                          <tr><td>Duration</td><td>{{$ads->duration}}</td></tr>
                          <tr><td>Amount</td><td>{{$ads->amount}}</td></tr>
                          <tr><td>Location</td><td>{{$ads->location}}</td></tr>
                          <tr><td>Number of Views</td><td>{{$ads->views}}</td></tr>
                          <tr><td>Start Date</td><td>{{$ads->start_date}}</td></tr>
                          <tr><td>End Date</td><td>{{$ads->end_date}}</td></tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
