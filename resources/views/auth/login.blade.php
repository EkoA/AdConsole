@extends('layouts.app')

@section('content')
<div class="clearfix"></div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>

    <div id="page-contents">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
            <div class="contact-us">
                <div class="row ">
                    <div class="col-md-8 col-sm-7" >
                    <br/><br/>
                  <h4 class="grey">Sign In</h4><br/>
                    <form class="contact-form" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="form-group">
                              <i class="icon ion-email"></i>
                                <input id="contact-email" type="email" class="form-control" name="email" value="{{ old('email') }}" class="form-control" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <i class="icon ion-password"></i>
                                <input id="password" type="password" class="form-control" name="password" class="form-control" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                        <input type="checkbox" name="remember"> Remember Me
                        </div>

                                <button type="submit" class="btn-primary" name="login" ><span class="glyphicon glyphicon-log-in"></span>
                                     Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

                    </form>
                </div>
                </div>
            </div>
          </div>
            </div>
        </div>
    </div>
@endsection
