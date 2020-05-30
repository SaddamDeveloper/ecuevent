@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
  @endsection

  @section('content')
    <!-- HEADER END --> 

    <!-- BANNER STRAT -->
    <div class="banner inner-banner">
      <div class="container">
        <div class="bread-crumb mtb-10 center-xs">
          <div class="page-title">Login</div>
          <div class="bread-crumb-inner right-side float-none-xs">
            <ul>
              <li><a href="{{route('web.index')}}">Home</a><i class="fa fa-angle-right"></i></li>
              <li><span>Login</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- BANNER END --> 
    <!-- CONTAIN START -->
    <section class="container">
      <div class="checkout-section ptb-30">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              @if (Session::has('message'))
              <div class="alert alert-success" >{{ Session::get('message') }}</div>
              @endif
              @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
              @endif
              <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2 creditial-block">
                {{ Form::open(['method' => 'post','route'=>'web.do_login', 'class' => 'main-form full']) }}
                  <div class="row">
                    <div class="col-xs-12 mb-20">
                      <div class="heading-part heading-bg">
                        <h2 class="heading">Login to your account  </h2>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="login-email">Email address</label>
                        <input id="email" type="email" name="email" value="{{old('email')}}" required="" placeholder="Email Address">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required="" placeholder="Enter your Password">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="check-box left-side">
                        <a title="Forgot Password" class="forgot-password mtb-20" href="#">Forgot your password?</a>
                      </div>
                      <button name="submit" type="submit" class="btn-black right-side">Log In</button>
                    </div>
                    <div class="col-xs-12">
                      <hr>
                    </div>
                    <div class="col-xs-12">
                      <div class="new-account align-center mt-20">
                        <span>New to ECUEVENT?</span>
                        <a class="link" title="Register with Streetwear" href="{{route('web.register')}}">Create New Account</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- CONTAINER END --> 

    <!-- FOOTER START -->
	@endsection
	
	@section('script')
	@endsection
