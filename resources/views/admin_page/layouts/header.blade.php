<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="#" class="logo">
            Dashboard
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->

    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!-- <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li> -->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{URL::to('backend/images/254537.png')}}">
                    <span class="username">
                    @if(auth()->guard('admins')->user())
                            {{ auth()->guard('admins')->user()->name }}
                        @endif
                </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Profile User</a></li>
                    <!-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> -->
                    <li><a href="{{route('auth.logout')}}"><i class="fa fa-key"></i>Logout</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->

        </ul>
        <!--search & user info end-->
    </div>
</header>
