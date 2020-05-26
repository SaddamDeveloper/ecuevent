
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
                            <h2>Orders History</h2>
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
                                {{-- <a href="{{route('admin.mem_add_epin_form')}}" class="btn btn-primary">Add New EPIN</a> --}}
                                {{-- <a href="{{route('admin.mem_allot_epin_form')}}" class="btn btn-primary">Allot EPIN</a> --}}
                            </div>
                        </div>
                        <div>
                            <div class="x_content">
                                <table id="order_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>Product Name</th>
                                      <th>Product Image</th>
                                      <th>Date</th>
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
            var i = 1;
            var table = $('#order_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member.ajax.my_order_list') }}",
                columns: [
                    { "render": function(data, type, full, meta) {return i++;}},
                    {data: 'product_name', name: 'product_name',searchable: true},
                    {data: 'image', name: 'image',searchable: true},             
                    {data: 'created_at', name: 'created_at',searchable: true},             
                ]
            });
            
        });
     </script>
@endsection




