<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('member.dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>ECU EVENT MEMBER</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="{{asset('production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>{{Auth::user()->name}}</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
          <li><a href="{{route('member.dashboard')}}"><i class="fa fa-home"></i> Home </a>
            </li>
           
            <li><a href="{{route('member.add_new_member_form')}}"><i class="fa fa-user-plus"></i> Member Registration</a>
            </li>
          
            <li><a><i class="fa fa-code-fork"></i>My Downline <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{route('member.tree')}}"> My Tree</a></li>
                <li><a href="{{route('member.mem_downline_list_form')}}"> Downline List</a></li>
              </ul>
            </li>

            <li><a href="{{route('member.mem_epin_list_form')}}"><i class="fa fa-ticket"></i> My EPIN</a>
            </li>
           
            <li><a href="{{route('member.mem_commission_list_form')}}"><i class="fa fa-percent"></i> Commission History</a>
            </li>

            <li><a href="{{route('member.mem_order_list_form')}}"><i class="fa fa-database"></i> Orders</a>
            </li>

            <li><a href="{{route('member.mem_wallet_list_form')}}"><i class="fa fa-credit-card"></i> Wallet</a>
            </li>

          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
          <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('member.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
        <form id="frm-logout" action="{{ route('member.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>