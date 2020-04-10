
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Verify Member</h2>
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
                                <div class="well" style="overflow: auto">
                                    <input type="hidden" value="{{$fetch_member_data->id}}" name="id">
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <img src="{{asset('member/ID/'.$fetch_member_data->address_proof_doc)}}" width="200" height="200" alt="address_proof">
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="email">Address Proof No</label>
                                            <input type="text" class="form-control" name="address_proof_no" value="{{$fetch_member_data->address_proof_no}}" readonly>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <img src="{{asset('member/ID/'.$fetch_member_data->photo_proof)}}" width="200" height="200" alt="photo_proof">
                                        </div> 
                                    </div>
                                    <button class="btn btn-primary"></button>
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





