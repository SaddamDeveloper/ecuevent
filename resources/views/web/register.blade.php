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
          <div class="page-title">Register</div>
          <div class="bread-crumb-inner right-side float-none-xs">
            <ul>
              <li><a href="{{route('web.index')}}">Home</a><i class="fa fa-angle-right"></i></li>
              <li><span>Register</span></li>
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
              <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2 creditial-block">
                <form class="main-form full">
                  <div class="row">
                    <div class="col-xs-12 mb-20">
                      <div class="heading-part heading-bg">
                        <h2 class="heading">Create your account</h2>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="f-name">First Name</label>
                        <input type="text" id="f-name" required="" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="l-name">Last Name</label>
                        <input type="text" id="l-name" required="" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="login-email">Email address</label>
                        <input id="login-email" type="email" required="" placeholder="Email Address">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="login-pass">Password</label>
                        <input id="login-pass" type="password" required="" placeholder="Enter your Password">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="re-enter-pass">Re-enter Password</label>
                        <input id="re-enter-pass" type="password" required="" placeholder="Re-enter your Password">
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="check-box left-side mb-20">
                      </div>
                      <button name="submit" type="submit" class="btn-black right-side">Submit</button>
                    </div>
                    <div class="col-xs-12">
                      <hr>
                      <div class="new-account align-center mt-20">
                        <span>Already have an account with us</span>
                        <a class="link" title="Login with Streetwear" href="{{route('web.login')}}">Login Here</a>
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