@extends('layouts.admin ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Ad | {{$ad->id}}</div>

                <div class="panel-body">
                  <table class="table table-hover table-responsive">
                  <center>
                  <img src="{{asset('images/ads/')}}/{{$ad->image}}" alt="picture" style="border:2px solid grey;" width="250px"/>
                  </center>
                  <br>
                          <tr><td>Ad ID</td><td>{{$ad->id}}</td></tr>
                          <tr><td>Brand Name</td><td>{{$ad->brand_name}}</td></tr>
                          <tr><td>Caption</td><td>{{$ad->caption}}</td></tr>
                          <tr><td>Duration</td><td>{{$ad->duration}}</td></tr>
                          <tr><td>Amount</td><td>&#8358;{{$ad->amount}}</td></tr>
                          <tr><td>Location</td><td>{{$ad->location}}</td></tr>
                          <tr><td>Number of Views</td><td>{{$ad->views}}</td></tr>
                          <tr><td>Reported</td><td>{{$ad->flag}} time(s)</td></tr>
                          <tr><td>Start Date</td><td>{{$ad->start_date}}</td></tr>
                          <tr><td>End Date</td><td>{{$ad->end_date}}</td></tr>
                          <tr><td>Status</td><td>{{$ad->approval}}</td></tr>
                          @if($ad->approval == "PENDING")
                          <tr><td><form class="form-horizontal" role="form" method="POST" action="{{ route('admins.addecision', $ad->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="APPROVED" name="request_approval">
                          <input type="submit" value="APPROVE" name="APPROVE" class="btn btn-default"></form></td><td><form class="form-horizontal" role="form" method="POST" action="{{ route('admins.addecision', $ad->id) }}">{{ csrf_field() }}{{ method_field('PUT') }}<input type="hidden" value="DECLINED" name="request_approval">
                          <input type="submit" value="DECLINE" name="DECLINE
                          " class="btn btn-default"></form></td></tr>
                          @endif
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
