
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Add New EPIN</h2>
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
                                <a href="{{route('admin.mem_add_epin_form')}}" class="btn btn-primary">Add New EPIN</a>
                                <a href="{{route('admin.mem_allot_epin_form')}}" class="btn btn-primary">Allot EPIN</a>
                            </div>
                        </div>
                        <div>
                            <div class="x_content">
                                <table id="epin_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>EPIN</th>
                                      <th>Status</th>
                                      <th>Alloted To</th>
                                      <th>Used By</th>
                                      {{-- <th>Action</th> --}}
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
            var table = $('#epin_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax.get_epin_list') }}",
                columns: [
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'epin', name: 'epin',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-info'>Used</a>"
                      }else{
                        return "<button class='btn btn-danger'>Not Used</a>"
                      }                        
                    }},
                    {data: 'alloted_to', name: 'alloted_to' ,searchable: true}, 
                    {data: 'used_by', name: 'used_by' ,searchable: true},                 
                    // {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
     @endsection




