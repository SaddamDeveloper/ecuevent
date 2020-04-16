
@extends('member.template.member_master')
@section('link')
  <link href="{{asset('build/css/T-style.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            {{ Helper::Status() }}
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tree</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content" style="overflow:scroll">
                        <div class="tree" style="width:100%;left:40%;right:40%;text-align: -webkit-center;">
                            {{-- <input type="hidden" id="auth" value="{{Auth::user()->id}}">
                            <div id="tree">
                                @if (isset($html) && !empty($html))
                                    {!! $html !!}
                                @endif
                            </div> --}}

                            {{-- <ul>
                                <li>        
                                    <a href="#">Parent
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 1</h5>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="row">
                                <div class="col-md-6">
                                    <li>
                                        <a href="#">Child 1
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 2</h5>
                                            </div>  
                                        </a>
                                    </li>
                                    
                                </div>
                                <div class="col-md-6">
                                    <li>
                                        <a href="#">Child2
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 2</h5>
                                            </div>  
                                        </a>
                                    </li>
                                </div>                                    
                            </ul>

                            <ul>
                                <li>
                                    <a href="#">Child 1
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Child 1
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Child 1
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Child2
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                </li>
                            </ul>  --}}
                        </div>                        

                        <div class="downline">
                            <div class="row level-1">
                                <div class="col-md-12" style="margin-top: -20px;z-index: 9;">                                       
                                    <a href="#">Parent
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 1</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>                     

                            <div class="row level-2">
                                <div class="col-md-6">                                       
                                    <a href="#">Parent
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 1</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">                                       
                                    <a href="#">Parent
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 1</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>  

                            <div class="row level-3">
                                <div class="col-md-6 hiw"> 
                                    <div class="col-md-6">                                       
                                        <a href="#">Parent
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 1</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 r-top">                                       
                                        <a href="#">Parent
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 1</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 hiw"> 
                                    <div class="col-md-6 l-top">                                       
                                        <a href="#">Parent
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 1</h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">                                       
                                        <a href="#">Parent
                                            <div class="info">
                                                <h5>Name : Vishal Nag</h5>
                                                <h5>Id : GD1549ND</h5>
                                                <h5>Rank : 1</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>  

                            <div class="row level-4">
                                <div class="col-md-6"> 
                                    <div class="col-md-6 hiw">                                       
                                        <div class="col-md-6">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 r-top">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                       
                                        <div class="col-md-6 l-top">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 r-top">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="col-md-6 hiw">                                       
                                        <div class="col-md-6 l-top">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 r-top">                                       
                                            <a href="#">Parent1
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                       
                                        <div class="col-md-6 l-top">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6">                                       
                                            <a href="#">Parent
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>   

                            <div class="row level-5">
                                <div class="col-md-6"> 
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <div class="col-md-6">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="col-md-6 l-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 r-top">                                       
                                                <a href="#">Parent
                                                    <div class="info">
                                                        <h5>Name : Vishal Nag</h5>
                                                        <h5>Id : GD1549ND</h5>
                                                        <h5>Rank : 1</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                    </div>
              </div>
          </div>
      </div>
    </div>

</div>
<!-- /page content -->
@endsection

@section('script')
  
@endsection




