
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                  {{ Helper::Status() }}
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Feedback/Complaint</h2>
                            <div class="clearfix"></div>
                        </div>
                    <div>
                    </div>
                        <div>
                            <div class="x_content">
                                {{ Form::open(['method' => 'post','route'=>'member.store_complaint']) }}
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10 row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="complaint">Complaint</label>
                                            <textarea class="form-control" name="complaint" id="complaint" placeholder="Enter Complaint">{{old('complaint')}}</textarea>
                                                @if($errors->has('complaint'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('complaint') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                    </div><br>
                                    <div class="form-row mb-4 row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                            <select name="reason" class="form-control">
                                                <option value="">--Select Any reason--</option>
                                            </select>
                                            @if($errors->has('reason'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('reason') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">    	            	
                                    {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}  
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
@section('script')
<script src="{{ asset('ckeditor4/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'complaint', {
        height: 200,
        filebrowserUploadUrl: "{{route('member.ck_editor_image_upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );
</script>
@endsection

