<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Olync, A Social Network for Corp Members" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page, Corp members" />
    <meta name="robots" content="index, follow" />
    <title>Olync | A Social Network for Corp Members</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <!--Google Webfont-->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/fav.png') }}"/>
  </head>
  <body>

    <!-- Header
    ================================================= -->
    <header id="header" class="">
      <nav class="navbar navbar-default navbar-fixed-top menu top-menu" style="background-color: #9a69ff; box-shadow: 0 0 15px #000;">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header" style="padding-bottom: 1%; padding-top: 2px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/logo2.png') }}" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
               <li class="dropdown">
                    @if (Auth::guest())
                        <li class="dropdown"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="dropdown"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <li class="dropdown" ><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="glyphicons glyphicons-chevron-down"><img src="{{ asset('images/down-arrow.png') }}" alt="" /></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>-->
                        </li>
                    @endif
              </li>
            </ul>
            
            <form class="navbar-form navbar-right hidden-sm" method="GET" action="{{ route('ads.search') }}">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search..." name="search" style="background-color: #fff; color: #9a69ff;" required>
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->

    @yield('content')
    <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href=""><img src="{{ asset('images/logo-purple.png') }}" alt="" class="footer-logo" height="35" width="92" /></a>
              <ul class="list-inline social-icons">
                <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>

            @if (Auth::guest())
            <div class="col-md-2 col-sm-2">
              <h6>For individuals</h6>
              <ul class="footer-links">
                <li><a href="{{ url('/register') }}">Signup</a></li>
                <li><a href="{{ url('/login') }}">login</a></li>
                <li><a href="">Olync app</a></li>
              </ul>
            </div>
           @else

           @endif
            <div class="col-md-2 col-sm-2">
              <h6>About</h6>
              <ul class="footer-links">
                <li><a href="">About us</a></li>
                <li><a href="">Contact us</a></li>
                <li><a href="">Privacy Policy</a></li>
               
              </ul>
            </div>
            <div class="col-md-5 col-sm-5">
              <h6>Contact Us</h6>
              <!--  <ul class="footer-links" style="all: unset;"> -->
                  <p><i class="icon ion-ios-telephone"></i>&nbsp; +234 01 291 8554</p>
                  <p><i class="icon ion-iphone"></i>&nbsp;+234 (0) 802 725 8240</p>
                  <p><i class="icon ion-ios-email"></i>&nbsp;info@olync.net</p>
                <!--</ul>-->
            </div>
          </div>
        </div>
      </div>
      <div class="copyright">
        <p>copyright @dreammesh ltd 2017. All rights reserved</p>
      </div>
    </footer>

    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('js/jquery.incremental-counter.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
