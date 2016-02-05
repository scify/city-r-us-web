<div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('img/logo.png') }}""/> <span>City-R-US</span>
                    </div>
                    <!-- Logo Box -->
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">
                                <!---Logout--->
                                <li>
                                    <a href="{!! url('auth/logout') !!}" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>{{trans('admin_menu.logOut')}}</span>
                                    </a>
                                </li>
                                <!---/Logout--->
                            </ul>
                        </div>
                    </div><!-- /Top Menu -->
                </div>
            </div>
