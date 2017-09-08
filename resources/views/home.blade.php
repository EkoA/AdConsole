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
                  <table class="table table-striped">
    <thead>
        <tr>
            <th>Ad ID</th>
            <th>Caption</th>
            <th>Duration</th>
            <th>Amount (N)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>12</td>
            <td>Hello Mr. Tester</td>
            <td>5 days</td>
            <td>100.00</td>
        </tr>
        <tr>
            <td>28</td>
            <td>I am Testing this</td>
            <td>30 days</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>20</td>
            <td>Testing at Dreammesh</td>
            <td>12 days</td>
            <td>200.00</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Hello Mr. Tester</td>
            <td>5 days</td>
            <td>100.00</td>
        </tr>
        <tr>
            <td>28</td>
            <td>I am Testing this</td>
            <td>30 days</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>20</td>
            <td>Testing at Dreammesh</td>
            <td>12 days</td>
            <td>200.00</td>
        </tr>
        <tr>
            <td>12</td>
            <td>Hello Mr. Tester</td>
            <td>5 days</td>
            <td>100.00</td>
        </tr>
        <tr>
            <td>28</td>
            <td>I am Testing this</td>
            <td>30 days</td>
            <td>150.00</td>
        </tr>
        <tr>
            <td>20</td>
            <td>Testing at Dreammesh</td>
            <td>12 days</td>
            <td>200.00</td>
        </tr>
    </tbody>
</table>
                  </div>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <?php
                if(isset($_GET['res']))
                {
                  $res = $_GET['res'];
                  echo $res;
                  $class = "alert alert-success";
                }
                ?> 

                <div class="panel-body">
                  <ul>
                  @if(Auth::user()->balance >= 2000)
                    <li><a href="{{route('ads.create')}}">Place Ads</a></li>
                  @endif
                    <li><a href="{{route('ads.index')}}">View Ads</a></li>
                    <li><a href="{{route('users.wallet')}}">Wallet</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
