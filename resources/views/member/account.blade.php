
@extends('member.template.member_master')

@section('content')

       <!-- page content -->
       <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
            @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Account Update</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{ Form::open(['method' => 'post','route'=>'member.update_member']) }}
                    <div class="well" style="overflow: auto">
                        <div class="form-row mb-10 mb-2">
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="member_id"> Member ID</label>
                                <input type="text" name="member_id" value="{{$member->member_id}}" class="form-control" disabled required>
                            </div>
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="member_name"> Member Name </label>
                                <input type="text" name="member_name" value="{{$member->name}}" class="form-control">
                            </div> 
                        </div>
                        <div class="form-row mb-10 mb-2">
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="mobile"> Mobile No </label>
                                <input type="text" name="mobile" value="{{$member->mobile}}" class="form-control">
                            </div>
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="email"> Email </label>
                                <input type="email" name="email" value="{{$member->email}}" class="form-control">
                                @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mb-10 mb-2">
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="gender">Gender*</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="{{$member->gender}}" {{$member->gender == 1 ? "selected" : ""}}>Male</option>
                                    <option value="{{$member->gender}}" {{$member->gender == 2 ? "selected" : ""}}>Female</option>
                                </select>
                                @if($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                                <label for="dob">DOB</label>
                                <input type="date" name="dob" value="{{$member->dob}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">    	            	
                        {{ Form::submit('Update', array('class'=>'btn btn-success pull-right')) }}  
                    </div>
                    {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
        @endsection


