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
           
            <li><a><i class="fa fa-gear"></i> Configuration <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
               
              </ul>
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