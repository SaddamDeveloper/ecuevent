
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Common Pair Timing</h2>
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
                           
                         {{ Form::open(['method' => 'post','route'=>'admin.mem_add_pair_timing']) }}
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="from" value="{{old('name')}}"  placeholder="Enter Name">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                     
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">From</label>
                                    <input type="time" class="form-control" name="from" id="from" value="{{old('from')}}">
                                        @if($errors->has('from'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('from') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                     
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="to">To</label>
                                    <input type="time" class="form-control" name="to" id="to" value="{{old('to')}}" />
                                        @if($errors->has('to'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('to') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                     
                                </div>
                            </div>

                            <div class="form-group">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{__('Pair Timing List')}}</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                <i class="fa fa-wrench"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Settings 1</a>
                                                <a class="dropdown-item" href="#">Settings 2</a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="close-link">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </li>
                                        </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($table_data) && !empty($table_data) && count($table_data) > 0)
                                            @php
                                                $count = 1;
                                            @endphp

                                            @foreach($table_data as $table)
                                                <tr class="even pointer">
                                                    <td class=" ">{{ $count++ }}</td>
                                                    <td class=" ">{{ $table->name }}</td>
                                                    <td class=" ">{{ $table->from }}</td>
                                                    <td class=" ">{{ $table->to }}</td>
                                                    <td class=" ">
                                                        <a href="{{route('admin.edit_member_product',['id' => encrypt($table->id)])}}" class="btn btn-warning">Edit</a>
                                                        <a href="{{ route('admin.delete_member_product',['id' => encrypt($table->id)]) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
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

@section('script')
    <script>
    $(function () {
        $('#field-start_t_a').datetimepicker({
            dateFormat: '',
            timeFormat: 'hh:mm tt'
        });
    });
    </script>
@endsection

