
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Add New Member</h2>
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
                       
                            {{-- {{ Form::open(['method' => 'post','route'=>'admin.add_new_product' , 'enctype'=>'multipart/form-data']) }} --}}
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    </div>
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="gender">Sponsor ID</label>
                                        <input type="text" name="search_sponsor_id" id="search_sponsor_id" class="form-control" placeholder="Sponsor ID">
                                        @if($errors->has('search_sponsor_id'))
                                            <span class="invalid-feedback search_sponsor_id_error" role="alert" style="color:red">
                                                <strong>{{ $errors->first('search_sponsor_id') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    </div>
                                </div>

                            </div>
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="name">Name*</label>
                                      <input type="text" class="form-control" name="name"  placeholder="Enter Member Name" >
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="email">Email*</label>
                                      <input type="email" class="form-control" name="email"  placeholder="Enter Email" >
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="mobile">Mobile*</label>
                                      <input type="text" class="form-control" name="mobile"  placeholder="Enter Mobile No" >
                                    </div> 
                                </div>
    
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="gender">Gender*</label>
                                      <select class="form-control" name="gender" id="gender">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="dob">DOB</label>
                                        <input type="date" name="dob" id="dob" class="form-control" min="2000-06-02">
                                        @if($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="sponsor_id">Sponsor ID</label>
                                        <input type="text" name="sponsor_id" id="sponsor_id" class="form-control" placeholder="Sponsor ID">
                                        @if($errors->has('sponsor_id'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('sponsor_id') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </div>
    
                                <div class="form-row mb-3">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="address"  placeholder="Enter Address"></textarea>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="city"  placeholder="Enter City">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="state"  placeholder="Enter State">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="pin">Pin</label>
                                        <input type="text" class="form-control" name="pin"  placeholder="Enter Pin No">
                                    </div>
                                </div>
                            </div>

                            <div class="well" style="overflow: auto" id="image_div">
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="address_proof">Address Proof</label>
                                        <input type="file" name="address_proof" class="form-control">
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="address_proof_no">Address Proof No</label>
                                        <input type="text" name="address_proof" class="form-control" placeholder="Enter Address Proof No">
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="photo_proof">Photo Identity Proof</label>
                                        <input type="file" name="photo_proof" class="form-control">
                                    </div>
                                </div>
                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @enderror
                           </div>

                            <div class="well" style="overflow: auto">
                                <div id="color_div">
                                    <div class="form-row mb-3" >
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="nom_relation">Nominee Relation</label>
                                            <input type="text" name="nom_relation" id="nom_relation" class="form-control" placeholder="Enter Nominee Relation">
                                        </div>    
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="nom_name">Nominee Name</label>
                                            <input type="text" name="nom_name" id="nom_name" class="form-control" placeholder="Enter Nominee Name">
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="nom_mobile">Nominee Mobile</label>
                                            <input type="text" name="nom_mobile" id="nom_mobile" class="form-control" placeholder="Enter Nominee Mobile">
                                        </div>                     
                                    </div>
                                    <div class="form-row mb-3" >
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="nom_address">Nominee Address</label>
                                            <textarea name="nom_address" id="nom_address" class="form-control" placeholder="Enter Nominee Address"></textarea>
                                        </div>    
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">    	            	
                                    {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
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
        $(document).ready(function(){
            // $('.member_data').hide();
            fetch_member_data();
            function fetch_member_data(query = ''){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
                $.ajax({
                    url: "{{route('member.search_sponsor_id')}}",
                    method: "GET",
                    data: {query:query},
                    dataType: 'JSON',
                    success: function(data){
                        $('#member_data').html(data.table_data);
                        // if(data.total_data == 0){
                        //     $('.search_sponsor_id_error').text("Give a valid sponsor ID");
                        // }
                    }
                });
            }

            $(document).on('blur', '#search_sponsor_id', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });
          
        });

        /***
        * Display till today in DOB
        */
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#dob').attr('max', maxDate);
    </script>
@endsection

@section('css')
    <style>
        #search_sponsor_id{
            text-transform: uppercase;
        }
    </style>
@stop


