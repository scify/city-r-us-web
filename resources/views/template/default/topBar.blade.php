<?php  $lang = "templates/topBar."; ?> {{--  resource label path --}}
<div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                      <img src="{{ asset('img/logo_vertical.png') }}" style="height:100%;"/>
                    </div>
                    <!-- Logo Box -->
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">
                                <!---Profile--->
                               {{-- <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic"
                                        data-toggle="dropdown">
                                        <!-- Display the username -->
                                        <span class="user-name">{{{ isset(Auth::user()->name) ? Auth::user()->name : 'not logged in' }}}<i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar userImage" src="{{ (\Auth::user()->image_name==null || \Auth::user()->image_name=='') ?
                                    asset('assets/images/default.png') : asset('assets/uploads/users/'.\Auth::user()->image_name) }}" width="40" height="40"
                                         alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="{!! url('users/one/'.Auth::user()->id) !!}"><i class="fa fa-user"></i>{{trans($lang.'profile')}}</a></li>
                                        <li role="presentation"><a href="{!! url('users/one/'.Auth::user()->id.'/tasks') !!}"><i class="fa fa-tasks"></i>{{trans($lang.'tasks')}}</a></li>
                                        <li role="presentation"><a href="{!! url('auth/logout') !!}"><i class="fa fa-sign-out m-r-xs"></i>{{trans($lang.'logOut')}}</a></li>
                                    </ul>
                                </li>--}}
                                <!---/Profile--->

                                <!---Logout--->
                                <li>
                                    <a href="{!! url('auth/logout') !!}" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>{{trans($lang.'logOut')}}</span>
                                    </a>
                                </li>
                                <!---/Logout--->
                            </ul>
                        </div>
                    </div><!-- /Top Menu -->
                </div>
            </div>
