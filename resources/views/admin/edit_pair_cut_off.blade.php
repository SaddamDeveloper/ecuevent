
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Common Pair CutOFF</h2>
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
                           
                         {{ Form::open(['method' => 'post','route'=>'admin.mem_update_pair_cut_off']) }}
                            <div class="well" style="overflow: auto">
                                <input type="hidden" name="u_id" value="{{$cutoff->id}}">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Edit Pair CutOFF</label>
                                    <div class="input_fields_wrap">
                                        <div>
                                            <input type="text" name="cutOff" value="{{$cutoff->cutoff}}" class="form-control" style="margin-bottom: 2px">
                                            @if($errors->has('cutOff'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('cutOff') }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>                     
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    
                                    </div>                     
                                </div>
                            </div>

                            <div class="form-group mb-3">    	            	
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

