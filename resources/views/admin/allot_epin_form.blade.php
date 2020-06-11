
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Allot EPIN</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.mem_allot_epin']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="name">User ID:</label>
                                            <input type="text" class="form-control" name="searchMember" id="searchMember" value="{{old('user_id')}}"  placeholder="Search User ID">
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <div id="myDiv">
                                                    <img id="loading-image" src="{{asset('production/images/ajax-loader.gif')}}" style="display:none;"/>
                                                </div>
                                                <div id="search_data">
                                                    @if($errors->has('epin'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('epin') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>                     
                                        </div>
                                    </div>

                                <div class="form-group">    	            	
                                    {{ Form::submit('Allot Epin', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="x_content">
                                <table id="epin_request" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>EPIN Requests</th>
                                      <th>Added By</th>
                                      <th>Date</th>
                                      <th>Status</th>
                                      <th>Action</th>
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
    <script>
        $(document).ready(function(){
            function searchMember(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });

                $.ajax({
                    url: "{{route('member.search_member_id')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 5){
                            $('#search_data').html("<font color='red'>Member not found!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }
                        else if(data == 1){
                            $('#search_data').html("<font color='red'>Something went wrong!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }
                        else{
                            $('#search_data').html(data);
                            $("#loading-image").hide();
                        }
                    }
                });
            }

            $(document).on('blur', '#searchMember', function(){
                var query = $(this).val();
                if(query){
                    searchMember(query);
                }
            });

        });
        $(function () {
        var i = 1;
        var table = $('#epin_request').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ajax.epin_requests_lists') }}",
            columns: [
                { "render": function(data, type, full, meta) {return i++;}},
                {data: 'epin_request', name: 'epin_request',searchable: true},
                {data: 'added_by', name: 'added_by',searchable: true},
                {data: 'created_at', name: 'created_at',searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                    if (row.status == '1') {
                    return "<button class='btn btn-danger rounded'>Not Solved</a>"
                    }else{
                    return "<button class='btn btn-warning rounded' disabled>Solved</a>"
                    }                        
                }},              
                {data: 'action', name: 'action',searchable: true},
            ]
        });
        });
    </script>
@endsection
@section('css')
    <style>
        #searchMember{
            text-transform: uppercase;
        }
    </style>
@stop


