
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>EPIN Transfer(UNDER CONSTRUCTION)</h2>
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
                                <div class="well">
                                {{ Form::open(['method' => 'post','route'=>'member.store_epin_requests']) }}
                                    <div class="form-row mb-10 row">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <input type="number" name="howEpin" class="form-control" placeholder="How many EPIN you will transfer?">
                                            @if($errors->has('howEpin'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('howEpin') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <select name="downlineUser">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            {{ Form::submit('Add', array('class'=>'btn btn-success')) }}  
                                        </div>
                                    </div>
                                {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection

@section('script')
 <script type="text/javascript">
     $(function () {
        var table = $('#epin_request').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('member.ajax.epin_request_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'epin_request', name: 'epin_request',searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                    if (row.status == '1') {
                    return "<button class='btn btn-warning'>Pending</a>"
                  }else{
                    return "<button class='btn btn-success'>Sent</a>"
                  }                        
                }},
            {data: 'created_at', name: 'created_at',searchable: true},
            ]
        });
        
    });
  </script>
@endsection




