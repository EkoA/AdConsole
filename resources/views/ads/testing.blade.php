@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Advert Placement</div>

                <div class="panel-body">
                <center>
                @if (empty($ads))
                        <p>No Ads yet</p>
                @else
                @foreach($ads as $ad)
                        <img src="{{asset('images/ads/')}}/{{$ad->image}}" alt="picture" style="border:2px solid grey;" width="250px"/>
                        <p>{{$ad->caption}}</p>
                        <form action="{{ route('ads.report', $ad->id) }}" method="POST">{{ csrf_field() }}{{ method_field('PUT') }}<input type="submit" name="Report" value="Report"></form>
                        <br>
                @endforeach
                @endif
                </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
