
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                  {{-- {{ Helper::Status() }} --}}
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Feedback/Complaint</h2>
                            <div class="clearfix"></div>
                            @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
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
                                </div>
                                <div class="form-group">    	            	
                                    {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                {{ Form::close() }}
                                <h3>Complaint/Feedback List</h3>
                                <table id="feedback_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Feedback/Complaint</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>                       
                                    </tbody>
                                </table>
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

    $(function () {
            var i = 1;
            var table = $('#feedback_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax.feedback_list') }}",
                columns: [
                    { "render": function(data, type, full, meta) {return i++;}},
                    {data: 'feedback', name: 'feedback',searchable: true},
                    {data: 'created_at', name: 'created_at',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-success'>Active</a>"
                        }else if(row.status == '2'){
                          return "<button class='btn btn-danger'>Deactive</a>"
                          }                        
                    }},              
                ]
            });
            
        });
</script>
@endsection

