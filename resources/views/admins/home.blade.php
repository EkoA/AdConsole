@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                @foreach($ads as $ad)
                    {{$ad->ad_count}} Ads
                @endforeach
                <br>
                @foreach($pads as $pad)
                    {{$pad->pad_count}} Pending Ads
                @endforeach
                <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
