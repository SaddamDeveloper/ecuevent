
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Add City</h2>
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
                            {{ Form::open(array('route' => 'admin.add.city', 'method' => 'post')) }}
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">City*</label>
                                    <div class="input_fields_wrap">
                                        <div>
                                            <input type="text" name="city" class="form-control" value="{{old('city')}}">
                                            @if($errors->has('city'))
                                                <span style="color:red;">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>                     
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    
                                    </div>                     
                                </div>
                            </div>

                                <div class="form-group">    	            	
                                    {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                            {{ Form::close() }}
                            </div>
                            <div class="x_content">
                                <table id="city_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
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
     <script type="text/javascript">
         $(function () {
            var table = $('#city_list').DataTable({                
                iDisplayLength: 50,
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.ajax.city_list')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'city', name: 'city' ,searchable: true}, 
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-info'>Used</a>"
                      }else{
                        return "<button class='btn btn-danger'>Not Used</a>"
                      }                        
                    }},                     
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            
        });
     </script>
 @endsection

