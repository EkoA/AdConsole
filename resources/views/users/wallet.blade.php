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

                <div class="panel-body">
                <div class="col-md-8 col-sm-7 wallet">
                  <center><h2 align="center">Wallet Balance: <span style="color: #8dc63f; font-weight: bold;">&#8358;{{ Auth::user()->balance }}</span></h2></center>
                  <hr>
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('users.fundwallet') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount(&#8358;)</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" min="{{$cost->min_cost}}" name="amount" value="{{ old('amount') }}" required>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Pay
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
