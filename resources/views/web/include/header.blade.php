<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic Page Needs
    ================================================== -->
  <meta charset="utf-8">
  <title>ECU EVENT | HOME</title>
  <!-- SEO Meta
    ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us">
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- Mobile Specific Metas
    ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- CSS
    ================================================== --> 
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/bootstrap.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/jquery-ui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/owl.carousel.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/fotorama.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/magnific-popup.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/custom.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('web/css/responsive.css')}}"> 
  <link rel="shortcut icon" href="{{asset('images/favicon.html')}}">
</head>

<body>

  <div class="main"> 
    <!-- HEADER START -->
    <header class="navbar navbar-custom" id="header">
      <div class="header-middle">
        <div class="container">
          <div class="header-inner">
            <div class="row m-0">
              <div class="col-md-3 col-sm-12">
                <div class="navbar-header float-none-sm">
                  <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"><i class="fa fa-bars"></i></button>
                  <a class="navbar-brand page-scroll" href="index.html">
                    <img alt="Streetwear" src="{{asset('web/images/logo.png')}}">
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 hidden-sm hidden-xs">
                <div class="header-right-part float-none-sm">
                  <ul>
                    <li class="mobile-view-search">
                      <div class="header_search_toggle mobile-view">
                        <form>
                          <div class="search-box">
                            <select name="" id="">
                              <option>Books</option>
                              <option>Shoping</option>
                              <option>Education</option>
                            </select>
                            <input type="text" placeholder="Search" class="input-text">
                            <button class="search-btn"></button>
                          </div>
                        </form>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="header-right-part right-side float-none-sm fts-11">
                  <ul>
                    <li class="mobile-view-search visible-sm visible-xs">
                      <div class="header_search_toggle mobile-view">
                        <form>
                          <div class="search-box">
                          <select name="" id="">
                              <option>Books</option>
                              <option>Shoping</option>
                              <option>Education</option>
                            </select>
                            <input type="text" placeholder="Search" class="input-text">
                            <button class="search-btn"></button>
                          </div>
                        </form>
                      </div>
                    </li>
                    @if(Auth::guard('web')->user())
                    <li class="content">
                      <a href="{{ route('web.logout') }}" class="content-link" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        Logout
                      </a>     
                      <form id="frm-logout" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                    @else
                    <li class="content">
                      <a href="{{route('web.login')}}" class="content-link">Login</a>
                    </li>
                    <li class="content">
                      <a href="{{route('web.register')}}" class="content-link">Register</a>
                    </li>
                    <li class="content">
                      <a href="{{route('member.login')}}" class="content-link">APM Login</a>
                    </li>
                    @endif
                    <li class="language">
                      <select name="" id="">
                        <option>EN</option>
                        <option>HN</option>
                      </select>
                    </li>
                    <li class="cart-icon">
                      <a href="#">
                        <span>
                          <small class="cart-notification">2</small>
                        </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-bottom">
        <div class="container"> 
          <div id="menu" class="navbar-collapse collapse left-side align-center" >
            <ul class="nav navbar-nav">
              <li class="level"><a href="{{route('web.index')}}" class="page-scroll">Home </a></li>
              <li class="level">                
                <span class="opener plus"></span>
                <a class="page-scroll">About Us </a>
                <div class="megamenu mobile-sub-menu">
                  <div class="megamenu-inner-top">
                    <ul class="sub-menu-level1">
                      <li class="level2">
                        <ul class="sub-menu-level2 ">
                          <li class="level3"><a href="shop.html">About ECU</a></li>
                          <li class="level3"><a href="shop.html">Mission & Vision</a></li>
                          <li class="level3"><a href="shop.html">Message from the Directors</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="level"><a href="shop.html" class="page-scroll">Booking </a>
                <div class="megamenu mobile-sub-menu">
                  <div class="megamenu-inner-top">
                    <ul class="sub-menu-level1">
                      <li class="level2">
                        <ul class="sub-menu-level2 ">
                          <li class="level3"><a href="shop.html">Sound</a></li>
                          <li class="level3"><a href="shop.html">Light</a></li>
                          <li class="level3"><a href="shop.html">Tent</a></li>
                          <li class="level3"><a href="shop.html">Catering</a></li>
                          <li class="level3"><a href="shop.html">Cook</a></li>
                          <li class="level3"><a href="shop.html">Band Party</a></li>
                          <li class="level3"><a href="shop.html">Beautician</a></li>
                          <li class="level3"><a href="shop.html">Musician etc</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="level"><a href="shop.html" class="page-scroll">Shopping </a>
                <div class="megamenu mobile-sub-menu">
                  <div class="megamenu-inner-top">
                    <ul class="sub-menu-level1">
                      <li class="level2">
                        <ul class="sub-menu-level2 ">
                          <li class="level3"><a href="shop.html">Bags</a></li>
                          <li class="level3"><a href="shop.html">Cloths</a></li>
                          <li class="level3"><a href="shop.html">Books</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="level"><a href="shop.html" class="page-scroll">Education </a>
                <div class="megamenu mobile-sub-menu">
                  <div class="megamenu-inner-top">
                    <ul class="sub-menu-level1">
                      <li class="level2">
                        <ul class="sub-menu-level2 ">
                          <li class="level3"><a href="shop.html">Computer</a></li>
                          <li class="level3"><a href="shop.html">Network Marketing (MLM)</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="level"><a href="shop.html" class="page-scroll">Join Us </a>
                <div class="megamenu mobile-sub-menu">
                  <div class="megamenu-inner-top">
                    <ul class="sub-menu-level1">
                      <li class="level2">
                        <ul class="sub-menu-level2 ">
                          <li class="level3"><a href="shop.html">Why ECU ?</a></li>
                          <li class="level3"><a href="shop.html">Opportunity</a></li>
                          <li class="level3"><a href="shop.html">Terms & Privacy</a></li>
                          <li class="level3"><a href="shop.html">Become a Distributor</a></li>
                          <li class="level3"><a href="shop.html">Success Story</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
              <li class="level"><a href="shop.html" class="page-scroll">Contact Us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>