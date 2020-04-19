
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Edit Member Info</h2>
                            <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i><button>
                            <div class="clearfix"></div>
                        </div>
                    <div>
                         @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                         @endif
                         @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                         @endif
    
                    </div>
                        <div>
                            <div class="x_content">
                                {{ Form::open(['method' => 'post','route'=>'admin.update_member']) }}
                                <div class="well" style="overflow: auto">
                                    <input type="hidden" value="{{$fetch_member_data->id}}" name="id">
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="f_name">Name*</label>
                                          <input type="text" class="form-control" name="f_name" value="{{$fetch_member_data->name}}"  placeholder="Enter Name" >
                                            @if($errors->has('f_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('f_name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="email">Email*</label>
                                            <input type="email" class="form-control" name="email" value="{{$fetch_member_data->email}}"  placeholder="Enter Email" >
                                            @if($errors->has('email'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="mobile">Mobile*</label>
                                            <input type="text" class="form-control" name="mobile" value="{{$fetch_member_data->mobile}}" placeholder="Enter Mobile No" >
                                            @if($errors->has('mobile'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('mobile') }}</strong>
                                                  </span>
                                              @enderror
                                          </div> 
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="gender">Gender*</label>
                                          <select class="form-control" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="1" {{$fetch_member_data->gender == 1 ? "selected" : ""}}>Male</option>
                                            <option value="2" {{$fetch_member_data->gender == 2 ? "selected" : ""}}>Female</option>
                                        </select>
                                        @if($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="dob">DOB</label>
                                            <input type="date" name="dob" value="{{$fetch_member_data->dob}}" class="form-control"/>
                                            @if($errors->has('dob'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="relation">Nominee Relation*</label>
                                          <input type="text" class="form-control" name="relation" value="{{$fetch_member_data->nominee_relation}}"  placeholder="Enter Nominee Relation" >
                                            @if($errors->has('relation'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('relation') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="n_name">Nominee Name*</label>
                                          <input type="text" class="form-control" name="n_name" value="{{$fetch_member_data->nominee_name}}"  placeholder="Enter Nominee Name" >
                                            @if($errors->has('n_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('n_name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="n_mobile">Nominee Mobile*</label>
                                          <input type="text" class="form-control" name="n_mobile" value="{{$fetch_member_data->nominee_mobile}}" placeholder="Enter Nominee Mobile" >
                                            @if($errors->has('n_mobile'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('n_mobile') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                          <label for="n_adress">Nominee Address*</label>
                                            <textarea name="n_address" class="form-control" placeholder="Enter Nominee Address">{{$fetch_member_data->nominee_address}}</textarea>
                                          @if($errors->has('n_address'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('n_address') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="state">State*</label>
                                            <input type="text" class="form-control" name="state" value="{{$fetch_member_data->state}}">
                                            @if($errors->has('state'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </span>
                                              @enderror
                                          </div> 
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="city">City*</label>
                                            <input type="text" class="form-control" name="city" value="{{$fetch_member_data->city}}">
                                            @if($errors->has('city'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                              @enderror
                                            </div>
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="city">Pin*</label>
                                            <input type="text" class="form-control" name="pin" value="{{$fetch_member_data->pin}}" placeholder="Enter Pin No">
                                            @if($errors->has('city'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('city') }}</strong>
                                                  </span>
                                              @enderror
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
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection





