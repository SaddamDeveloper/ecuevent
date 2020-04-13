
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
                           
                         {{ Form::open(['method' => 'post','route'=>'admin.mem_add_pair_cut_off']) }}
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Pair CutOFF</label>
                                    <div class="input_fields_wrap">
                                        <div>
                                            <input type="text" name="mytext[]" value="" class="form-control" style="margin-bottom: 2px">
                                            @if($errors->has('mytext[]'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mytext[]') }}</strong>
                                            </span>
                                            @enderror
                                            <button class="btn btn-primary btn-rounded" id="add"> 
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </div>                     
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    
                                    </div>                     
                                </div>
                            </div>

                            <div class="form-group mb-3">    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
                            </div>
                            {{ Form::close() }}
                            <table id="cutOff_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                  <tr>
                                    <th>Sl. No</th>
                                    <th>CutOFF</th>
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
    $(function () {

        //CutOFF Generate
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $("#add"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ 
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" name="mytext[]" class="form-control" /><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })

        //CutOFF Table
        var table = $('#cutOff_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ajax.cutOff_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'cutoff', name: 'cutoff',searchable: true},
                {data: 'action', name: 'action' ,searchable: true},                 
            ]
        });
    });
        
    </script>
@endsection

