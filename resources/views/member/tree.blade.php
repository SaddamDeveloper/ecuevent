
@extends('member.template.member_master')
@section('link')
  <link href="{{asset('build/css/T-style.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
          <div class="x_panel">
              <div class="x_title">
                  <h2>Tree</h2>
                  <div class="clearfix"></div>
              </div>
              <div>
                  <div class="x_content" style="overflow:scroll">
                        <div class="tree" style="width:100%;left:40%;right:40%;text-align: -webkit-center;">
                            <ul>
                                <li>        
                                    <a href="#">Parent
                                        <div class="info">
                                            <h5>Name : Vishal Nag</h5>
                                            <h5>Id : GD1549ND</h5>
                                            <h5>Rank : 1</h5>
                                        </div>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#">Child 1
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 2</h5>
                                                </div>  
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="#">Grandchild 1a 
                                                        <div class="info">
                                                            <h5>Name : Vishal Nag</h5>
                                                            <h5>Id : GD1549ND</h5>
                                                            <h5>Rank : 3</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">Grandchild 1a 
                                                        <div class="info">
                                                            <h5>Name : Vishal Nag</h5>
                                                            <h5>Id : GD1549ND</h5>
                                                            <h5>Rank : 3</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Child2
                                                <div class="info">
                                                    <h5>Name : Vishal Nag</h5>
                                                    <h5>Id : GD1549ND</h5>
                                                    <h5>Rank : 2</h5>
                                                </div>  
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="#">Grandchild 2a 
                                                        <div class="info">
                                                            <h5>Name : Vishal Nag</h5>
                                                            <h5>Id : GD1549ND</h5>
                                                            <h5>Rank : 3</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
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




