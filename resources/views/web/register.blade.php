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
    @if (Session::has('message'))
    <div class="alert alert-success" >{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <!-- CONTAIN START -->
    <section class="container">
      <div class="checkout-section ptb-30">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-lg-6 col-md-8 col-sm-8 col-lg-offset-3 col-sm-offset-2 creditial-block">
                {{ Form::open(['method' => 'post','route'=>'web.add_user', 'class' => 'main-form full']) }}
                  <div class="row">
                    <div class="col-xs-12 mb-20">
                      <div class="heading-part heading-bg">
                        <h2 class="heading">Create your account</h2>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="f-name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
                        @if($errors->has('first_name'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="l-name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                        @if($errors->has('last_name'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="login-email">Email address</label>
                        <input id="login-email" type="email" name="email" value="{{old('email')}}" placeholder="Email Address">
                        @if($errors->has('email'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="login-pass">Password</label>
                        <input id="login-pass" type="password" name="password" placeholder="Enter your Password">
                        @if($errors->has('password'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="input-box">
                        <label for="password_confirmation">Re-enter Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter your Password">
                        @if($errors->has('password_confirmations'))
                          <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('password_confirmations') }}</strong>
                          </span>
                        @enderror
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