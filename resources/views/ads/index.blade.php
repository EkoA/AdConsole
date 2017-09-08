@extends('layouts.app')

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

            <div class="col-md-8 col-sm-7 wallet">
                <h4 class="wallet-head" style="color: #fff; font-weight: bold;" align="center">All Adverts</h4><br/>       
                @if(empty($ads))
                    <center><p>No adverts placed yet</p></center>
                @else
                <table class="table table-striped">      
                <thead>
                        <tr><th>Ad ID &nbsp;</th><th>&nbsp;Caption&nbsp;</th><th>&nbsp;Duration&nbsp;</th><th>&nbsp;Amount(&#8358;)&nbsp;</th></tr>
                </thead>        
                @foreach($ads as $ad)
                <tbody>
                        <tr onclick="document.location='{{route('ads.show', $ad->id)}}'" style="cursor:hand"><td>{{$ad->id}}</td><td>{{$ad->caption}}&nbsp;&nbsp;</td><td>&nbsp;{{$ad->duration}} days&nbsp;</td><td>&nbsp;<span>{{$ad->amount}}</span>&nbsp;</td></tr>
                </tbody>
                @endforeach
                @endif
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
