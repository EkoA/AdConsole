@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                 <table class="table table-hover table-responsive">
                @if (empty($ads))
                        <p>There are no ads yet</p>
                @else
                        <tr><th>Ad ID &nbsp;</th><th>&nbsp;Brand Name&nbsp;</th><th>&nbsp;Duration&nbsp;</th><th>&nbsp;Amount(&#8358;)&nbsp;</th></tr>
                @foreach($ads as $ad)
                        <tr onclick="document.location='{{route('admins.show', $ad->id)}}'" style="cursor:hand"><td>{{$ad->id}}</td><td>{{$ad->brand_name}}&nbsp;&nbsp;</td><td>&nbsp;{{$ad->duration}}&nbsp;</td><td>&nbsp;<span>{{$ad->amount}}</span>&nbsp;</td></tr>
                @endforeach
                    @endif
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



