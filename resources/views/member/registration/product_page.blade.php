
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
                            {{ Form::open(['method' => 'post','route'=>'member.product_purchase']) }}
                            <input type="hidden" name="u_id" value="{{$user_id}}">
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
                                                        <label>
                                                            <input type="radio" name="product" value="{{$product->id}}">
                                                            <input type="hidden" name="productName" value="{{$product->name}}">
                                                            <h5>{{$product->name}}</h5>
                                                            <img src="{{asset('member/product/thumb/'.$product->image1)}}" name="image1" alt="" class="fstchld">
                                                            <img src="{{asset('member/product/thumb/'.$product->image2)}}" name="image2" alt="" class="sndimg">
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-12 bottomcontent">
                                                        <h5>{{__('Rs. 2999/ only (include GST)')}}</h5>
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
                            <div class="form-group">
                                {{ Form::submit('Next', array('class'=>'btn btn-success pull-right')) }}  
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


