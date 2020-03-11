
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Product</h2>
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

                                <div class="form-row mb-10 mb-2">
                                   
                                    <div class="col-md-12 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <div class="productsction">
                                            <div class="producttitle">
                                                <h4>{{__('Product for APM')}}</h4>
                                                <p>{{__('Start your business to buy any one package')}}</p>
                                            </div>
                                            @if (count($products) > 0)
                                            <div class="productcontent">
                                                <div class="row">
                                                    @foreach ($products as $product)
                                                    <div class="col-md-4 singleproduct">
                                                    <h5>{{$product->name}}</h5>
                                                        <img src="{{asset('member/product/thumb/'.$product->image1)}}" alt="" class="fstchld">
                                                        <img src="{{asset('member/product/thumb/'.$product->image2)}}" alt="">
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-12 bottomcontent">
                                                        <h5>Rs. 2999/ only (include GST)</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="productcontent">
                                                <div class="row">
                                                    No Data Found
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
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
        $(document).ready(function(){
            // $('.member_data').hide();
            // fetch_member_data();
            function fetch_member_data(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
                $.ajax({
                    url: "{{route('member.search_sponsor_id')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 5){
                            $('#member_data').html("<font color='red'>All lags are full! Try with another Sponsor ID</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }else if(data == 1){
                            $('#member_data').html("<font color='red'>Invalid Sponsor ID!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }else{
                            $('#member_data').html(data);
                            $("#loading-image").hide();
                        }
                    }
                });
            }
            $(document).on('blur', '#search_sponsor_id', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });

            $( "#dob" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-50:+0",
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


