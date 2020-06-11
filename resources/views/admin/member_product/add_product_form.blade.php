
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Add New Product</h2>
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
                           
                         {{ Form::open(['method' => 'post','route'=>'admin.mem_add_new_product' , 'enctype'=>'multipart/form-data']) }}
                                    
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="name">Product Package Name</label>
                                      <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Enter Product Package Name">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>              
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="name">Product Price</label>
                                      <input type="number" class="form-control" value="3200.00" readonly disabled>
                                      <input type="hidden" name="price" value="3200">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size">Image</label>
                                        <input type="file" name="image1" value="{{old('image1')}}" class="form-control">
                                        @if($errors->has('image1'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('image1') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
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


