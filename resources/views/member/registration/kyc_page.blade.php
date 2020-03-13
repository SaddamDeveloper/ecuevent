
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>KYC Details</h2>
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
                            {{-- {{ Form::open(['method' => 'post','route'=>'member.product_purchase']) }} --}}
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="address">Address proof</label>
                                        <input type="file" name="address" id="address" class="form-control">
                                    </div>
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="doc">Document No</label>
                                        <input type="text" name="doc" id="doc" class="form-control" placeholder="Enter Document No">
                                    </div> 
    
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        
                                    </div>
                                </div>
                                <div class="form-row mb-10 mb-2">
                                   
                                </div>
                            </div>
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                   
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="photo">Photo proof</label>
                                        <input type="file" name="photo" id="photo" class="form-control">
                                    </div> 
    
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        
                                    </div>
                                </div>
                                <div class="form-row mb-10 mb-2">
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Next', array('class'=>'btn btn-success pull-right')) }}  
                                {{ Form::submit('Skip', array('class'=>'btn btn-default pull-right')) }}  
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
    <script>
        
    </script>
@endsection


