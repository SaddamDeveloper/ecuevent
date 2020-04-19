
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Member Details</h2>
                            <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i></button>
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
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Member ID</th>
                                            <td>{{$fetch_member_data->member_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{$fetch_member_data->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{$fetch_member_data->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td>{{$fetch_member_data->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{$fetch_member_data->gender == 1 ? "Male" : "Female"}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>{{$fetch_member_data->dob}}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{$fetch_member_data->status == 1 ? "ACTIVE" : "DEACTIVE"}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                EPIN
                                            </th>
                                            <td>{{$fetch_member_data->epin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nominee Relation</th>
                                            <td>{{$fetch_member_data->nominee_relation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nominee Name</th>
                                            <td>{{$fetch_member_data->nominee_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nominee Mobile</th>
                                            <td>{{$fetch_member_data->nominee_mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nominee Address</th>
                                            <td>{{$fetch_member_data->nominee_address}}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{$fetch_member_data->state}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{$fetch_member_data->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin</th>
                                            <td>{{$fetch_member_data->pin}}</td>
                                        </tr>
                                        <tr>
                                            <th>Registered By</th>
                                            <td>{{$fetch_member_data->registered_by}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address Proof</th>
                                            <td>
                                                <a href="{{asset('member/ID/'.$fetch_member_data->address_proof_doc)}}" target="_blank">
                                                    <img src="{{asset('member/ID/thumb/'.$fetch_member_data->address_proof_doc)}}" alt="Address Proof" width="200" height="200">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Address Proof No</th>
                                            <td>{{$fetch_member_data->address_proof_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Photo Proof</th>
                                            <td>
                                                <a href="{{asset('member/ID/'.$fetch_member_data->photo_proof)}}" target="_blank">
                                                    <img src="{{asset('member/ID/thumb/'.$fetch_member_data->photo_proof)}}" alt="Photo Proof" width="200" height="200">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    @if($fetch_member_data->document_status == 2)  
                                        <a href="{{route('admin.member_verify', ['id' => encrypt($fetch_member_data->id), 'status' => encrypt(1)])}}" class="btn btn-success btn-sm">Verify</a>
                                        <a href="{{route('admin.member_verify', ['id' => encrypt($fetch_member_data->id), 'status' => encrypt(3)])}}" class="btn btn-danger btn-sm">Reject</a>
                                    @elseif($fetch_member_data->document_status == 3)
                                        <button class="btn btn-danger" disabled>Rejected</button>
                                    @else
                                        <button class="btn btn-success" disabled>Verified</button>
                                    @endif
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





