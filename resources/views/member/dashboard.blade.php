
@extends('member.template.member_master')

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          {{ Helper::Status() }}
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> My Commission</span>
            <div class="count">{{$my_commission}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Pair Completed</span>
              <div class="count">{{$total_pair_completed}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Available</span>
              <div class="count">{{$epin_available}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Used</span>
              <div class="count">{{$epin_used}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cc-visa"></i> My Wallet</span>
              <div class="count">{{$my_wallet}}</div>
            </div>
          </div>
          <div class="x_content">
            <div class="well text-info">
              <h3>Important Notice</h3>
              @if(isset($notice) && !empty($notice))
                <marquee height="100px" direction="up" scrollamount="1"> 
                  @foreach ($notice as $nt)
                    <a href="{{route('member.notice', ['id' => encrypt($nt->id)])}}" target="_blank">{!! Str::words($nt->title, 10, ' ...') !!}</a> <br>
                  @endforeach
                </marquee>
              @endif  
            </div>
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                  <thead>
                      <tr class="headings">                
                          <th class="column-title">Sl No. </th>
                          <th class="column-title">EPIN</th>
                          <th class="column-title">Status</th>
                          <th class="column-title">Alloted To</th>
                          <th class="column-title">Used By</th>
                      </tr>
                  </thead>
                  <tbody>
                    @if(isset($epin_list) && !empty($epin_list) && count($epin_list) > 0)
                    @php
                        $count = 1;
                    @endphp
                    @foreach($epin_list as $epin)
                        <tr class="even pointer">
                            <td class=" ">{{ $count++ }}</td>
                            <td class=" ">{{ $epin->epin }}</td>
                            <td>{!! $epin->status == 1 ? "<button class='btn btn-primary'>Used</button>" : "<button class='btn btn-danger'>Not used</button>" !!}</td>
                            <td>{{$epin->name}}</td>
                            <td>{{$epin->used_by_name}}</td>
                        </tr>
                      @endforeach
                    @else
                    <tr>
                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                    </tr>
                    @endif
                  </tbody>
              </table>
              <a href="{{route('member.mem_epin_list_form')}}" class="btn btn-primary pull-right">More...</a>
          </div>
        </div>
          <!-- /top tiles -->

          <br />
        </div>
        <!-- /page content -->
@endsection


