
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
                                <a href="{{route('admin.mem_add_product_form')}}" class="btn btn-primary">Add Product</a>
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">                
                                                <th class="column-title">Sl No. </th>
                                                <th class="column-title">Name</th>
                                                <th class="column-title">Price</th>
                                                <th class="column-title">Image1</th>
                                                <th class="column-title">Image2</th>
                                                <th class="column-title">Action</th>
                                            </tr>
                                        </thead>
            
                                        <tbody>
                                            @if(isset($tabledatas) && !empty($tabledatas) && count($tabledatas) > 0)
                                            @php
                                                $count = 1;
                                            @endphp

                                            @foreach($tabledatas as $tabledata)
                                                <tr class="even pointer">
                                                    <td class=" ">{{ $count++ }}</td>
                                                    <td class=" ">{{ $tabledata->name }}</td>
                                                    <td>{{ number_format($tabledata->price, 2)}}</td>
                                                    <td><img src="{{ asset('member/product/thumb/'.$tabledata->image1.'') }}" height="80px"></td>
                                                    <td><img src="{{ asset('member/product/thumb/'.$tabledata->image2.'') }}" height="80px"></td>
                                                    <td class=" ">
                                                        <a href="{{route('admin.edit_member_product',['id' => encrypt($tabledata->id)])}}" class="btn btn-warning">Edit</a>
                                                        <a href="{{ route('admin.delete_member_product',['id' => encrypt($tabledata->id)]) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{ $tabledatas->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection


