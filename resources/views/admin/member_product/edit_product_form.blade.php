
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Edit Product</h2>
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
                                @if(isset($member) && !empty($member))
                           
                                    {{ Form::open(['method' => 'POST','route'=>'admin.mem_update_new_product',  'enctype'=>'multipart/form-data']) }}
                                        <input type="hidden" name="id" value="{{$member->id}}"> 
                                        <div class="well" style="overflow: auto">
                                            <div class="form-row mb-10">
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="name">Product name</label>
                                                <input type="text" class="form-control" name="name"  value="{{$member->name}}"  placeholder="Enter Product name">
                                                    @if($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>              
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="name">Product Price</label>
                                                <input type="text" class="form-control" name="price" value="{{$member->price}}"  placeholder="Enter Product Price" >
                                                    @if($errors->has('price'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('price') }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>              
                                            </div>
                                        </div>

                
                                        <div class="well" style="overflow: auto" id="image_div">
                                            <div class="form-row mb-10">
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <label for="size">Image</label>
                                                    <input type="file" name="image1" value="{{$member->image1}}" class="form-control">
                                                    @if($errors->has('image1'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('image1') }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <img src="{{ asset('member/product/thumb/'.$member->image1.'') }}" height="100px">
                                                </div>
                                                
                                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                        <label for="size">Image</label>
                                                        <input type="file" name="image2" value="{{$member->image2}}" class="form-control">
                                                        @if($errors->has('image2'))
                                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                                <strong>{{ $errors->first('image2') }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                                <div>
                                                    <img src="{{ asset('member/product/thumb/'.$member->image2.'') }}" height="100px">
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="form-group">    	            	    
                                        {{ Form::submit('Update', array('class'=>'btn btn-success pull-right')) }}  
                                        </div>
                                    {{ Form::close() }}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection


